<template>
  <div class="container flex flex-col md:flex-row justify-center items-center">
    <div class="md:ml-8">
      <img
        src="../../../public/HomeImg.jpg"
        alt="وصف الصورة"
        class="max-w-xs md:max-w-xl"
      />
    </div>
    <div class="text-center md:text-right md:mr-8">
      <h1 class="text-4xl font-bold mb-4">
        <span v-for="char in typewriterText" :key="char.index">{{ char }}</span>
      </h1>
      <p class="text-xl">
        استكشف موقعنا لتصفح مجموعة واسعة من الحرفيين المتميزين واختر الخبراء
        الذين يمكنهم تحقيق رؤاك بأفضل الطرق.
      </p>
      <div
        class="flex flex-col md:flex-row justify-center md:justify-end space-y-4 md:space-y-0 md:space-x-4 mt-4"
      >
      <RouterLink :to="{name: 'login'}">
        <button
          class="px-6 py-2 border rounded-md text-lg font-medium hover:bg-hirfa-four-02"
        >
          تسجيل الدخول
        </button></RouterLink>
        <button
          class="px-6 py-2 bg-hirfa-one-02 text-white rounded-md text-lg font-medium hover:bg-hirfa-one-01"
        >
          إنشاء حساب
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      text: "! ابدأ رحلتك الإبداعية الآن ",
      typewriterText: "",
      index: 0,
    };
  },
  mounted() {
    this.typeWriterEffect();
  },
  methods: {
    typeWriterEffect() {
      if (this.index < this.text.length) {
        this.typewriterText += this.text.charAt(this.index);
        this.index++;
        setTimeout(this.typeWriterEffect, 150);
      }
    },
  },
};
</script>

<style >
@import "https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap";

.container {
  font-family: "Cairo", sans-serif;
}
</style>
