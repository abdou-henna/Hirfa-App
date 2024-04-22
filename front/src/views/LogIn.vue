<template>
  <div>
    <div class="w-1/2 h-screen float-right grid grid-col-1 gap-0 justify-center bg-hirfa-four-01">
      <div>
        <header class="w-[550px] h-[50px] mx-10 mt-10">
          <img src="../../public/Hirfa.png" class="w-[100px] float-right pr-[5px]">
        </header>
        <section class="w-[550px] mx-10 mt-10 h-[75%] grid content-center">
          <div dir="rtl" class="m-6">
            <h1 class="font-cairo text-2xl mb-2">سجل دخولك</h1>
            <p class="font-normal">قم بتسجيل الدخول أو <RouterLink :to="{name: 'singup'}"><a class="text-blue-700 cursor-pointer">تسجيل حساب جديد</a></RouterLink></p>
          </div>
          <form @submit.prevent="submitLogin" dir="rtl" class="mx-6">
            <input v-model="loginData.email" type="email" class="bg-[#f8f8f8] w-full font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="البريد الإلكتروني">
            <input v-model="loginData.password" type="password" class="bg-[#f8f8f8] w-full font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="كلمة المرور">
            <button type="submit" class="hover:bg-[#004aca] w-full mt-12 mb-4 bg-[#005CFF] font-semibold text-white h-[50px] rounded-md focus:bg-[]">تسجيل الدخول</button>
            <a class="text-[#005CFF] hover:text-[#004aca] cursor-pointer hover:underline underline-offset-1">هل نسيت إسم المستخدم أو كلمة المرور؟</a>
          </form>
        </section>
        <footer></footer>
      </div>
    </div>
    <div class="w-1/2 h-screen grid bg-hirfa-four-01 float-left">
     <img src="../../public/HomeImg.jpg" class="w-[80%] place-self-center">
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
  return {
    loginData: {
      email: '',
      password: '',
    },
  };
},
methods: {
  async submitLogin() {
    try {
      const response = await axios.post('YOUR_LOGIN_API_ENDPOINT', this.loginData);
      // هنا يمكنك التعامل مع الاستجابة، مثل تخزين token أو إعادة التوجيه إلى صفحة أخرى
      console.log('Login successful', response);
    } catch (error) {
      console.error('Login error', error);
      // هنا يمكنك إظهار رسالة خطأ للمستخدم
    }
  },
},
};
</script>


    <style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Jomhuria&display=swap');
@import url("https://fonts.googleapis.com/css2?family=Lalezar&display=swap");
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@800&display=swap');
.font-lizar {
  font-family: "Lalezar", cursive;
}
.font-jomhuria{
    font-family: 'Jomhuria', cursive;
}
.font-amiri{
    font-family: 'Amiri', serif;
}
.font-cairo {
    font-family: 'Cairo', sans-serif;
}
.card .text-container {
  transform: translateY(100%);
  transition: transform 0.5s ease-out;
}

.card:hover .text-container {
  transform: translateY(0%);
}

.card:hover .text-container p {
  opacity: 1;
}

.card:hover .text-container h5 {
  opacity: 1;
}
    </style>
    