<template>
    <section class="container    py-12 " dir="rtl">
      <div class=" mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-8 ">{{ project.title }}</h2>
        <div class="flex flex-wrap lg:flex-nowrap gap-10 justify-center items-start">
          <img :src="project.image" alt="صورة المشروع" class="lg:w-1/2 rounded-lg shadow-lg max-h-96 w-1/2 object-cover">
          <div class="lg:w-1/2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-2xl font-semibold mb-4">وصف المشروع</h3>
              <p class="text-gray-600">{{ project.description }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
              <h4 class="text-xl font-semibold mb-3">تفاصيل المشروع</h4>
              <p><span class="font-semibold">الحرفي المسؤول:</span> {{ project.craftsman }}</p>
              <p><span class="font-semibold">المدة الزمنية:</span> {{ project.duration }}</p>
              <button
                @click="contactCraftsman"
                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300"
              >
                اتصل بالحرفي
              </button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-2xl font-semibold mb-2">تعليقات العملاء</h3>
              <ul class="space-y-4">
                <li v-for="comment in project.comments" :key="comment.id">
                  <p class="font-semibold">{{ comment.user }}</p>
                  <p class="text-gray-600">{{ comment.content }}</p>
                </li>
              </ul>
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
        project: {
          title: "تجديد المنزل الريفي",
          image: "/build1.jpg",
          description: "وصف مفصل للمشروع، بما في ذلك التحديات التي تم التغلب عليها، الحلول المبتكرة التي تم استخدامها، والنتائج النهائية.",
          craftsman: "أحمد الحرفي",
          duration: "3 أشهر",
          comments: [
            { id: 1, user: "عمر العميل", content: "كانت النتائج مذهلة، شكراً لفريق العمل!" },
            { id: 2, user: "ليلى العميلة", content: "تجربة رائعة من البداية إلى النهاية. أوصي بهم بشدة." },
          ],
        },
      };
    },
    methods: {
      contactCraftsman() {
        // يمكن هنا إضافة الوظيفة اللازمة للاتصال بالحرفي، مثل فتح نموذج الاتصال أو إرسال بريد إلكتروني
        alert("هذه الوظيفة لتوضيح الفكرة. يجب تنفيذ الطريقة الفعلية للاتصال بالحرفي.");
      }
    },
  };
  </script>
  