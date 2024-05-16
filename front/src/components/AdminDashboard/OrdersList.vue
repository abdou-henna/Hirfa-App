<template>
  <div class="bg-white rounded-lg shadow overflow-hidden">
    <h2 class="text-xl font-semibold p-5 bg-gray-100">قائمة الطلبات</h2>
    <div class="p-5">
      <table class="min-w-full">
        <thead>
          <tr class="border-b">
            <th class="text-right px-2 py-3">اسم الحرفي</th>
            <th class="text-right px-2 py-3">الحرفة</th>
            <th class="text-right px-2 py-3">التاريخ</th>
            <th class="text-right px-2 py-3">الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id" class="border-b">
            <td class="px-2 py-3">{{ order.name }}</td>
            <td class="px-2 py-3">{{ order.type }}</td>
            <td class="px-2 py-3">{{ order.date }}</td>
            <td class="px-2 py-3">
              <button @click="showOrderDetails(order)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- نافذة منبثقة لعرض تفاصيل الحرفي -->
    <transition name="fade">
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-2xl relative">
          <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <h3 class="text-2xl font-semibold mb-4 text-center">تفاصيل الحرفي</h3>
          <div class="flex flex-col items-center">
            <img :src="selectedOrder.ProfileImg" alt="Profile Image" class="w-32 h-32 rounded-full mb-4">
            <p><strong>الاسم الكامل:</strong> {{ selectedOrder.name }}</p>
            <p><strong>الحرفة:</strong> {{ selectedOrder.type }}</p>
            <p><strong>المكان:</strong> {{ selectedOrder.place }}</p>
            <p><strong>السعر:</strong> {{ selectedOrder.price }}</p>
            <p><strong>تاريخ الإنظمام:</strong> {{ selectedOrder.date }}</p>
            <h4 class="text-xl font-semibold mt-4">الصور:</h4>
            <div class="flex gap-4 mt-2">
              <div v-if="selectedOrder.idCardImg" class="w-48">
                <img :src="selectedOrder.idCardImg" alt="ID Card" class="w-full h-auto rounded-lg shadow">
                <p class="text-center mt-2">بطاقة التعريف</p>
              </div>
              <div v-if="selectedOrder.professionalCardImg" class="w-48">
                <img :src="selectedOrder.professionalCardImg" alt="Professional Card" class="w-full h-auto rounded-lg shadow">
                <p class="text-center mt-2">بطاقة مهني</p>
              </div>
            </div>
            <div class="flex justify-end gap-4 mt-6">
              <button @click="rejectOrder" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded">عدم القبول</button>
              <button @click="acceptOrder" class="text-white bg-green-500 hover:bg-green-700 px-4 py-2 rounded">قبول</button>
              <button @click="contactOrder" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">تواصل</button>
            </div>
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
      { id: 1, name: "زياد حاصي", type: "صباغ", place: "الجزائر", price: "5000 دج", date: "2024-04-12", ProfileImg: "../../../public/Craftsmen/painter/painter3.jpg", idCardImg: "../../../public/idcard.jpg", professionalCardImg: "../../../public/profcard.jpg" },
      { id: 2, name: "زياد حاصي", type: "صباغ", place: "الجزائر", price: "5000 دج", date: "2024-04-12", ProfileImg: "../../../public/Craftsmen/painter/painter3.jpg", idCardImg: "../../../public/idcard.jpg", professionalCardImg: "../../../public/profcard.jpg" },
      { id: 3, name: "زياد حاصي", type: "صباغ", place: "الجزائر", price: "5000 دج", date: "2024-04-12", ProfileImg: "../../../public/Craftsmen/painter/painter3.jpg", idCardImg: "../../../public/idcard.jpg", professionalCardImg: "../../../public/profcard.jpg" },
      { id: 4, name: "زياد حاصي", type: "صباغ", place: "الجزائر", price: "5000 دج", date: "2024-04-12", ProfileImg: "../../../public/Craftsmen/painter/painter3.jpg", idCardImg: "../../../public/idcard.jpg", professionalCardImg: "../../../public/profcard.jpg" },
      { id: 5, name: "زياد حاصي", type: "صباغ", place: "الجزائر", price: "5000 دج", date: "2024-04-12", ProfileImg: "../../../public/Craftsmen/painter/painter3.jpg", idCardImg: "../../../public/idcard.jpg", professionalCardImg: "../../../public/profcard.jpg" },
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
    contactOrder() {
      // منطق التواصل مع الحرفي
      alert("تم التواصل مع الحرفي.");
      this.closeModal();
    }
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
