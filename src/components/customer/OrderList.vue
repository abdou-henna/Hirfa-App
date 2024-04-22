<template>
    <div class="">
      <h3 class=" text-lg font-semibold mb-4">طلباتي</h3>
      <div class="divide-y divide-gray-200">
        <div v-for="order in orders" :key="order.id" class="py-4 flex justify-between items-center">
          <div>
            <h4 class="text-md font-medium">{{ order.name }}</h4>
            <p class="text-sm text-gray-600">التاريخ: {{ order.date }}</p>
          </div>
          <span
            :class="{
              'bg-green-100 text-green-800': order.status === 'مكتمل',
              'bg-yellow-100 text-yellow-800': order.status === 'جاري',
              'bg-red-100 text-red-800': order.status === 'ملغى',
            }"
            class="px-3 py-1 rounded-full text-sm font-semibold"
          >
            {{ order.status }}
          </span>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        orders: [
          { id: 1, name: "تجديد المطبخ", date: "2024-04-12", status: "مكتمل" },
          { id: 2, name: "تصميم الحديقة", date: "2024-05-05", status: "جاري" },
          { id: 3, name: "دهان الواجهة الخارجية", date: "2024-03-22", status: "ملغى" },
          // أضف المزيد من الطلبات حسب الحاجة
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  /* يمكن تخصيص الأنماط هنا */
  </style>
  