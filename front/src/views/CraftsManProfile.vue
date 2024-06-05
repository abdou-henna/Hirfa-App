<template>
  <div >
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
            class="w-40 h-40 rounded-full border-4 border-blue-500 cursor-pointer"
            :src="craftsman.ProfileImg"
            @click="triggerProfileImgUpload"
            alt="Craftsman Profile"
          />
          <input type="file" ref="profileImgInput" class="hidden" @change="handleProfileImgChange" />
        </div>
        <div class="mb-4">
          <h2 class="text-gray-800 font-bold text-4xl">{{ craftsman.name }}</h2>
        </div>
        <!-- عرض تفاصيل الحرفة والمكان والسعر -->
        <div class="mb-4 space-y-2">
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
        <!-- زر لتعديل البيانات -->
        <div v-if="isOwner" class="mt-4">
          <button @click="showEditModal = true" class="btn">تعديل البيانات</button>
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
      <div v-if="!isOwner" class="flex justify-center my-20" dir="rtl">
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
    <EditCraftsmanModal
      v-if="showEditModal"
      :craftsman="craftsman"
      @closeModal="showEditModal = false"
      @saveChanges="saveCraftsmanChanges"
    />

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
import EditCraftsmanModal from "../components/EditCraftsmanModal.vue";

const route = useRoute();
const craftsman = ref(null);
const showModal = ref(false);
const showModal1 = ref(false);
const selectedImage = ref(null);
const showEditModal = ref(false);
const reviews = ref([
  { id: 1, rating: 5, customerName: "عميل 1", comment: "عمل ممتاز!" },
  { id: 2, rating: 4.6, customerName: "عميل 2", comment: "عمل ممتاز!" },
  { id: 3, rating: 2, customerName: "عميل 3", comment: "عمل ممتاز!" },
  { id: 4, rating: 3.5, customerName: "عميل 4", comment: "عمل ممتاز!" },
  // أضف المزيد من التقييمات هنا
]);
const isOwner = ref(false);

onMounted(() => {
  const id = parseInt(route.params.id);

  const foundCraftsman = craftsmen.find((c) => c.id === id);
  if (foundCraftsman) {
    craftsman.value = foundCraftsman;
  } else {
    console.error("Craftsman not found");
    console.error("id", id);
  }
});

const closeImageModal = () => {
  showModal1.value = false;
  selectedImage.value = null;
};

const saveCraftsmanChanges = (updatedCraftsman, newGalleryImages) => {
  craftsman.value = updatedCraftsman;
  if (newGalleryImages.length > 0) {
    newGalleryImages.forEach(image => {
      craftsman.value.craftsmanGallery.push({ src: image.src, description: image.description });
    });
  }
  showEditModal.value = false;
};
</script>

<style scoped>
.btn {
  @apply text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded;
}
</style>
