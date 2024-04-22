<template>
    <div class="max-w-xl mx-auto p-4">
      <h2 class="text-2xl font-semibold mb-6">إعدادات الملف الشخصي</h2>
      <form @submit.prevent="updateProfile">
        <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-700">الاسم</label>
          <input type="text" id="name" v-model="profile.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-700">البريد الإلكتروني</label>
          <input type="email" id="email" v-model="profile.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-700">كلمة المرور الجديدة</label>
          <input type="password" id="password" v-model="profile.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <!-- أضف هنا المزيد من الحقول حسب الحاجة -->
        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">تحديث الملف الشخصي</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        profile: {
          name: '',
          email: '',
          password: '',
        },
      };
    },
    methods: {
      updateProfile() {
        // هنا يمكن إضافة الطلب لتحديث معلومات الملف الشخصي
        console.log("Profile updated", this.profile);
        // يفترض أن تكون هناك معالجة فعلية للبيانات، مثل إرسالها إلى API
      },
    },
  };
  </script>
  