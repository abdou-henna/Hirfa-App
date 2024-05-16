<template>
  <div class="max-w-4xl p-4 mr-3">
    <h2 class="text-2xl font-bold mb-6">قائمة طلبات الخدمات</h2>
    <div class="space-y-6 bg-white p-6 rounded-lg shadow-md">
      <table class="min-w-full">
        <thead>
          <tr class="border-b">
            <th class="text-right px-2 py-3">عنوان الطلب</th>
            <th class="text-right px-2 py-3">التاريخ</th>
            <th class="text-right px-2 py-3">الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id" class="border-b">
            <td class="px-2 py-3">{{ order.name }}</td>
            <td class="px-2 py-3">{{ order.date }}</td>
            <td class="px-2 py-3">
              <button @click="showOrderDetails(order)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- نافذة منبثقة لعرض تفاصيل الطلب -->
    <transition name="fade">
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-2xl relative">
          <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <h3 class="text-2xl font-semibold mb-4 text-center">تفاصيل الطلب</h3>
          <div class="flex flex-col items-center">
            <img :src="selectedOrder.profileImg" alt="Profile Image" class="w-32 h-32 rounded-full mb-4">
            <p><strong>الاسم الكامل:</strong> {{ selectedOrder.userName }}</p>
            <p><strong>عنوان:</strong> {{ selectedOrder.userAddress }}</p>
            <p><strong>عنوان الطلب:</strong> {{ selectedOrder.name }}</p>
            <p><strong>موضوع الطلب:</strong> {{ selectedOrder.subject }}</p>
            <div v-if="selectedOrder.attachment">
              <img :src="selectedOrder.attachment" alt="Attachment" class="w-full h-auto rounded-lg shadow mt-4">
            </div>
            <div class="flex justify-end gap-4 mt-6">
              <button @click="rejectOrder" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded">عدم القبول</button>
              <button @click="acceptOrder" class="text-white bg-green-500 hover:bg-green-700 px-4 py-2 rounded">قبول</button>
            </div>
            <p class="text-sm text-gray-500 mt-4">
              إذا تعدى على الطلب يومين سوف يرفض تلقائيًا وتُرسل رسالة بعدم قبوله لأن الحرفي مشغول.
            </p>
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
      selectedOrder: null,
      orders: [
        {
          id: 1,
          name: "تجديد المطبخ",
          date: "2024-04-12",
          userName: "محمد أحمد",
          userAddress: "الجزائر",
          profileImg: "../../../public/Craftsmen/electrician/electrician3.jpg",
          subject: "تجديد المطبخ بالكامل، تغيير الأرضيات والخزائن.",
          attachment: "../../../public/Craftsmen/electrician/gallery/work3.jpg",
        },
        // المزيد من الطلبات هنا
      ],
    };
  },
  methods: {
    showOrderDetails(order) {
      this.selectedOrder = order;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.selectedOrder = null;
    },
    rejectOrder() {
      // منطق رفض الطلب
      alert("تم رفض الطلب.");
      this.closeModal();
    },
    acceptOrder() {
      // منطق قبول الطلب
      alert("تم قبول الطلب.");
      this.closeModal();
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
