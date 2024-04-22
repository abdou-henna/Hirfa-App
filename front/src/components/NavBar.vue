<template>
  <header class="sticky top-0 bg-hirfa-four-02 shadow-lg">
    <nav class="container flex flex-row rf:w-full items-center gap-4 py-3">
      <div class="flex flex-1">
        <div
            ref="menuButton"
            id="menuButton"
            class="relative cursor-pointer p-2 mr-0 h-10 w-10 flex justify-center items-center overflow-hidden"
            @click="toggleMenu"
          >
          <span class="absolute h-[2.4px] rounded-lg w-5 bg-black -translate-y-2 right-[6px]"></span>
          <span class="absolute h-[2.4px] rounded-lg w-4 bg-black translate-y-2 right-[6px]"></span>
          <span class="absolute h-[2.4px] rounded-lg w-7 bg-black"></span>
        </div>
        <transition name="fade">
        <div v-if="showMenu" class="dropdown-menu-animation absolute top-full s mt-2 py-2 w-48 bg-white rounded-md shadow-lg">
          <ul class="text-gray-700" dir="rtl">
            <li><a class="dropdown-item" href="/login">تسجيل دخول</a></li>
            <li><a class="dropdown-item" href="/register">تسجيل حساب</a></li>
            <li><a class="dropdown-item" href="/craftsmen">صفحة الحرفيين</a></li>
            <li><a class="dropdown-item" href="/about">حول المنصة</a></li>
            <li><a class="dropdown-item" href="/PoliciesAndTerms">حقوق النشر</a></li>
          </ul>
        </div>
        </transition>
      </div>
      <RouterLink :to="{ name: 'home' }">
        <img src="../../public/Hirfa.png" class="w-[80px]" />
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
    toggleMenu() {
      this.showMenu = !this.showMenu;
      this.$refs.menuButton.classList.toggle("active");
    },
  },
};
</script>

<style>
#menuButton span {
  transition: 0.5s;
}

#menuButton.active span:nth-child(3) {
  transform: translateX(50px);
}

#menuButton.active span:nth-child(1) {
  width: 28px;
  transform: translateX(0) rotate(45deg);
  transition-delay: 0.125s;
}

#menuButton.active span:nth-child(2) {
  width: 28px;
  transform: translateX(0) rotate(-45deg);
  transition-delay: 0.125s;
}
</style>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  transform-origin: top;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
  transform: scaleY(0.95);
}



.dropdown-item {
  display: block;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

.dropdown-item:hover {
  background-color: #f2f2f2;
}
</style>