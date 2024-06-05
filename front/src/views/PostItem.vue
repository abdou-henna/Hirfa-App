<template>
  <div>
    <nav-bar-r></nav-bar-r>
    <div class="container flex flex-col justify-center items-center py-20 mx-auto bg-white shadow-md overflow-hidden" dir="rtl">
      <div class="flex flex-col md:flex-row justify-between items-center w-full md:w-[60%] mb-10">
        <div class="flex flex-col md:flex-row gap-4 mb-8 md:mb-2 w-full md:w-fit">
          <select v-model="selectedUser" class="border border-gray-300 rounded-lg p-2">
            <option value="">جميع المنشورات</option>
            <option :value="currentUser">منشوراتي</option>
          </select>

          <select v-model="selectedCategory" class="mb-4 p-2 w-full border rounded">
              <option value="">جميع الفئات</option>
              <option v-for="x in crafts" :key="x.id" :value="x.id">{{ x.type }}</option>
            </select>
          <select v-model="selectedTime" class="border border-gray-300 rounded-lg p-2">
            <option value="">أي وقت</option>
            <option value="hour">قبل ساعة</option>
            <option value="day">قبل يوم</option>
            <option value="week">قبل أسبوع</option>
          </select>
        </div>
        <create-post-form v-if="!isCraftsman" @post-submitted="handlePostSubmit"/>
      </div>
      <div v-for="(post, index) in filteredPosts" :key="index" class="flex flex-col border-b md:w-[60%] border-gray-200 last:border-0 mt-20">
        <div class="flex flex-row justify-between">
          <div class="p-4 flex">
            <img :src="imagePath" alt="User image" class="h-12 w-12 rounded-full border"/>
            <div class="flex flex-col mr-2">
              <div class="text-sm font-semibold text-gray-900">{{ post.user.firstName }}</div>
              <div class="text-sm text-gray-500">{{ post.date }}</div>
            </div>
          </div>
          <div v-if="post.user.id === currentUser && !isCraftsman" @click="openModal(post)" class="cursor-pointer">
            <i class="fa-solid fa-pen-to-square fa-lg"></i>
          </div>
        </div>
        <div class="p-4">
          <div class="text-lg font-medium text-gray-900">{{ post.title }}</div>
          <p class="mt-2 text-gray-700">{{ post.content }}</p>
          <div class="flex mt-6 flex-row justify-between">
            <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{ post.crafts.type }}</span>
            <div v-if="isCraftsman" class="cursor-pointer ml-6">
              <RouterLink :to="{ name: 'message' }">
                <i class="fa-solid fa-message fa-lg"></i>
              </RouterLink>
            </div>
          </div>
        </div>
        <div class="flex justify-between items-center p-4">
          <img v-if="post.image_project.length > 0" :src="post.image_project[0].url" alt="Post image" class="w-full md:w-[95%] object-contain"/>
        </div>
      </div>
    </div>
    <Modal v-if="isModalOpen" @close="isModalOpen = false">
      <template v-slot:header>
        <h2 class="text-xl font-semibold mb-4">تعديل المنشور</h2>
      </template>
      <template v-slot:default>
        <form @submit.prevent="saveChanges">
          <div class="bg-white rounded-lg max-w-xl w-full overflow-hidden p-5">
            <span class="block mb-2 text-md font-medium text-gray-700">عنوان المنشور</span>
            <input v-model="currentPost.title" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="عنوان المنشور"/>
            <span class="block mb-2 text-md font-medium text-gray-700">محتوى المنشور</span>
            <textarea v-model="currentPost.content" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="محتوى المنشور" rows="4"></textarea>
            <div class="mb-4">
              <label class="block mb-2 text-md font-medium text-gray-700">فئة المنشور:</label>
              <select v-model="currentPost.category" class="w-full p-2 border border-gray-300 rounded">
                <option disabled value="">اختر فئة</option>
                <option value="1">حرفة 1</option>
                <option value="2">حرفة 2</option>
                <option value="3">حرفة 3</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-md font-medium text-gray-700">تحديث الصورة:</label>
              <input type="file" @change="handleImageUpload" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            </div>
            <div v-if="currentPost.image" class="mb-4">
              <img :src="currentPost.image" alt="معاينة الصورة" class="rounded max-h-40 mx-auto"/>
            </div>
            <div class="flex items-center mb-4">
              <input type="checkbox" v-model="currentPost.isCompleted" id="completedCheckbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300"/>
              <label for="completedCheckbox" class="mr-2 text-md font-medium text-gray-700">تم الإنجاز</label>
            </div>
            <div class="flex justify-start space-x-4 p-3">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded ml-4">حفظ التغييرات</button>
              <button @click="isModalOpen = false" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded ml-4">إلغاء</button>
            </div>
          </div>
        </form>
      </template>
    </Modal>
  </div>
</template>

<script>
import NavBarR from "../components/NavBarR.vue";
import CreatePostForm from "../components/CreatePostForm.vue";
import moment from "moment";
import Modal from "@/components/Modal.vue";
import axios from 'axios';

export default {
  components: {
    CreatePostForm,
    Modal,
    NavBarR,
  },
  data() {
    return {
      imagePath: '/HirfaType/Build.jpg',
      isCraftsman: false,
      crafts:'',
      selectedUser: "",
      selectedCategory: "",
      selectedTime: "",
      postes: [],
      currentPost: null, // لتخزين المنشور الحالي الذي يتم تعديله
      isModalOpen: false, // للتحكم في إظهار وإخفاء الشاشة المنبثقة
      currentUser: "user3",
    };
  },
  created() {
    this.fetchPosts();
    this.get_crafts();
  },
  computed: {
    filteredPosts() {
      return this.postes.filter((post) => {
        const postTime = moment(post.date);
        const now = moment();
        let timeCondition = true;

        switch (this.selectedTime) {
          case "hour":
            timeCondition = now.diff(postTime, "hours") < 1;
            break;
          case "day":
            timeCondition = now.diff(postTime, "days") < 1;
            break;
          case "week":
            timeCondition = now.diff(postTime, "weeks") < 1;
            break;
        }

        return (
          (this.selectedCategory ? post.id_crafts === parseInt(this.selectedCategory) : true) &&
          (this.selectedUser ? post.id_user === this.selectedUser : true) &&
          timeCondition
        );
      });
    },
  },
  methods: {
    async get_crafts() {
      const response = await axios.post('/get_crafts');
      this.crafts = response.data.data;
      console.log(response.data.data);
    },
    async fetchPosts() {
      try {
        const response = await axios.get('/projects');
        this.postes = response.data.projects;
        console.log(response)
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.currentPost.image = e.target.result; // تحديث معاينة الصورة
        };
        reader.readAsDataURL(file);
      } else {
        alert("الرجاء اختيار صورة صالحة.");
      }
    },
    handlePostSubmit(newPost) {
      this.postes.unshift(newPost); // إضافة البوست الجديد إلى بداية القائمة
    },
    openModal(post) {
      this.currentPost = { ...post }; // نسخ المنشور لتجنب تعديل البيانات مباشرة
      this.isModalOpen = true; // فتح الشاشة المنبثقة
    },
    saveChanges() {
      // إيجاد المنشور في القائمة وتحديثه
      const index = this.postes.findIndex((post) => post.id === this.currentPost.id);
      if (index !== -1) {
        this.postes[index] = {
          ...this.currentPost,
          isCompleted: this.currentPost.isCompleted, // تأكد من تحديث isCompleted
        };
        this.isModalOpen = false; // إغلاق الشاشة المنبثقة
        console.log("تم حفظ التغييرات بنجاح.");
      } else {
        console.log("حدث خطأ، لم يتم العثور على المنشور.");
      }
    },
    getFirstImage(images) {
      if (images.length > 0) {
        return `/storage/image_projects/${images[0].url}`;
      }
      return '';
    },
  },
};
</script>
