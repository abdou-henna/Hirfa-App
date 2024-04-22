<template>
  <nav-bar-r />
  <div class="container mx-auto p-4 mt-6" dir="rtl">
    <div class="text-center">
      <h1 class="text-2xl font-bold mb-6">لوحة التحكم الخاصة بالحرفي</h1>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <!-- لوحة المعلومات -->
      <div>
        <dashboard-card />
      </div>
      <!-- قائمة طلبات الخدمات -->
      <orders-list-c />
      <!-- قائمة المشاريع -->
      <projects-list />
      <!-- التقييمات والمراجعات -->
      <reviews-section />
      <!-- الإعدادات الشخصية -->
      <profile-settings />
      <!-- التواصل والإشعارات -->
      <div class="col-span-2 flex justify-center p-8">
        <button
          @click="openEditModal"
          class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-4"
        >
          تعديل معلومات الصفحة الشخصية
        </button>
      </div>
    </div>
  </div>
  <!-- مودال تعديل المعلومات -->
  <!-- مودال عرض تقييمات العملاء -->
  <Modal v-if="showModal" @close="showModal = false">
    <template v-slot:header>
      <h3 class="font-bold text-lg">تقييمات العملاء</h3>
    </template>
    <template v-slot:default>
      <div v-for="review in reviews" :key="review.id" class="border-b py-2">
        <div class="flex items-center mb-1">
          <span class="ml-2 text-sm text-gray-600">{{
            review.customerName
          }}</span>
          <div dir="ltr">
            <star-rating
              :rating="review.rating"
              :read-only="true"
            ></star-rating>
          </div>
        </div>
        <p class="text-gray-600">{{ review.comment }}</p>
      </div>
    </template>
  </Modal>

  <!-- مودال عرض الصورة المكبرة والوصف -->
  <div
    v-if="showModal1 && selectedImage"
    class="fixed inset-0 bg-black bg-opacity-75 flex justify-center p-4 z-50 overflow-scroll"
    @click="closeImageModal"
  >
    <div
      class="bg-white p-5 rounded-lg flex flex-col max-w-[50%] h-fit my-10 shadow-lg"
      @click.stop
    >
      <img
        :src="selectedImage.src"
        class="rounded-lg max-w-full max-h-[80vh] md:min-h-96"
      />
      <p class="text-gray-900 mt-4 text-center max-w-full">
        {{ selectedImage.description }}
      </p>
    </div>
  </div>

  <!-- مودال تعديل المعلومات -->
  <Modal
    v-if="showEditModal"
    @close="showEditModal = false"
    class="rounded-lg overflow-hidden"
  >
    <template v-slot:header>
      <h3 class="font-bold text-lg p-4">تعديل المعلومات</h3>
    </template>
    <template v-slot:default>
      <form @submit.prevent="saveChanges" class="space-y-4 p-4">
        <div>
          <label class="block mb-1 font-semibold">صورة الملف الشخصي:</label>
          <input
            type="file"
            @change="updateProfileImage"
            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
          />
          <img
            v-if="tempProfileImg"
            :src="tempProfileImg"
            class="w-20 h-20 mt-2 rounded-full mx-auto"
          />
        </div>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="block mb-1 font-semibold">الاسم:</label>
            <input
              v-model="tempCraftsman.name"
              type="text"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
              required
            />
          </div>
          <div>
            <label class="block mb-1 font-semibold">الحرفة:</label>
            <input
              v-model="tempCraftsman.type"
              type="text"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
              required
            />
          </div>
          <div>
            <label class="block mb-1 font-semibold">المكان:</label>
            <input
              v-model="tempCraftsman.place"
              type="text"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
              required
            />
          </div>
          <div>
            <label class="block mb-1 font-semibold">السعر:</label>
            <input
              v-model="tempCraftsman.price"
              type="text"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
              required
            />
          </div>
        </div>
        <div class="space-y-2">
          <div
            v-for="(image, index) in tempGalleryImages"
            :key="image.id"
            class="flex items-center justify-between space-x-2"
          >
            <img
              :src="image.src"
              alt="صورة"
              class="w-20 h-20 object-cover rounded-lg"
            />
            <button
              @click.prevent="removeTempImage(index)"
              type="button"
              class="btn-delete"
            >
              حذف
            </button>
          </div>
          <div class="mt-4">
            <label class="block mb-1 font-semibold">إضافة صورة جديدة:</label>
            <input
              type="file"
              @change="addNewImage"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            />
          </div>
        </div>
        <button type="submit" class="btn-save mt-4">حفظ التغييرات</button>
      </form>
    </template>
  </Modal>
  <FooterF />
</template>

<script>
// استيراد المكونات
import DashboardCard from "../components/craftsman/DashboardCard.vue";
import ProjectsList from "../components/craftsman/ProjectsList.vue";
import NavBarR from "../components/NavBarR.vue";
import ReviewsSection from "../components/craftsman/ReviewsSection.vue";
import ProfileSettings from "@/components/craftsman/ProfileSettings.vue";
import FooterF from "@/components/FooterF.vue";
import OrdersListC from "@/components/craftsman/OrdersListC.vue";
import Modal from "@/components/Modal.vue";

export default {
  components: {
    DashboardCard,
    ProjectsList,
    NavBarR,
    ReviewsSection,
    ProfileSettings,
    FooterF,
    OrdersListC,
    Modal,
  },
  data() {
    return {
      craftsmanGallery: [
        // Populate with objects containing image data
        {
          id: 1,
          src: "../public/build1.jpg",
          alt: "Description of work 1",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 2,
          src: "../public/build2.jpg",
          alt: "Description of work 2",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 3,
          src: "../public/build3.jpg",
          alt: "Description of work 2",
          description:
            "هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة. هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 4,
          src: "../public/HomeImg.jpg",
          alt: "Description of work 2",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 5,
          src: "../public/build3.jpg",
          alt: "Description of work 2",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 6,
          src: "../public/build3.jpg",
          alt: "Description of work 2",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        {
          id: 7,
          src: "../public/build3.jpg",
          alt: "Description of work 2",
          description: "هنا يمكنك إضافة وصف الصورة.",
        },
        // ...
      ],
      craftsman: {
        ProfileImg: "../public/HirfaType/Build.jpg",
        name: "إسم الحرفي",
        type: "بناء",
        place: "ولاية الوادي",
        price: "دج للمتر المربع 900",
      },
      showEditModal: true,
      newGalleryImages: [],
      deletedGalleryImages: [],
      tempCraftsman: {}, // تستخدم لتخزين التعديلات المؤقتة
      tempProfileImg: null, // لتخزين الصورة المؤقتة
      tempProfileImgFile: null, // لتخزين ملف الصورة المؤقت
      tempGalleryImagesFiles: [], // لتخزين ملفات الصور الجديدة المؤقتة
      newGalleryImagesDescriptions: [], // لتخزين وصف الصور الجديد
    };
  },
  methods: {
    openEditModal() {
      this.tempCraftsman = JSON.parse(JSON.stringify(this.craftsman));
      this.tempProfileImg = this.craftsman.ProfileImg;
      this.tempGalleryImages = JSON.parse(
        JSON.stringify(this.craftsmanGallery)
      );
      this.showEditModal = true;
    },

    updateProfileImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.tempProfileImg = URL.createObjectURL(file);
        this.tempProfileImgFile = file;
      }
    },

    addNewImage(event) {
      const file = event.target.files[0];
      if (file) {
        const imagePreview = URL.createObjectURL(file);
        this.tempGalleryImages.push({
          id: Date.now(),
          src: imagePreview,
          alt: "معاينة صورة",
          description: "", // وصف الصورة يمكن أن يضاف لاحقًا
        });
        this.tempGalleryImagesFiles.push(file);
        this.newGalleryImagesDescriptions.push(""); // إضافة وصف فارغ لكل صورة جديدة
      }
    },

    saveChanges() {
      // تحديث البيانات الأساسية للحرفي
      if (this.tempProfileImgFile) {
        // فرض أنه تم رفع الصورة وتحديث الـ URL هنا
        this.craftsman.ProfileImg = this.tempProfileImg;
      }

      this.craftsman = { ...this.tempCraftsman };
      // تحديث معرض الصور
      this.craftsmanGallery = [...this.tempGalleryImages];
      // إغلاق مودال التعديل
      this.showEditModal = false;
      // إعادة تعيين المتغيرات المؤقتة
      this.tempProfileImgFile = null;
      this.tempGalleryImagesFiles = [];
      this.newGalleryImagesDescriptions = [];
    },

    removeTempImage(index) {
      // حذف صورة من المعرض المؤقت
      if (index < this.tempGalleryImages.length) {
        this.tempGalleryImages.splice(index, 1);
        // تحديث الصور الجديدة وأوصافها إذا كانت الصورة جزءًا منها
        if (index < this.tempGalleryImagesFiles.length) {
          this.tempGalleryImagesFiles.splice(index, 1);
          this.newGalleryImagesDescriptions.splice(index, 1);
        }
      }
    },
  },
};
</script>
<style scoped>
.btn {
  @apply text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded;
}
.btn-save {
  @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow;
}

.btn-delete {
  @apply bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded shadow;
}

</style>
