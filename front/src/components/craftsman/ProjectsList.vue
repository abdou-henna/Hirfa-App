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
        <button @click="showProjectDetails(project)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-4 rounded">
          عرض التفاصيل
        </button>
      </div>
    </div>

    <!-- نافذة منبثقة لعرض تفاصيل المشروع -->
    <transition name="fade">
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-2xl relative">
          <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <h3 class="text-2xl font-semibold mb-4 text-center">تفاصيل المشروع</h3>
          <div class="flex flex-col items-center">
            <img :src="selectedProject.profileImg" alt="Profile Image" class="w-32 h-32 rounded-full mb-4">
            <p><strong>الاسم الكامل:</strong> {{ selectedProject.userName }}</p>
            <p><strong>عنوان:</strong> {{ selectedProject.userAddress }}</p>
            <p><strong>عنوان الطلب:</strong> {{ selectedProject.name }}</p>
            <p><strong>موضوع الطلب:</strong> {{ selectedProject.subject }}</p>
            <div v-if="selectedProject.attachment">
              <img :src="selectedProject.attachment" alt="Attachment" class="w-full h-auto rounded-lg shadow mt-4">
            </div>
            <div class="flex justify-end gap-4 mt-6">
              <button v-if="selectedProject.status === 'جاري'" class="text-white bg-yellow-500 hover:bg-yellow-700 px-4 py-2 rounded">جاري</button>
              <button v-else class="text-white bg-green-500 hover:bg-green-700 px-4 py-2 rounded">مكتمل</button>
            </div>
            <p class="text-sm text-gray-500 mt-4">
              إذا تعدى على الطلب يومين سوف يرفض تلقائيًا وتُرسل رسالة بعدم قبوله لأن الحرفي مشغول.
            </p>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showModal: false,
      selectedProject: null,
      projects: [
        {
          id: 1,
          name: 'تجديد المنزل',
          description: 'تجديد شامل للمنزل بتصاميم عصرية.',
          status: 'مكتمل',
          userName: "محمد أحمد",
          userAddress: "الجزائر",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg",
          subject: "تجديد المطبخ بالكامل، تغيير الأرضيات والخزائن.",
          attachment: "../../../public/Craftsmen/electrician/gallery/work3.jpg",
        },
        {
          id: 2,
          name: 'تصميم الحديقة الخارجية',
          description: 'إعادة تصميم الحديقة لتصبح أكثر جمالاً.',
          status: 'جاري',
          userName: "علي حسين",
          userAddress: "الجزائر",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg",
          subject: "تصميم جديد للحديقة باستخدام عناصر طبيعية.",
          attachment: null,
        },
        // يمكن إضافة المزيد من المشاريع هنا
      ],
    };
  },
  methods: {
    showProjectDetails(project) {
      this.selectedProject = project;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.selectedProject = null;
    },
  },
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
</style>
