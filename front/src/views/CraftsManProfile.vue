<template>
  <div>
    <NavBarR />
    <div
      class="flex flex-col container min-h-screen p-6 bg-white shadow"
      v-if="craftsman"
    >
      <!-- المحتوى الأساسي للصفحة -->
      <div class="text-center flex flex-col items-center">
        <!-- عرض صورة الحرفي ومعلوماته -->
        <div class="mb-4">
          <img
            class="w-40 h-40 rounded-full border-4 border-blue-500"
            :src="craftsman.ProfileImg"
            alt="Craftsman Profile"
          />
        </div>
        <div class="mb-4">
          <h2 class="text-gray-800 font-bold text-4xl">{{ craftsman.name }}</h2>
        </div>
        <!-- عرض تفاصيل الحرفة والمكان والسعر -->
        <div class="mb-4 space-y-2" >
          <p class="text-gray-700"> الحرفة : {{ craftsman.type }}</p>
          <p class="text-gray-700"> المكان : {{ craftsman.place }} </p>
          <p class="text-gray-700"> السعر : {{ craftsman.price }} </p>
        </div>
        <!-- عرض تقييمات العملاء -->
        <div
          class="mb-8 flex flex-col items-center justify-center cursor-pointer"
          @click="showModal = true"
        >
          <star-rating
            :rating="craftsman.rating"
            :read-only="true"
            starSize="3"
          ></star-rating>
          <p class="text-sm text-gray-600 mt-2">
            عدد العملاء الذين تعاملوا مع الحرفي: {{ reviews.length }}
          </p>
        </div>
      </div>

      <!-- معرض صور الحرفي -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div
          v-for="image in craftsman.craftsmanGallery"
          :key="image.id"
          class="rounded-lg overflow-hidden cursor-pointer"
          @click="
            selectedImage = image;
            showModal1 = true;
          "
        >
          <img
            :src="image.src"
            :alt="image.alt"
            class="w-full h-full object-cover rounded-lg"
          />
        </div>
      </div>
      <!-- زر الاتصال بالحرفي -->
      <div class="flex justify-center my-20" dir="rtl">
        <create-post-form Forfor="إرسال الطلب" :post="false" />
      </div>
    </div>
    <div v-else>
      <p>جاري تحميل بيانات الحرفي...</p>
    </div>

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

    <footer-f class="z-30"></footer-f>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { craftsmen } from "@/assets/data.js";
import StarRating from "../components/StarRating.vue";
import Modal from "../components/Modal.vue";
import FooterF from "../components/FooterF.vue";
import NavBarR from "../components/NavBarR.vue";
import CreatePostForm from "../components/CreatePostForm.vue";

const route = useRoute();
const craftsman = ref(null);

onMounted(() => {
  const id = parseInt(route.params.id);

  const foundCraftsman = craftsmen.find((c) => c.id === id);
  if (foundCraftsman) {
    craftsman.value = foundCraftsman;
    // مثلاً إذا كان لدينا بيانات المعرض والمراجعات في الكائن
  } else {
    // Handle error, e.g., show message or redirect
    console.error("Craftsman not found");
    console.error( "id", id);
  }
});
</script>
<script>
export default {
  name: "CraftsmanProfile",
  data() {
    return {

      showModal: false,
      reviews: [
        { id: 1, rating: 5, customerName: "1عميل", comment: "عمل ممتاز!" },
        { id: 2, rating: 4.6, customerName: "2عميل", comment: "عمل ممتاز!" },
        { id: 3, rating: 2, customerName: "3عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
        { id: 4, rating: 3.5, customerName: "4عميل", comment: "عمل ممتاز!" },
      ],
      showModal1: false,
      selectedImage: null,
      isOwner: true, // يُفترض أن هذه القيمة ستتحدد بناءً على ما إذا كان المستخدم هو صاحب الصفحة
      showEditModal: false,

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
    

    

    
    

    closeImageModal() {
      this.showModal1 = false;
      this.selectedImage = null;
    },
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Jomhuria&display=swap");
.font-jomhuria {
  font-family: "Jomhuria", serif;
  font-weight: 400;
  font-style: normal;
}
</style>
<style scoped>
.btn {
  @apply text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded;
}

/* استعلامات الوسائط للشاشات الكبيرة */
@media (min-width: 768px) {
  .modal-content {
    min-width: 1000px; /* الحد الأدنى لعرض الحاوية */
    min-height: 800px; /* الحد الأدنى لارتفاع الحاوية */
  }
}
</style>
<style scoped>
.btn-save {
  @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow;
}

.btn-delete {
  @apply bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded shadow;
}

.form-input {
  @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm;
}
</style>
