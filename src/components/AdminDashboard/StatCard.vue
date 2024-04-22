<template>
    <div class="bg-white rounded-lg shadow p-5 hover:shadow-lg transition-shadow duration-300 ease-in-out">
      <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
      <p class="text-3xl font-bold text-blue-600">{{ value }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: {
        type: String,
        required: true,
      },
      value: {
        type: [String, Number],
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  /* إضافة تخصيصات CSS هنا إذا لزم الأمر */
  </style>
  