<template>
    <div  class="w-full h-screen flex items-stretch">
      <div class=" w-1/2 min-h-full bg-[#eef5ff] flex items-center justify-center ">
       <img src="../../public/HomeImg.jpg" class=" w-[80%] place-self-center ">
      </div>
      <div class=" w-1/2 flex items-center justify-center ">
        <div class=" w-[80%] m-auto h-full singup ">
          <header  class="w-full h-[50px]   mx-10 mt-10  " >
            <h1 class=" font-bold text-[#596874] float-left p-[5px]" >OrtoPhonic App</h1>
            <img src="../assets/logo1.png" class=" w-[40px] float-right pr-[5px]">
          </header>
          <section class="w-full  mx-10 mt-10  ">
            <div dir="rtl"  class="m-6" >
              <h1 class=" font-cairo text-lg mb-2">منصتنا ترحب بكم </h1>
              <p class=" font-normal  " >قم بتسجيل حساب جديد أو <RouterLink to="/singin"><a  class=" text-blue-700 cursor-pointer " > تسجيل الدخول </a></RouterLink></p>
            </div>
            <div dir="rtl" class=" m-6 ">
            <input type="text" class="bg-[#f8f8f8] w-[48%] ml-4 float-right font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="الإسم الأول" >
            <input type="text" class="bg-[#f8f8f8] w-[48%] float-left font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="الإسم الأخير" >
            <input type="text" class="bg-[#f8f8f8] w-full font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="إسم المستخدم (بالإنجليزية)" >
            <input type="email" class="bg-[#f8f8f8] w-full font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="البريد الإلكتروني">
            <input type="password" class="bg-[#f8f8f8] w-full font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="كلمة المرور"  >
            <div class="bg-[#f8f8f8] cursor-pointer float-left w-[15%] font-semibold p-1 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 grid grid-cols-2 gap-1 items-center  " >
              <span class="">213+</span>
              <img src="../assets/singup/countery/alg.png" class="w-[22px] ">
            </div>
            <input type="tel" class="bg-[#f8f8f8] float-right w-[83%] font-semibold leading-4 px-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400 " placeholder="رقم الهاتف" >
           
    
            <select name="" id="" class="bg-[#f8f8f8] w-full font-semibold text-[#7f7f7feb]  leading-6 p-2 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400"  >
              <option value="" disabled hidden selected class="  " > <p class="" > الجنس </p></option>
              <option value="" class="font-bold" >ذكر</option>
              <option value="" class="font-bold  " >أنثى</option>
            </select>
            <date-picker/>
            <button class=" hover:bg-[#004aca] w-full mt-12 mb-12 bg-[#005CFF] font-semibold text-white h-[50px] rounded-md focus:bg-[] " >إنشاء حساب </button>
      </div>
           </section>
          <footer></footer>
        </div>
      </div>
    </div>
    </template>
    <script>
    import DatePicker from '@/components/DatePicker.vue';
    import 'v-calendar/style.css';
    export default{
      components : {
        DatePicker,
      }
    }
    </script>
    <style>
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background: url(../assets/singup/arrow.svg) no-repeat;
      background-position: left 5% center;
      background-size: 10px;
      padding-right: 20px; /* add some padding to the right so the text doesn't overlap with the arrow */
    }
    </style>
    