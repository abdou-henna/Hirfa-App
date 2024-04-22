<template>
    <div>
      <!-- زر فتح الشاشة المنبثقة -->
      <button @click="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        أنشـاء طلــب
      </button>
  
      <!-- الشاشة المنبثقة -->
      <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[100]" @click.self="closeModal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
          <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">أنشاء طلب  جديد</h3>
            <form @submit.prevent="submitPost" class="mt-2 px-7 py-3">
              <input type="text" v-model="newPost.title" placeholder="عنوان الطلب" class="mb-4 p-2 w-full border rounded" required>
              <textarea v-model="newPost.content" placeholder="محتوى الطلب" class="mb-4 p-2 w-full border rounded" required></textarea>
              <select v-if="post" v-model="newPost.category" class="mb-4 p-2 w-full border rounded" required>
                <option disabled value="">اختر حرفة</option>
                <option value="حرفة 1">حرفة 1</option>
                <option value="حرفة 2">حرفة 2</option>
                <option value="حرفة 3">حرفة 3</option>
              </select>
              <input type="file" @change="handleFileUpload" class="mb-4 p-2 w-full border rounded">
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">{{ Forfor }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showModal: false,
        newPost: {
          title: '',
          content: '',
          category: '',
          image: null,
          // لا حاجة لتعريف userName و timestamp هنا لأنهما يتم توليدهما تلقائيًا
        },
      };
    },
    props:{
      Forfor: {
        type: String,
        default: 'نــشــر',
      },
      post: {
        type: Boolean,
        default: true,
      },
    },
    methods: {
      openModal() {
        this.showModal = true;
        // توليد اسم المستخدم والتوقيت تلقائيًا هنا أو في submitPost
      },
      closeModal() {
        this.showModal = false;
      },
      handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.newPost.image = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      },
      submitPost() {
        // توليد اسم المستخدم والتوقيت هنا، إذا لم يتم توليدهما في openModal
        const userName = "اسم المستخدم الفعلي"; // استبدل هذا بالطريقة التي تحصل بها على اسم المستخدم
        const timestamp = new Date().toLocaleString(); // توقيت النشر الفعلي
        const userImage = "https://via.placeholder.com/50"; // توقيت النشر الفعلي
  
        this.$emit('post-submitted', {
          ...this.newPost,
          userName,
          timestamp,
          userImage,
        });
  
        this.closeModal();
        // إعادة تعيين النموذج
        this.newPost = { title: '', content: '', category: '', image: null };
      },
    },
  };
  </script>
  