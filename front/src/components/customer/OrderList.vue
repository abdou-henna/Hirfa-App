<template>
  <div class="max-w-4xl p-4 mx-auto">
    <h3 class="text-2xl font-semibold mb-4">طلباتي</h3>
    <div class="space-y-4">
      <div v-for="order in orders" :key="order.id" class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center">
        <div>
          <h4 class="text-xl font-semibold">{{ order.name }}</h4>
          <p class="text-gray-600">التاريخ: {{ order.date }}</p>
          <p class="text-gray-600">حالة الطلب: {{ order.status }}</p>
          <button @click="showOrderDetails(order)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded mt-4">عرض التفاصيل</button>
        </div>
        <span :class="statusClass(order.status)" class="px-3 py-1 rounded-full text-sm font-semibold">
          {{ order.status }}
        </span>
      </div>
    </div>

    <!-- نافذة منبثقة لعرض تفاصيل الطلب -->
    <transition name="fade">
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-2xl relative">
          <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <h3 class="text-2xl font-semibold mb-4 text-center">تفاصيل الطلب</h3>
          <div class="flex flex-col items-center">
            <img :src="selectedOrder.profileImg" alt="Profile Image" class="w-32 h-32 rounded-full mb-4">
            <p><strong>اسم الحرفي:</strong> {{ selectedOrder.craftsmanName }}</p>
            <p><strong>نوع الحرفة:</strong> {{ selectedOrder.craftsmanType }}</p>
            <p><strong>عنوان الطلب:</strong> {{ selectedOrder.name }}</p>
            <p><strong>موضوع الطلب:</strong> {{ selectedOrder.subject }}</p>
            <div v-if="selectedOrder.attachment">
              <img :src="selectedOrder.attachment" alt="Attachment" class="w-full h-auto rounded-lg shadow mt-4">
            </div>
            <p class="text-gray-600 mt-4">تاريخ الطلب: {{ selectedOrder.date }}</p>
            <p class="text-gray-600 mt-2">حالة الطلب: {{ selectedOrder.status }}</p>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    orders: Array
  },
  data() {
    return {
      showModal: false,
      selectedOrder: null,
      
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
    statusClass(status) {
      return {
        'bg-green-100 text-green-800': status === 'مكتمل',
        'bg-yellow-100 text-yellow-800': status === 'جاري',
        'bg-red-100 text-red-800': status === 'ملغى',
      };
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
