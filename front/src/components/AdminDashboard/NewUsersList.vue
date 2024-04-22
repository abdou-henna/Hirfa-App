<template>
    <div class="bg-white rounded-lg shadow">
      <h2 class="text-xl font-semibold p-5 bg-gray-100">المستخدمون الجدد</h2>
      <div class="p-5">
        <ul class="space-y-4">
          <li v-for="user in users" :key="user.id" class="flex items-center justify-between">
            <div>
              <h3 class="text-md font-semibold">{{ user.name }}</h3>
              <p class="text-sm text-gray-600">تاريخ الانضمام: {{ user.joinDate }}</p>
            </div>
            <button @click="viewUserProfile(user.id)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض الملف الشخصي</button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: [
          { id: 1, name: "أحمد علي", joinDate: "2024-04-01" },
          { id: 1, name: "أحمد علي", joinDate: "2024-04-01" },
          { id: 1, name: "أحمد علي", joinDate: "2024-04-01" },
          { id: 1, name: "أحمد علي", joinDate: "2024-04-01" },
          // يمكن إضافة المزيد من المستخدمين هنا
        ],
      };
    },
    methods: {
      viewUserProfile(userId) {
        // منطق لعرض ملف المستخدم الشخصي
        console.log("Viewing user profile:", userId);
        // في التطبيق الحقيقي، يمكن استخدام this.$router.push() للانتقال إلى صفحة المستخدم
      },
    },
  };
  </script>
  
  <style scoped>
  /* يمكن تخصيص الأنماط هنا */
  </style>
  