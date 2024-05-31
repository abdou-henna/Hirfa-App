<template>
  <div>
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
          @click="showEditModal = true"
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
    <EditCraftsmanModal
      v-if="showEditModal"
      :craftsman="craftsman"
      @closeModal="showEditModal = false"
      @saveChanges="saveCraftsmanChanges"
    />
    <FooterF />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { craftsmen } from "@/assets/data.js";
import EditCraftsmanModal from "../components/EditCraftsmanModal.vue";


const route = useRoute();
const craftsman = ref(null);
const showEditModal = ref(false);

onMounted(() => {
  const id = 6;

  const foundCraftsman = craftsmen.find((c) => c.id === id);
  if (foundCraftsman) {
    craftsman.value = foundCraftsman;
  } else {
    console.error("Craftsman not found");
    console.error("id", id);
  }
});


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
      
    };
  },
  methods: {
    
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
