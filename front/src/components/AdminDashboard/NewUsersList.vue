<template>
  <div class="bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold p-5 bg-gray-100">المستخدمون الجدد</h2>
    <div class="p-5">
      <ul class="space-y-4">
        <li v-for="user in users" :key="user.id" class="flex items-center justify-between">
          <div>
            <h3 class="text-md font-semibold">{{ user.name }}</h3>
            <p class="text-sm text-gray-600">تاريخ الانضمام :  {{ user.joinDate }}</p>
          </div>
          <button @click="viewUserProfile(user)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض الملف الشخصي</button>
        </li>
      </ul>
    </div>

    <!-- نافذة منبثقة لعرض تفاصيل المستخدم -->
    <transition name="fade">
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-2xl relative">
          <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <h3 class="text-2xl font-semibold mb-4 text-center">تفاصيل المستخدم</h3>
          <div class="flex flex-col items-center">
            <img :src="selectedUser.profileImg" alt="Profile Image" class="w-32 h-32 rounded-full mb-4">
            <p><strong>الاسم الكامل : </strong> {{ selectedUser.name }}</p>
            <p><strong>مكان الإقامة : </strong> {{ selectedUser.location }}</p>
            <p><strong>تاريخ الإنضمام : </strong> {{ selectedUser.joinDate }}</p>
            <template v-if="selectedUser.type === 'حرفي'">
              <p><strong>الحرفة : </strong> {{ selectedUser.craft }}</p>
              <p><strong>المكان : </strong> {{ selectedUser.place }}</p>
              <p><strong>السعر : </strong> {{ selectedUser.price }}</p>
              <p>
                <strong>الحالة : </strong> 
                <span :class="{'text-green-500': selectedUser.verified, 'text-red-500': !selectedUser.verified}">
                  {{ selectedUser.verified ? 'تم التحقق' : 'لم يتم التحقق' }}
                </span>
              </p>
              <h4 class="text-xl font-semibold mt-4">الصور:</h4>
              <div class="flex gap-4 mt-2">
                <div v-if="selectedUser.idCardImg" class="w-48">
                  <img :src="selectedUser.idCardImg" alt="ID Card" class="w-full h-auto rounded-lg shadow">
                  <p class="text-center mt-2">بطاقة التعريف</p>
                </div>
                <div v-if="selectedUser.professionalCardImg" class="w-48">
                  <img :src="selectedUser.professionalCardImg" alt="Professional Card" class="w-full h-auto rounded-lg shadow">
                  <p class="text-center mt-2">بطاقة مهني</p>
                </div>
              </div>
            </template>
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
      selectedUser: null,
      users: [
        { id: 1, name: "أحمد علي", joinDate: "2024-04-01", profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg", location: "الجزائر", type: "مستخدم" },
        { id: 2, name: "زياد حاصي", joinDate: "2024-04-12", profileImg: "../../../public/Craftsmen/electrician/electrician2.jpg", location: "الجزائر", type: "حرفي", craft: "نجار", place: "الجزائر", price: "5000 دج", verified: true, idCardImg: "../public/idcard.jpg", professionalCardImg: "../public/profcard.jpg" },
        { id: 2, name: "زياد حاصي", joinDate: "2024-04-12", profileImg: "../../../public/Craftsmen/painter/painter3.jpg", location: "الجزائر", type: "حرفي", craft: "نجار", place: "الجزائر", price: "5000 دج", verified: false, idCardImg: "../public/idcard.jpg", professionalCardImg: "../public/profcard.jpg" },
        // يمكن إضافة المزيد من المستخدمين هنا
      ],
    };
  },
  methods: {
    viewUserProfile(user) {
      this.selectedUser = user;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.selectedUser = null;
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
