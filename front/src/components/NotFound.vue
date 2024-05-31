<template>
    <div class="flex flex-col min-h-screen">
      <nav-bar-r />
      <div class="container flex flex-col items-center justify-center flex-grow ">
        <div class="text-center p-4">
            <router-link to="/" >
          <img src="@/assets/craftsman-image.png" alt="Craftsman Tools" class="w-full  mx-auto mb-8"/>
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import FooterF from './FooterF.vue';
  import NavBarR from "./NavBarR.vue";
  export default {
    components: { NavBarR, FooterF },
    name: "NotFound",
  };
  </script>
  
  <style scoped>
  /* يمكنك إضافة المزيد من التعديلات النمطية هنا إذا لزم الأمر */
  </style>
  