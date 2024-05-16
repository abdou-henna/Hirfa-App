<template>
  <div class="fixed inset-0 bg-black bg-opacity-75 flex justify-center p-4 z-50 overflow-scroll" dir="rtl">
    <div class="bg-white p-5 rounded-lg flex flex-col max-w-xl w-full shadow-lg relative overflow-scroll" @click.stop>
      <h2 class="text-xl font-bold mb-4 text-center">تعديل بيانات الحرفي</h2>
      <div class="space-y-4">
        <div class="flex flex-col items-center">
          <label class="font-semibold">الصورة الشخصية</label>
          <img 
            :src="tempCraftsman.ProfileImg" 
            class="mt-2 w-40 h-40 rounded-full border-2 border-blue-500 cursor-pointer" 
            @click="triggerProfileImgUpload"
          />
          <input type="file" ref="profileImgInput" class="hidden" @change="handleProfileImgChange" />
        </div>
        <div class="flex flex-col">
          <label class="font-semibold">الاسم</label>
          <input type="text" v-model="tempCraftsman.name" class="form-input" />
        </div>
        <div class="flex flex-col">
          <label class="font-semibold">الحرفة</label>
          <input type="text" v-model="tempCraftsman.type" class="form-input" />
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
            <div v-for="(image, index) in tempCraftsman.craftsmanGallery" :key="index" class="relative">
              <img :src="image.src" class="w-full h-24 object-cover rounded-lg" />
              <button @click="deleteImage(index)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1">×</button>
              <input type="text" v-model="image.description" placeholder="وصف الصورة" class="form-input mt-1" />
            </div>
          </div>
          <button @click="triggerGalleryImgUpload" class="btn-add mt-4">إضافة صورة جديدة</button>
          <input type="file" ref="galleryImgInput" multiple class="hidden" @change="handleGalleryImagesChange" />
        </div>
      </div>
      <div class="flex justify-start space-x-4 mt-6" >
        <button @click="closeModal" class="btn-cancel mx-4">إلغاء</button>
        <button @click="saveChanges" class="btn-save mx-4">حفظ</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['craftsman', 'closeModal', 'saveChanges'],
  data() {
    return {
      tempCraftsman: JSON.parse(JSON.stringify(this.craftsman)),
      tempProfileImg: this.craftsman.ProfileImg,
      newGalleryImages: [],
    };
  },
  methods: {
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
        this.tempCraftsman.craftsmanGallery.push({ src, description: '' });
      }
    },
    deleteImage(index) {
      this.tempCraftsman.craftsmanGallery.splice(index, 1);
    },
    closeModal(){
      this.$emit('closeModal');
    },
    saveChanges() {
      this.$emit('saveChanges', this.tempCraftsman, this.newGalleryImages);
    },
  },
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
</style>
