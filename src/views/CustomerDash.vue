<template>
    <nav-bar-r/>
    <div class=" container my-8  mx-auto p-4" dir="rtl">
      <h2 class="text-2xl text-center font-bold mb-6">لوحة التحكم للعميل</h2>
      <!-- إدارة الطلبات -->
      <div class="max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6 mb-6">
        <h3 class="font-semibold text-xl mb-4">طلباتي</h3>
        <OrderList />
      </div>
      <!-- مراجعاتي -->
      <div class=" max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6 mb-6">
        <h3 class="font-semibold text-xl mb-4">مراجعاتي</h3>
        <ReviewsSection />
      </div>
      <!-- إعدادات الحساب -->
      <div class="max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6">
        <h3 class="font-semibold text-xl mb-4">إعدادات الحساب</h3>
        <ProfileSettings />
      </div>
    </div>
    <FooterF/>
  </template>
  
  <script>
  import OrderList from '../components/customer/OrderList.vue';
  import ReviewsSection from '../components/customer/ReviewsSection.vue';
  import ProfileSettings from '../components/customer/ProfileSettings.vue';
  import NavBarR from '../components/NavBarR.vue';
  import FooterF from '../components/FooterF.vue';
  
  export default {
    components: {
      OrderList,
      ReviewsSection,
      ProfileSettings,
      NavBarR,
      FooterF,
    },
  };
  </script>
  