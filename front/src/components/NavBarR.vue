<template>
  <header class="sticky top-0 bg-hirfa-four-02 shadow-md">
    <nav class="container flex flex-row rf:w-full items-center justify-between gap-4 py-3">
      <div class="flex items-center">
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
          <div v-if="showMenu" class="dropdown-menu-animation absolute top-full mt-2 py-2 w-48 bg-white rounded-lg shadow-lg z-50">
            <ul class="text-gray-700" dir="rtl">
              <li class="group">
                <a class="dropdown-item" href="/">
                  الصفحة الرئيسية
                  <span class="block transition-transform transform group-hover:translate-x-1 text-blue-500">→</span>
                </a>
              </li>
              <li class="group">
                <a class="dropdown-item" href="/postes">
                  منشورات العملاء
                  <span class="block transition-transform transform group-hover:translate-x-1 text-blue-500">→</span>
                </a>
              </li>
              <li class="group">
                <a class="dropdown-item" href="/craftsmen">
                  صفحة الحرفيين
                  <span class="block transition-transform transform group-hover:translate-x-1 text-blue-500">→</span>
                </a>
              </li>
              <li class="group">
                <a class="dropdown-item" href="/about">
                  حول المنصة
                  <span class="block transition-transform transform group-hover:translate-x-1 text-blue-500">→</span>
                </a>
              </li>
              <li class="group">
                <a class="dropdown-item" href="/PoliciesAndTerms">
                  حقوق النشر
                  <span class="block transition-transform transform group-hover:translate-x-1 text-blue-500">→</span>
                </a>
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
          <div v-if="showNotifications" class="notifications-menu-animation absolute top-full mt-2 py-2 w-64 bg-white rounded-md shadow-lg z-50">
            <ul class="text-gray-700" dir="rtl">
              <li v-for="notice in notifications" :key="notice.id" class="flex items-start p-2 hover:bg-gray-100 cursor-pointer">
                <a :href="notice.href" class="flex items-start">
                  <img v-if="notice.type === 'message'" :src="notice.senderImg" alt="sender image" class="w-10 h-10 rounded-full ml-2" />
                  <i v-else class="fa-solid fa-bell fa-lg ml-2"></i>
                  <div>
                    <p v-if="notice.type === 'message'" class="text-sm font-bold">{{ notice.senderName }}</p>
                    <p class="text-sm">{{ notice.type === 'message' ? truncateText(notice.message, 4) : notice.text }}</p>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </transition>
      </div>
      <div class="flex items-center gap-4 cursor-pointer">
        <!-- User Info -->
        <div class="flex items-center gap-2">
          <span>{{ UserSingIn.name }}</span>
          <img :src="UserSingIn.image" alt="user avatar" class="w-9 h-9 rounded-full" />
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
        image: "../../public/abdou.jpg",
      },
      notifications: [
        { id: 1, type: "site", text: "إشعار جديد 1", href: "#" },
        { id: 2, type: "site", text: "إشعار جديد 2", href: "#" },
        { id: 3, type: "message", senderName: "سند قحف", senderImg: "../../public/Craftsmen/painter/painter3.jpg", message: "مرحبا، كيف حالك؟", href: "#" },
        { id: 4, type: "message", senderName: "فاطمة علي", senderImg: "../../public/Craftsmen/tailor/tailor1.jpg", message: "هل يمكننا التحدث لأن الوقت متأخر فهذا كان هو الحل الوحيد؟", href: "#" },
        // المزيد من الإشعارات هنا
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
    truncateText(text, wordLimit) {
      const words = text.split(' ');
      if (words.length > wordLimit) {
        return words.slice(0, wordLimit).join(' ') + '...';
      }
      return text;
    },
  },
};

</script>
<style scoped>
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
  display: flex;
  justify-content: space-between;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
  border-left: 4px solid transparent;
}

.dropdown-item:hover {
  background-color: #f2f2f2;
  color: #1d4ed8;
  border-left-color: #1d4ed8;
}

.notifications-menu-animation {
  width: 320px;
}

.notifications-menu-animation ul {
  list-style-type: none;
  padding: 0;
}

.notifications-menu-animation li {
  display: flex;
  align-items: center;
  padding: 8px;
}

.notifications-menu-animation li:hover {
  background-color: #f2f2f2;
}

.notifications-menu-animation img {
  margin-right: 8px;
  border-radius: 50%;
}
</style>
