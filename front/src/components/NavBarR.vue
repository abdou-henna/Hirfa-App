<template>
  <header class="sticky top-0 bg-hirfa-four-02 shadow-md">
    <nav
      class="container flex flex-row rf:w-full items-center justify-between gap-4 py-3"
    >
      <div class="flex items-center">
        <div
          ref="menuButton"
          id="menuButton"
          class="relative cursor-pointer p-2 mr-0 h-10 w-10 flex justify-center items-center overflow-hidden"
          @click="toggleMenu"
        >
          <span
            class="absolute h-[2.4px] rounded-lg w-5 bg-black -translate-y-2 right-[6px]"
          ></span>
          <span
            class="absolute h-[2.4px] rounded-lg w-4 bg-black translate-y-2 right-[6px]"
          ></span>
          <span class="absolute h-[2.4px] rounded-lg w-7 bg-black"></span>
        </div>
        <transition name="fade">
          <div
            v-if="showMenu"
            class="dropdown-menu-animation absolute top-full s mt-2 py-2 w-48 bg-white rounded-md shadow-lg"
          >
            <ul class="text-gray-700" dir="rtl">
              <li><a class="dropdown-item" href="/">الصفحة الرئيسية</a></li>
              <li>
                <a class="dropdown-item" href="/postes">منشورات العملاء</a>
              </li>
              <li>
                <a class="dropdown-item" href="/craftsmen">صفحة الحرفيين</a>
              </li>
              <li><a class="dropdown-item" href="/about">حول المنصة</a></li>
              <li>
                <a class="dropdown-item" href="/PoliciesAndTerms">حقوق النشر</a>
              </li>
            </ul>
          </div>
        </transition>
        <button
          class="relative cursor-pointer p-2 h-10 w-10 flex justify-center items-center"
          id="notificationsButton"
          @click="toggleNotifications"
        >
          <i class="fa-solid fa-bell fa-lg"></i>
        </button>
        <transition name="fade">
          <div
            v-if="showNotifications"
            class="notifications-menu-animation absolute top-full mt-2 py-2 w-48 bg-white rounded-md shadow-lg z-50"
          >
            <ul class="text-gray-700" dir="rtl">
              <li v-for="notice in Notificationss" :key="notice.id">
                <a class="dropdown-item" :href="notice.href">{{
                  notice.text
                }}</a>
              </li>
            </ul>
          </div>
        </transition>
      </div>

      <div class="flex items-center gap-4 cursor-pointer">
        <!-- User Info -->
        <div class="flex items-center gap-2">
          <span>{{ UserSingIn.name }}</span>
          <img
            :src="UserSingIn.image"
            alt="user avatar"
            class="w-9 h-9 rounded-full"
          />
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "LoggedInNavBar",
  data() {
    return {
      showMenu: false,
      showNotifications: false,
      UserSingIn: {
        name: "عبد الرحمان حنه",
        image: "../public/abdou.jpg",
      },
      Notificationss: [
        // مثال على مصفوفة الإشعارات
        { id: 1, text: "إشعار جديد 1", href: "/message" },
        { id: 2, text: "إشعار جديد 2", href: "#" },
        // يمكنك إضافة المزيد من الإشعارات هنا
      ],
    };
  },
  methods: {
    toggleMenu() {
      this.showMenu = !this.showMenu;
      this.$refs.menuButton.classList.toggle("active");
      if (this.showNotifications) {
        this.showNotifications = !this.showNotifications;
      }
    },
    toggleNotifications() {
      this.showNotifications = !this.showNotifications;
      if (this.showMenu) {
        this.showMenu = !this.showMenu;
        this.$refs.menuButton.classList.toggle("active");
      }
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  transform-origin: top;
}
.fade-enter,
.fade-leave-to {
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
