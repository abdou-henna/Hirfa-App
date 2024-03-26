<template>
    <header class="sticky top-0 bg-hirfa-four-02 shadow-lg">
      <nav class="container flex flex-row rf:w-full  items-center gap-4 py-3"> 
        <div class="flex flex-1" >
          <div
              id="menubutton"
              class="relative cursor-pointer p-2 mr-0 h-10 w-10  flex justify-center items-center overflow-hidden"
              @click="menushow"
            >
              <span
                class="absolute  h-[2.4px] rounded-lg w-5 bg-black -translate-y-2 right-[6px]"
              ></span>
              <span
                class="absolute  h-[2.4px] rounded-lg w-4 bg-black translate-y-2 right-[6px]"
              ></span>
              <span
                class="absolute  h-[2.4px] rounded-lg w-7 bg-black  "
              ></span>
            </div>
        </div>
        <RouterLink :to="{name: 'home'}">
            <div class="flex  justify-end">
              <img src="../../public/Hirfa.png" class="w-[80px]" />
            </div>
        </RouterLink>
      </nav>
    </header>
  </template>
  <script>
  export default {
    name: "NavBar",
    data() {
      return {
        showMenu: false,
      };
    },
    methods: {
      menushow() {;
        menubutton.classList.toggle("active");
      },
    },
  };
  </script>
  <script setup >
      import { RouterLink } from 'vue-router';
  </script>
  <style >
  
  #menubutton span{
    transition: 0.5s;
  }
  #menubutton.active span:nth-child(3){
   transform: translateX(50px);
  }
  #menubutton.active span:nth-child(1){
    width: 28px;
   transform: translateX(0) rotate(45deg);
   transition-delay: 0.125s;
  }
  #menubutton.active span:nth-child(2){
    width: 28px;
   transform: translateX(0) rotate(315deg);
   transition-delay: 0.125s;
  }
  </style>
  