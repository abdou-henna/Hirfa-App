<template>
  <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4" dir="rtl">
    <div class="bg-white p-5 rounded-lg flex flex-col max-w-xl w-full shadow-lg relative max-h-full overflow-hidden">
      <div class="overflow-y-auto custom-scrollbar p-2">
        <h2 class="text-xl font-bold mb-4 text-center">تعديل بيانات الحرفي</h2>
        <div class="space-y-4 ml-4">
          <div class="flex flex-col items-center">
            <label class="font-semibold">الصورة الشخصية</label>
            <img 
              :src="tempCraftsman.image_url" 
              class="mt-2 w-40 h-40 rounded-full border-2 border-blue-500 cursor-pointer" 
              @click="triggerProfileImgUpload"
            />
            <input type="file" ref="profileImgInput" class="hidden" @change="handleProfileImgChange" />
          </div>
          <div class="flex flex-col">
            <label class="font-semibold">الاسم</label>
            <input type="text" v-model="tempCraftsman.firstName" class="form-input" />
          </div>
          <div class="flex flex-col">
            <label class="font-semibold">الحرفة</label>
            <select
                v-model="crafts_id"
                class="w-full p-2 border border-gray-300 rounded"
              >
                <option  disabled :value="tempCraftsman.crafts.id">{{ tempCraftsman.crafts.type }}</option>
                <option v-for="x in crafts" :key="x.id" :value="x.id" >{{ x.type }}</option>
                <!-- إضافة المزيد من الفئات حسب الحاجة -->
              </select>
          </div>
          <div class="flex flex-col">
            <label class="font-semibold">المكان</label>
            <input type="text" v-model="tempCraftsman.place" class="form-input" />
          </div>
          <div class="flex flex-col">
            <label class="font-semibold">السعر</label>
            <input type="text" v-model="tempCraftsman.price" class="form-input" />
          </div>
          <div class="flex flex-col">
            <label class="font-semibold">معرض الصور</label>
            <div class="grid grid-cols-2 gap-2 mt-2">
              <div v-for="(image, id) in tempCraftsman.image_craftsmens" :key="id" class="relative">
                <img :src="image.full_url" class="w-full h-24 object-cover rounded-lg" />
                <button @click="deleteImage(id)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1">×</button>
                <input type="text" v-model="image.description" placeholder="وصف الصورة" class="form-input mt-1" />
              </div>
            </div>
            <button @click="triggerGalleryImgUpload" class="btn-add mt-4">إضافة صورة جديدة</button>
            <input type="file" ref="galleryImgInput" multiple class="hidden" @change="handleGalleryImagesChange" />
          </div>
        </div>
        <div class="flex justify-start space-x-4 mt-6">
          <button @click="closeModal" class="btn-cancel mx-4">إلغاء</button>
          <button @click="uploadAndSaveCraftsman" class="btn-save mx-4">حفظ</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['craftsman', 'closeModal', 'saveChanges'],
  data() {
    return {
      tempCraftsman: JSON.parse(JSON.stringify(this.craftsman)),
      tempProfileImg: this.craftsman.ProfileImg,
      newGalleryImages: [],
      deletedImages: [],
      crafts:{},
      crafts_id:""
    };
  },
  created() {
			this.get_crafts();
	},
  methods: {
    async get_crafts(){
      const response = await axios.post('/get_crafts')
      this.crafts = response.data.data
      console.log (response.data.data)
    },
    triggerProfileImgUpload() {
      this.$refs.profileImgInput.click();
    },
    handleProfileImgChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.tempProfileImg = URL.createObjectURL(file);
        this.tempCraftsman.ProfileImg = this.tempProfileImg;
      }
    },
    triggerGalleryImgUpload() {
      this.$refs.galleryImgInput.click();
    },

    handleGalleryImagesChange(event) {
  const files = event.target.files;
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const src = URL.createObjectURL(file);
    this.newGalleryImages.push({ src, file, description: '' });
    if (!this.tempCraftsman.image_craftsmens) {
      this.tempCraftsman.image_craftsmens = [];
    }
    this.tempCraftsman.image_craftsmens.push({ src, description: '', isNew: true });
  }
},



  deleteImage(id) {
    // حذف الصورة من القائمة
    this.tempCraftsman.image_craftsmens = this.tempCraftsman.image_craftsmens.filter(image => image.id !== id);
    this.newGalleryImages = this.newGalleryImages.filter((_, index) => index !== id);

    // إضافة معرف الصورة إلى قائمة الصور المحذوفة
    this.deletedImages.push(id);
  },

    closeModal() {
      this.$emit('closeModal');
    },
    async uploadAndSaveCraftsman() {
  try {
    const formData = new FormData();

    formData.append('firstName', this.tempCraftsman.firstName);
    formData.append('craftType', this.crafts_id);
    formData.append('place', this.tempCraftsman.place);
    formData.append('price', this.tempCraftsman.price);

    if (this.$refs.profileImgInput.files[0]) {
      formData.append('profileImage', this.$refs.profileImgInput.files[0]);
    }

    // إرسال الصور الجديدة
    this.newGalleryImages.forEach((image, index) => {
      formData.append(`galleryImages[${index}]`, image.file);
      formData.append(`galleryDescriptions[${index}]`, image.description);
    });

    // إرسال تحديثات الصور القديمة
    this.tempCraftsman.image_craftsmens.forEach((image, index) => {
      if (!image.isNew) {
        formData.append(`existingImages[${index}][id]`, image.id);
        formData.append(`existingImages[${index}][description]`, image.description);
      }
    });

    this.deletedImages.forEach((id, index) => {
      formData.append(`deletedImages[${index}]`, id);
    });

    const response = await axios.post('/update_craftsman', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    console.log(response.data);
    window.location.href = '/craftsmanprofile/1';
  } catch (error) {
    console.error('Error updating craftsman:', error);
  }
}



  }
};
</script>

<style scoped>
.btn-cancel {
  @apply bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded;
}
.btn-save {
  @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow;
}
.btn-add {
  @apply bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow;
}
.form-input {
  @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm;
}
.custom-scrollbar::-webkit-scrollbar {
  width: 12px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
  border: 2px solid #f1f1f1;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
