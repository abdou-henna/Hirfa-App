<template>
    <div class="max-w-4xl mx-auto p-4">
      <h2 class="text-2xl font-bold mb-5 mr-3">قائمة الخدمات</h2>
      <div class="space-y-4">
        <div v-for="project in projects" :key="project.id" class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center">
          <div>
            <h3 class="text-xl font-semibold">{{ project.name }}</h3>
            <p class="text-gray-600">{{ project.description }}</p>
            <span class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm font-semibold mr-2">{{ project.status }}</span>
          </div>
          <button @click="goToProject(project.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-4 rounded">
            عرض التفاصيل
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        projects: [
          { id: 1, name: ' تجديد المنزل', description: 'تجديد شامل للمنزل بتصاميم عصرية.', status: 'مكتمل' },
          { id: 2, name: 'تصميم الحديقة الخارجية', description: 'إعادة تصميم الحديقة لتصبح أكثر جمالاً.', status: 'جاري' },
          { id: 2, name: 'تصميم الحديقة الخارجية', description: 'إعادة تصميم الحديقة لتصبح أكثر جمالاً.', status: 'جاري' },
          // يمكن إضافة المزيد من المشاريع هنا
        ],
      };
    },
    methods: {
      goToProject(projectId) {
        // منطق للانتقال إلى صفحة تفاصيل المشروع
        // يمكن استخدام this.$router.push({ name: 'ProjectDetails', params: { projectId } })
        console.log("انتقال إلى تفاصيل المشروع:", projectId);
      }
    },
  };
  </script>
  
  <style scoped>
  /* يمكن تخصيص الأنماط هنا */
  </style>
  