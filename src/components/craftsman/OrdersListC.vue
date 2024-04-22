<template>
    <div class=" max-w-4xl  p-4 mr-3">
      <h2 class="text-2xl font-bold mb-6">قائمة طلبات الخدمات</h2>
      <div class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <table class="min-w-full">
          <thead>
            <tr class="border-b">
              <th class="text-right px-2 py-3">عنوان الطلب</th>
              <th class="text-right px-2 py-3">التاريخ</th>
              <th class="text-right px-2 py-3">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders" :key="order.id" class="border-b">
              <td class="px-2 py-3">{{ order.name }}</td>
              <td class="px-2 py-3">{{ order.date }}</td>
              <td class="px-2 py-3">
                <button class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض</button>
                <button class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded mr-2">حذف</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        orders: [
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          { id: 1, name: "تجديد المطبخ",  date: "2024-04-12" },
          // يمكن إضافة المزيد من الطلبات هنا
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  /* يمكن تخصيص الأنماط هنا لتتناسب مع تصميم الموقع */
  </style>
  