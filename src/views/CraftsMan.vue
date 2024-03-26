<template>
  <div class=" flex flex-col container min-h-screen p-6 rounded-lg shadow-lg">
    <div class="text-center flex flex-col">
      <div class="mb-4">
        <!-- Image Placeholder for the Craftsman -->
        <img
          class="w-40 h-40 rounded-full mx-auto"
          src="../../public/HirfaType/Build.jpg"
          alt="Craftsman Profile"
        />
      </div>
      <div class="mb-4">
        <h2 class="text-gray-800 font-jomhuria text-5xl">
          {{ craftsman.name }}
        </h2>
      </div>
      <div class="mb-4 ">
        <div >
          <p class="text-gray-600 inline-block mx-1">{{ craftsman.type }}</p>
          <p class="text-gray-600 inline-block mx-1">:  الحرفة</p>
        </div>
        <div >
          <p class="text-gray-600 inline-block mx-1">{{ craftsman.place }}</p>
          <p class="text-gray-600 inline-block mx-1">:  المكان</p>
        </div>
        <div >
          <p class="text-gray-600 inline-block mx-1">{{ craftsman.price }}</p>
          <p class="text-gray-600 inline-block mx-1">:  السعر</p>
        </div>
      </div>
      <div class="mb-4 flex justify-center cursor-pointer">
        <!-- Star Rating Component -->
        <star-rating
          :rating="craftsmanRating"
          :read-only="true"
          starSize="3"
          @click="showModal = true"
        ></star-rating>
      </div>
    </div>

    <!-- Craftsman Gallery -->
    <div class="grid grid-row md:grid-cols-3 gap-4">
      <div
        v-for="image in craftsmanGallery"
        :key="image.id"
        class="rounded-lg overflow-hidden"
      >
        <img
          :src="image.src"
          :alt="image.alt"
          class="w-full h-full object-cover"
        />
      </div>
    </div>
    <div class=" flex justify-center">
    <button class="btn my-20  w-1/3  "> الإتصال بالحرفي </button></div>
    <Modal v-if="showModal" @close="showModal = false">
      <template v-slot:header>
        <h3 class="font-bold text-lg">تقييمات العملاء</h3>
      </template>
      <template v-slot:default>
        <div v-for="review in reviews" :key="review.id" class="border-b py-2">
          <div class="flex items-center mb-1">
            <span class="ml-2 text-sm text-gray-600">
              {{ review.customerName }}</span
            >
            <div dir="ltr">
            <star-rating
              :rating="review.rating"
              :read-only="true"
            ></star-rating></div>
          </div>
          <p class="text-gray-600">{{ review.comment }}</p>
        </div>
      </template>
    </Modal>
  </div>
</template>
<script setup>
import StarRating from "../components/StarRating.vue";
import Modal from "../components/modal.vue";
</script>
<script>
export default {
  name: "CraftsmanProfile",
  data() {
    return {
      craftsmanRating: 4.5,
      craftsmanGallery: [
        // Populate with objects containing image data
        { id: 1, src: "../public/build1.jpg", alt: "Description of work 1" },
        { id: 2, src: "../public/build2.jpg", alt: "Description of work 2" },
        { id: 3, src: "../public/build3.jpg", alt: "Description of work 2" },
        { id: 4, src: "../public/build3.jpg", alt: "Description of work 2" },
        { id: 5, src: "../public/build3.jpg", alt: "Description of work 2" },
        { id: 6, src: "../public/build3.jpg", alt: "Description of work 2" },
        { id: 7, src: "../public/build3.jpg", alt: "Description of work 2" },
        // ...
      ],
      craftsman: {
        name: "إسم الحرفي",
        type: "بناء",
        place: "ولاية الوادي",
        price: "دج للمتر المربع 900",
      },
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
    };
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
</style>
