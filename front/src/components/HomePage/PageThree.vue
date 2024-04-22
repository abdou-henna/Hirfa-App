<template>
    <section class="pt-12 pb-24 " dir="rtl">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">مشاريع مميزة</h2>
        <div class="flex flex-wrap -m-4">
          <div v-for="project in projects" :key="project.id" class="lg:w-1/3 sm:w-1/2 p-4">
            <div class="bg-white relative shadow-lg hover:shadow-xl transition duration-500 rounded-lg">
              <img :src="project.image" alt="صورة المشروع" class="rounded-t-lg w-full h-60 object-cover" />
              <div class="py-6 px-8 rounded-lg bg-white">
                <h3 class="text-2xl font-semibold mb-3">{{ project.title }}</h3>
                <p class="text-gray-700 mb-4">{{ project.description }}</p>
                <a href="/projectdetails" class="underline text-hirfa-one-03 hover:text-hirfa-one-01">اقرأ المزيد</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        projects: [
          {
            id: 1,
            title: "تجديد المنزل",
            description: "مشروع تجديد شامل لمنزل بمساحة 200 متر مربع.",
            image: "/build1.jpg",
          },
          {
            id: 2,
            title: "إعادة تصميم حديقة",
            description: "تحويل الحديقة الخلفية إلى ملاذ خارجي مع مساحات للجلوس.",
            image: "/build2.jpg",
          },
          {
            id: 3,
            title: "تركيب الإضاءة",
            description: "مشروع إضاءة مخصص لإضافة جو دافئ ومريح للمنزل.",
            image: "/build3.jpg",
          },
        ],
      };
    },
  };
  </script>
  
  <style>

  </style>
  