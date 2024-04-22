<template>
    <div class="max-w-4xl mx-auto p-4">
      <h2 class="text-2xl font-bold mb-5">المراجعات والتقييمات</h2>
      <div class="space-y-6">
        <div v-for="review in reviews" :key="review.id" class="bg-white rounded-lg shadow overflow-hidden">
          <div class="p-5">
            <div class="flex items-center mb-1">
              <h3 class="text-lg font-semibold">{{ review.author }}</h3>
              <StarRating :rating="review.rating" class="mr-2" />
            </div>
            <p class="text-sm text-gray-600">تاريخ: {{ review.date }}</p>
            <p class="mt-2">{{ review.content }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import StarRating from '../StarRating.vue';
  
  export default {
    components: {
      StarRating,
    },
    data() {
      return {
        reviews: [
          {
            id: 1,
            author: "علي حسن",
            rating: 4,
            date: "2024-04-01",
            content: "خدمة ممتازة وتجربة رائعة، سأتعامل معهم مجددًا!",
          },
          {
            id: 1,
            author: "علي حسن",
            rating: 4,
            date: "2024-04-01",
            content: "خدمة ممتازة وتجربة رائعة، سأتعامل معهم مجددًا!",
          },
          {
            id: 1,
            author: "علي حسن",
            rating: 4,
            date: "2024-04-01",
            content: "خدمة ممتازة وتجربة رائعة، سأتعامل معهم مجددًا!",
          },
          // يمكن إضافة المزيد من المراجعات هنا
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  /* يمكن تخصيص الأنماط هنا */
  </style>
  