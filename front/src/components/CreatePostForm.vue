<template>
  <div>
    <button @click="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      أنشـاء طلــب
    </button>

    <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[100]" @click.self="closeModal">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <h3 class="text-lg leading-6 font-medium text-gray-900">أنشاء طلب جديد</h3>
          <form @submit.prevent="submitPost" class="mt-2 px-7 py-3">
            <input type="text" v-model="newPost.title" placeholder="عنوان الطلب" class="mb-4 p-2 w-full border rounded" required>
            <textarea v-model="newPost.content" placeholder="محتوى الطلب" class="mb-4 p-2 w-full border rounded" required></textarea>
            <label class="font-semibold">الحرفة</label>
            <select v-model="newPost.category" class="mb-4 p-2 w-full border rounded">
              <option v-for="x in crafts" :key="x.id" :value="x.id">{{ x.type }}</option>
            </select>
            <input type="file" @change="handleFileUpload" multiple class="mb-4 p-2 w-full border rounded">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">{{ Forfor }}</button>
          </form>
        </div>
      </div>
    </div>

    <!-- نافذة منبثقة للرسائل -->
    <div v-if="showMessageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[100]" @click.self="closeMessageModal">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <h3 class="text-lg leading-6 font-medium text-gray-900">{{ messageModalTitle }}</h3>
          <p class="mt-2">{{ messageModalContent }}</p>
          <button @click="closeMessageModal" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      showModal: false,
      showMessageModal: false, // لعرض النافذة المنبثقة للرسائل
      messageModalTitle: '', // عنوان الرسالة
      messageModalContent: '', // محتوى الرسالة
      crafts: '',
      newPost: {
        title: '',
        content: '',
        category: '',
        images: [],
      },
    };
  },
  created() {
    this.get_crafts();
  },
  props: {
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
    },
    async get_crafts() {
      const response = await axios.post('/get_crafts');
      this.crafts = response.data.data;
      console.log(response.data.data);
    },
    closeModal() {
      this.showModal = false;
    },
    closeMessageModal() {
      this.showMessageModal = false;
    },
    handleFileUpload(event) {
      const files = event.target.files;
      this.newPost.images = [];
      for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.newPost.images.push(e.target.result);
        };
        reader.readAsDataURL(files[i]);
      }
    },
    async submitPost() {
      try {
        const response = await axios.post('/request_projects', this.newPost);
        console.log(response);
        this.messageModalTitle = 'تم انشاء الطلب بنجاح';
        this.messageModalContent = 'تم إرسال طلبك بنجاح. شكراً لك!';
        this.showModal = false;
      } catch (error) {
        console.error('حدث خطأ أثناء إرسال الطلب:', error);
        this.messageModalTitle = 'فشل في انشاء الطلب';
        this.messageModalContent = 'حدث خطأ أثناء إرسال طلبك. الرجاء المحاولة مرة أخرى.';
      } finally {
        this.showMessageModal = true;
      }
      this.newPost = { title: '', content: '', category: '', images: [] };
    },
  },
};
</script>
