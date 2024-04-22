<template>
    <div class=" p-6 max-w-lg  mx-auto">
      <h3 class="text-2xl  font-bold mb-5 mr-3">لوحة التحكم</h3>
      <div class=" bg-white p-6 rounded-lg shadow-md grid grid-cols-2 gap-4">
        <div class="stat" v-for="item in stats" :key="item.title">
          <p class="stat-title">{{ item.title }}</p>
          <p class="stat-value" v-if="item.title !== 'التقييم الإجمالي'">{{ item.value }}</p>
          <div dir="ltr" v-else>
            <StarRating :rating="item.value" />
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
        stats: [
          { title: 'المشاريع الجارية', value: 5 },
          { title: 'المشاريع المكتملة', value: 12 },
          { title: 'التقييم الإجمالي', value: 4  },
          { title: 'الرسائل الجديدة', value: 3 },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .stat {
    @apply text-center;
  }
  .stat-title {
    @apply text-gray-600;
  }
  .stat-value {
    @apply text-xl font-bold;
  }
  </style>
  