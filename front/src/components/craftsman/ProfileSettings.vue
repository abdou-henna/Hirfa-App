<template>
    <div class="max-w-4xl  p-4 mr-3 ">
      <h2 class="text-2xl font-bold mb-6">إعدادات الحساب </h2>
      <form @submit.prevent="updateProfile" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <div>
          <label class="block text-sm font-medium text-gray-700">الاسم</label>
          <input v-model="user.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
          <input v-model="user.email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">كلمة المرور الجديدة</label>
          <input v-model="user.newPassword" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <!-- يمكن إضافة المزيد من الحقول حسب الحاجة -->
        <div class="text-right">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            تحديث الملف الشخصي
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: {
          name: '',
          email: '',
          newPassword: '',
          // يمكن إضافة المزيد من البيانات هنا
        },
      };
    },
    methods: {
      updateProfile() {
        // منطق لتحديث معلومات الملف الشخصي
        console.log("تم تحديث الملف الشخصي بنجاح", this.user);
        // هنا يمكن إضافة الاتصال بAPI لتحديث الملف الشخصي
      },
    },
  };
  </script>
  