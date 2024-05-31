<template>
  <div>
    <nav-bar-r />
    <div class="container my-8 mx-auto p-4" dir="rtl">
      <h2 class="text-2xl text-center font-bold mb-6">لوحة التحكم للعميل</h2>
      <!-- إدارة الطلبات -->
      <div class="max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6 mb-6">
        <h3 class="font-semibold text-xl mb-4">طلباتي</h3>
        <OrderList :orders="orders" />
      </div>
      <!-- مراجعاتي -->
      <div class="max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6 mb-6">
        <h3 class="font-semibold text-xl mb-4">مراجعاتي</h3>
        <ReviewsSection />
      </div>
      <!-- إعدادات الحساب -->
      <div class="max-w-4xl bg-white rounded-lg mx-auto shadow-md p-6">
        <h3 class="font-semibold text-xl mb-4">إعدادات الحساب</h3>
        <ProfileSettings :user="user" @saveSettings="saveSettings" />
      </div>
    </div>
    <FooterF />
  </div>
</template>

<script>
import OrderList from "../components/customer/OrderList.vue";
import ReviewsSection from "../components/customer/ReviewsSection.vue";
import ProfileSettings from "../components/customer/ProfileSettingsC.vue";
import NavBarR from "../components/NavBarR.vue";
import FooterF from "@/components/FooterF.vue";

export default {
  components: {
    OrderList,
    ReviewsSection,
    ProfileSettings,
    NavBarR,
    FooterF,
  },
  data(){
    return {
      user: {
          name: "أحمد محمد",
          email: "ahmed@example.com",
          password: "",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg"
        },
        orders: [
        {
          id: 1,
          name: "تجديد المطبخ",
          date: "2024-04-12",
          status: "مكتمل",
          craftsmanName: "أحمد علي",
          craftsmanType: "نجار",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg",
          subject: "تجديد المطبخ بالكامل، تغيير الأرضيات والخزائن.",
          attachment: "../../../public/Craftsmen/carpenter/gallery/work5.jpg",
        },
        {
          id: 2,
          name: "تصميم الحديقة",
          date: "2024-05-05",
          status: "جاري",
          craftsmanName: "محمد علي",
          craftsmanType: "مصمم حدائق",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg",
          subject: "تصميم جديد للحديقة باستخدام عناصر طبيعية.",
          attachment: null,
        },
        // أضف المزيد من الطلبات حسب الحاجة
      ],
    } 
  },
  methods: {
    saveSettings(updatedUser) {
      this.user = updatedUser;
      alert("تم حفظ التغييرات بنجاح.");
    }
  }
};
</script>
