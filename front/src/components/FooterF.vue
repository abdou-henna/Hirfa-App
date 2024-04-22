<template>
    <footer class=" container min-h-72  bg-hirfa-four-02 text-gray-800 bg-opacity-70 p-4 relative  shadow-lgss ">
      <div class=" mx-auto flex flex-col  items-center">
        <ul class="flex flex-wrap items-center space-x-7 rtl:space-x-reverse mb-8 mt-4 ">
          <li><a href="#" class="hover:text-gray-300 text-md md:text-xl">الرئيسية</a></li>
          <li><a href="#" class="hover:text-gray-300 text-md md:text-xl">عن المنصة</a></li>
          <li><a href="#" class="hover:text-gray-300 text-md md:text-xl">الخدمات</a></li>
          <li><a href="#" class="hover:text-gray-300 text-md md:text-xl">اتصل بنا</a></li>
        </ul>
        <div class="flex items-center mb-8">
          <img src="../../public/Hirfa.png" alt="Hirfa Logo" class="w-24  mr-2"> 
        </div>
        <div class="flex space-x-7 mb-8">
          <a href="#" class="text-gray-500 text-2xl hover:text-white transition-colors duration-200">
            <i class="fab fa-facebook-f"></i> 
          </a>
          <a href="#" class="text-gray-500 text-2xl hover:text-white transition-colors duration-200">
            <i class="fab fa-twitter"></i> 
          </a>
          <a href="#" class="text-gray-500 text-2xl hover:text-white transition-colors duration-200">
            <i class="fab fa-instagram"></i> 
          </a>
        </div>
      </div>
      <p class="text-center text-lg mt-4">جميع الحقوق محفوظة © 2024 Hirfa</p>
    </footer>
  </template>
  
  <script>
  export default {
    name: 'Footer',
  }
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
  
  footer {
    font-family: 'Cairo', sans-serif;

  }
  
  </style>
  