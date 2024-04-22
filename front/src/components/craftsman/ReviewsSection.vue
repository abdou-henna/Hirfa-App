<template>
  <div class="max-w-4xl p-4">
    <h2 class="text-2xl font-bold mb-5 mr-3">تقييمات العملاء</h2>
    <div class="space-y-4">
      <div
        v-for="review in reviews"
        :key="review.id"
        class="bg-white rounded-lg shadow-md p-6"
      >
        <div class="flex items-center mb-4">
          <div dir="ltr">
            <StarRating :rating="review.rating" />
          </div>
          <span class="mr-2 text-gray-600">{{ review.date }}</span>
        </div>
        <p class="text-gray-800">{{ review.text }}</p>
        <div class="text-right mt-4">
          <span class="text-sm font-semibold">{{ review.author }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "../StarRating.vue";

export default {
  components: {
    StarRating,
  },
  data() {
    return {
      reviews: [
        {
          id: 1,
          author: "أحمد خالد",
          rating: 4.5,
          date: "2023-01-15",
          text: "خدمة ممتازة وجودة عالية!",
        },
        {
          id: 2,
          author: "سلمى رشيد",
          rating: 5,
          date: "2023-02-20",
          text: "تجربة رائعة، أوصي بشدة بهذا الحرفي.",
        },
        // يمكن إضافة المزيد من التقييمات هنا
      ],
    };
  },
};
</script>

<style scoped>
/* يمكن تخصيص الأنماط هنا لتتناسب مع تصميم الموقع */
</style>
