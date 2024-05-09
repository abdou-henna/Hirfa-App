<template>
  <div class="flex w-full h-screen overflow-hidden">
    <div
      class="md:flex hidden w-1/2 min-h-screen items-center justify-center bg-hirfa-four-01"
    >
      <img
        src="../../public/HomeImg.jpg"
        alt="Home Image"
        class="w-4/5 self-center"
      />
    </div>
    <div class="flex md:w-1/2 w-full items-center justify-center overflow-auto">
      <form @submit.prevent="submitForm" class="md:w-4/5 w-full m-auto h-full">
        <header class="mt-10 flex my-10 mx-10 h-12 ">
          <img
            src="../../public/Hirfa.png"
            alt="Logo"
            class="h-10 w-auto m-auto pr-2"
          />
        </header>
        <section class="pb-10 my-10 mx-10">
          <div dir="rtl" class="m-6">
            <h1 class="text-lg font-cairo mb-2">منصتنا ترحب بكم</h1>
            <p>
              قم بتسجيل حساب جديد أو
              <RouterLink to="/login" class="text-blue-700 cursor-pointer"
                >تسجيل الدخول</RouterLink
              >
            </p>
          </div>
          <div dir="rtl" class="md:m-6 space-y-4">
            <div class="flex justify-between w-full">
              <input
                v-model="user.firstName"
                type="text"
                placeholder="الإسم الأول"
                class="input-style w-[48%]"
              />
              <input
                v-model="user.lastName"
                type="text"
                placeholder="الإسم الأخير"
                class="input-style w-[48%]"
              />
            </div>
            <input
              v-model="user.email"
              type="email"
              placeholder="البريد الإلكتروني"
              class="input-style w-full"
            />
            <input
              v-model="user.password"
              type="password"
              placeholder="كلمة المرور"
              class="input-style w-full"
            />
            <div class="flex justify-between w-full mt-4">
              <input
                v-model="user.phone"
                type="tel"
                placeholder="رقم الهاتف"
                dir="rtl"
                class="input-style w-[74%] md:w-[84%]"
              />
              <div class="input-style flex w-[24%] md:w-[14%] items-center justify-around">
                <span class="text-sm">213+</span>
                <img src="../../public/alg.png" alt="Flag" class="w-[35%]" />
              </div>
            </div>
            <select v-model="user.gender" class="select-style w-full ">
              <option disabled hidden selected value="">الجنس</option>
              <option value="male">ذكر</option>
              <option value="female">أنثى</option>
            </select>
            <select v-model="user.role" class="select-style w-full">
              <option disabled hidden selected value="">الفـئـة</option>
              <option value="client">عـمــيل</option>
              <option value="craftsman">حــرفـي</option>
            </select>
            <date-picker v-model="user.birthDate" />
            <button
              type="submit"
              class="mt-16 w-full rounded-md bg-[#005CFF] py-2 text-white hover:bg-[#004aca]"
            >
              إنشاء حساب
            </button>
          </div>
        </section>
      </form>
    </div>
  </div>
</template>

<script>
import DatePicker from "@/components/DatePicker.vue";
import "v-calendar/style.css";
import axios from "axios"; // تأكد من تثبيت axios إذا لم يكن مثبتًا بالفعل

export default {
  components: {
    DatePicker,
  },
  data() {
    return {
      user: {
        firstName: "",
        lastName: "",
        username: "",
        email: "",
        password: "",
        phone: "",
        gender: "",
        role: "",
        birthDate: null,
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        // استبدل URL بعنوان الـ API الخاص بك
        const response = await axios.post("YOUR_API_ENDPOINT", this.user);
        console.log(response.data);
        // بعد الإرسال بنجاح، يمكنك إعادة توجيه المستخدم أو إظهار رسالة نجاح
      } catch (error) {
        console.error(error);
        // يمكنك هنا إظهار رسالة خطأ للمستخدم
      }
    },
  },
};
</script>

<style scoped>
.input-style {
  background-color: #f8f8f8;
  border: 2px solid #f8f8f8;
  border-radius: 0.375rem; /* 6px */
  font-family: font-semibold;
  padding: 0.5rem;
  transition: background-color 0.3s, border-color 0.3s;
}

.input-style:hover,
.input-style:focus {
  background-color: #f4f4f4;
  border-color: #3b82f6; /* Tailwind blue-500 */
}

.select-style {
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: #f8f8f8;
  border: 2px solid #f8f8f8;
  appearance: none;
  background-size: 10px;
  border: 2px solid #f8f8f8;
  border-radius: 0.375rem; /* 6px */
  padding: 0.5rem 2.5rem 0.5rem 0.75rem; /* Adjusted padding for text and arrow */
  transition: background-color 0.3s, border-color 0.3s;
}

.select-style:hover,
.select-style:focus {
  background-color: #f4f4f4;
  border-color: #3b82f6;
}
</style>
