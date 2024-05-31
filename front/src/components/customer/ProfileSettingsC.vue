<template>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-2xl font-semibold mb-4">إعدادات الحساب</h3>
      <div class="space-y-4">
        <div class="flex flex-col items-center">
          <label class="font-semibold">الصورة الشخصية</label>
          <img 
            :src="tempProfileImg || user.profileImg" 
            class="w-32 h-32 rounded-full mt-2 mb-4 cursor-pointer"
            @click="triggerFileInput"
          />
          <input 
            type="file" 
            ref="fileInput" 
            @change="handleProfileImgChange" 
            class="hidden" 
          />
        </div>
        <div class="flex flex-col">
          <label class="font-semibold">الاسم الكامل</label>
          <input type="text" v-model="tempUser.name" class="form-input mt-2">
        </div>
        <div class="flex flex-col">
          <label class="font-semibold">البريد الإلكتروني</label>
          <input type="email" v-model="tempUser.email" class="form-input mt-2">
        </div>
        <div class="flex flex-col">
          <label class="font-semibold">كلمة المرور</label>
          <input type="password" v-model="tempUser.password" class="form-input mt-2">
        </div>
        <div class="flex justify-end mt-4">
          <button @click="saveSettings" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">حفظ</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      user: Object
    },
    data() {
      return {
        tempUser: JSON.parse(JSON.stringify(this.user)),
        tempProfileImg: null,
      };
    },
    methods: {
      triggerFileInput() {
        this.$refs.fileInput.click();
      },
      handleProfileImgChange(event) {
        const file = event.target.files[0];
        if (file) {
          this.tempProfileImg = URL.createObjectURL(file);
        }
      },
      saveSettings() {
        this.$emit('saveSettings', { ...this.tempUser, profileImg: this.tempProfileImg || this.user.profileImg });
      }
    }
  };
  </script>
  
  <style scoped>
  .form-input {
    @apply mt-2 block w-full rounded-md border-gray-300 shadow-sm;
  }
  </style>
  