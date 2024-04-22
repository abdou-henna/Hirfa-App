<template>
  <nav-bar-r></nav-bar-r>
  <div
    class="container flex flex-col justify-center items-center py-20 mx-auto bg-white shadow-md overflow-hidden"
    dir="rtl"
  >
    <div
      class="flex flex-col md:flex-row justify-between items-center w-full md:w-[60%] mb-10"
    >
      <div class="flex flex-col md:flex-row gap-4 mb-8 md:mb-2 w-full md:w-fit">
        <select
          v-model="selectedUser"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">جميع المنشورات</option>
          <option :value="currentUser">منشوراتي</option>
        </select>
        <select
          v-model="selectedCategory"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">جميع الفئات</option>
          <option value="حرفة 1">حرفة 1</option>
          <option value="حرفة 2">حرفة 2</option>
          <option value="حرفة 3">حرفة 3</option>
        </select>
        <select
          v-model="selectedTime"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">أي وقت</option>
          <option value="hour">قبل ساعة</option>
          <option value="day">قبل يوم</option>
          <option value="week">قبل أسبوع</option>
        </select>
      </div>
      <create-post-form
        v-if="!isCraftsman"
        @post-submitted="handlePostSubmit"
      />
    </div>
    <div
      v-for="(post, index) in filteredPosts"
      :key="index"
      class="flex flex-col border-b md:w-[60%] border-gray-200 last:border-0 mt-20"
    >
      <div class="flex flex-row justify-between">
        <div class="p-4 flex">
          <img
            :src="post.userImage"
            alt="User image"
            class="h-12 w-12 rounded-full border"
          />
          <div class="flex flex-col mr-2">
            <div class="text-sm font-semibold text-gray-900">
              {{ post.userName }}
            </div>
            <div class="text-sm text-gray-500">{{ post.timestamp }}</div>
          </div>
        </div>
        <div
          v-if="post.userId === currentUser && !isCraftsman"
          @click="openModal(post)"
          class="cursor-pointer"
        >
          <i class="fa-solid fa-pen-to-square fa-lg"></i>
        </div>
      </div>
      <div class="p-4">
        <div class="text-lg font-medium text-gray-900">{{ post.title }}</div>
        <p class="mt-2 text-gray-700">{{ post.content }}</p>
        <div class="flex mt-6  flex-row justify-between">
          <span
            class="  bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"
            >{{ post.category }}</span
          >
          <div
          v-if="isCraftsman"
          class="cursor-pointer ml-6 "
        >
          <RouterLink :to="{name: 'message'}"> <i class="fa-solid fa-message fa-lg"></i> </RouterLink>
        </div>
        </div>
      </div>
      <div class="flex justify-between items-center p-4">
        <img
          v-if="post.image"
          :src="post.image"
          alt="Post image"
          class="w-full md:w-[95%] object-contain"
        />
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
          <span class="block mb-2 text-md font-medium text-gray-700"
            >عنوان المنشور</span
          >
          <input
            v-model="currentPost.title"
            class="w-full p-2 mb-4 border border-gray-300 rounded"
            placeholder="عنوان المنشور"
          />
          <span class="block mb-2 text-md font-medium text-gray-700"
            >محتوى المنشور</span
          >
          <textarea
            v-model="currentPost.content"
            class="w-full p-2 mb-4 border border-gray-300 rounded"
            placeholder="محتوى المنشور"
            rows="4"
          ></textarea>
          <div class="mb-4">
            <label class="block mb-2 text-md font-medium text-gray-700"
              >فئة المنشور:</label
            >
            <select
              v-model="currentPost.category"
              class="w-full p-2 border border-gray-300 rounded"
            >
              <option disabled value="">اختر فئة</option>
              <option>حرفة 1</option>
              <option>حرفة 2</option>
              <option>حرفة 3</option>
              <!-- إضافة المزيد من الفئات حسب الحاجة -->
            </select>
          </div>
          <div class="mb-4">
            <label class="block mb-2 text-md font-medium text-gray-700"
              >تحديث الصورة:</label
            >
            <input
              type="file"
              @change="handleImageUpload"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            />
          </div>
          <div v-if="currentPost.image" class="mb-4">
            <img
              :src="currentPost.image"
              alt="معاينة الصورة"
              class="rounded max-h-40 mx-auto"
            />
          </div>
          <div class="flex items-center mb-4">
            <input
              type="checkbox"
              v-model="currentPost.isCompleted"
              id="completedCheckbox"
              class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300"
            />
            <label
              for="completedCheckbox"
              class="mr-2 text-md font-medium text-gray-700"
              >تم الإنجاز</label
            >
          </div>
          <div class="flex justify-start space-x-4 p-3">
            <button
              type="submit"
              class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded ml-4"
            >
              حفظ التغييرات
            </button>
            <button
              @click="isModalOpen = false"
              class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded ml-4"
            >
              إلغاء
            </button>
          </div>
        </div>
      </form>
    </template>
  </Modal>
</template>

<script>
import NavBarR from "../components/NavBarR.vue";
import CreatePostForm from "../components/CreatePostForm.vue";
import moment from "moment";
import Modal from "../components/Modal.vue";
export default {
  components: {
    CreatePostForm,
    Modal,
    NavBarR,
  },
  data() {
    return {
      isCraftsman: true,
      selectedUser: "",
      selectedCategory: "",
      selectedTime: "",
      postes: [
        {
          id: 1,
          image: "https://via.placeholder.com/300",
          userImage: "../public/HirfaType/Build.jpg",
          userName: "مستخدم 1",
          timestamp: "3/29/2024, 10:00:00 AM",
          title: "عنوان البوست الأول",
          content:
            "محتوى البوست الأول يمكن أن يكون هنا. يمكن أن يتضمن البوست معلومات مختلفة أو قصص أو أي شيء آخر تريده.",
          category: "حرفة 1",
          userId: "user3",
          isCompleted: false,
        },
        {
          id: 2,
          image: "https://via.placeholder.com/300",
          userImage: "../public/HirfaType/Build.jpg",
          userName: "مستخدم 2",
          timestamp: "3/30/2024, 2:00:00 PM",
          title: "عنوان البوست الثاني",
          content:
            "محتوى البوست الثاني يمكن أن يكون هنا. يمكن أن يتضمن البوست معلومات مختلفة أو قصص أو أي شيء آخر تريده.",
          category: "حرفة 2",
          userId: "user2",
          isCompleted: false,
        },
        {
          id: 3,
          image: "https://via.placeholder.com/300",
          userImage: "../public/HirfaType/Build.jpg",
          userName: "مستخدم 3",
          timestamp: "3/31/2024, 4:00:00 PM",
          title: "عنوان البوست الثالث",
          content:
            "محتوى البوست الثالث يمكن أن يكون هنا. يمكن أن يتضمن البوست معلومات مختلفة أو قصص أو أي شيء آخر تريده.",
          category: "حرفة 3",
          userId: "user1",
          isCompleted: false,
        },
        {
          id: 4,
          image: "https://via.placeholder.com/300",
          userImage: "../public/HirfaType/Build.jpg",
          userName: "مستخدم 3",
          timestamp: "3/31/2024, 4:00:00 PM",
          title: "عنوان البوست رابع",
          content:
            "محتوى البوست رابع يمكن أن يكون هنا. يمكن أن يتضمن البوست معلومات مختلفة أو قصص أو أي شيء آخر تريده.",
          category: "حرفة 3",
          userId: "user3",
          isCompleted: false,
        },
        {
          id: 5,
          image: "https://via.placeholder.com/300",
          userImage: "../public/HirfaType/Build.jpg",
          userName: "مستخدم 3",
          timestamp: "3/31/2024, 4:00:00 PM",
          title: "عنوان البوست خامس",
          content:
            "محتوى البوست خامس يمكن أن يكون هنا. يمكن أن يتضمن البوست معلومات مختلفة أو قصص أو أي شيء آخر تريده.",
          category: "حرفة 3",
          userId: "user3",
          isCompleted: false,
        },
      ],
      currentPost: null, // لتخزين المنشور الحالي الذي يتم تعديله
      isModalOpen: false, // للتحكم في إظهار وإخفاء الشاشة المنبثقة
      currentUser: "user3",
    };
  },
  computed: {
    filteredPosts() {
      return this.postes.filter((post) => {
        const postTime = moment(post.timestamp, "M/D/YYYY, h:mm:ss A");
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
          (this.selectedCategory
            ? post.category === this.selectedCategory
            : true) &&
          (this.selectedUser ? post.userId === this.selectedUser : true) &&
          timeCondition &&
          (this.selectedUser || !post.isCompleted)
        );
      });
    },
  },
  methods: {
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
      const index = this.postes.findIndex(
        (post) => post.id === this.currentPost.id
      );
      if (index !== -1) {
        this.postes[index] = {
          ...this.currentPost,
          isCompleted: this.currentPost.isCompleted, // تأكد من تحديث isCompleted
        };
        this.isModalOpen = false; // إغلاق الشاشة المنبثقة
        // رد فعل واجهة المستخدم المناسب بدلاً من alert
        console.log("تم حفظ التغييرات بنجاح.");
      } else {
        // رد فعل واجهة المستخدم المناسب بدلاً من alert
        console.log("حدث خطأ، لم يتم العثور على المنشور.");
      }
    },
  },
};
</script>
