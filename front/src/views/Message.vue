<template>
  <div class="container max-w-3xl mx-auto shadow-lg border rounded-lg overflow-hidden md:h-[800px] h-[100vh] flex flex-col my-auto">
    <div class="relative">
      <div class="chat-header bg-gray-100 p-4 border-b text-center rounded-lg mt-3">
        <h2 class="text-xl font-semibold text-gray-900">{{ otherPartyName }}</h2>
        <div v-if="showRequestButtons" class="mt-2 flex justify-center space-x-4">
          <button @click="acceptRequest" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">قبول الطلب</button>
          <button @click="rejectRequest" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">رفض الطلب</button>
        </div>
      </div>
    </div>
    <!-- الرسائل مع سكرول -->
    <div class="messages flex-1 overflow-auto p-4 space-y-2" dir="rtl" ref="messagesContainer">
      <div v-for="(message, index) in messages" :key="index" class="break-words p-2" :class="{'bg-blue-500 text-white rounded-lg ml-auto w-auto max-w-xs': message.sent, 'bg-gray-50 text-black rounded-lg mr-auto w-auto max-w-xs': !message.sent,}">
        <div class="flex items-center space-x-2 mb-3">
          <img :src="message.avatar" alt="Avatar" class="w-7 h-7 rounded-full ml-3"/>
          <span :class="{'text-md text-gray-200': message.sent, 'text-md text-gray-500': !message.sent,}">{{ message.name }}</span>
        </div>
        <p class="mb-3">{{ message.text }}</p>
        <!-- إذا كانت هناك صورة، عرضها -->
        <img v-if="message.image" :src="message.image" alt="Image" class=" md:max-w-72 max-w-60 rounded-lg" @click="selectedImage = message.image">
        <div :class="{'text-xs text-gray-200 mt-1': message.sent, 'text-xs text-gray-500 mt-1': !message.sent,}">{{ message.timestamp }}</div>
        <div class="text-xs text-right text-gray-200" v-if="message.sent && message.seen">تمت المشاهدة</div>
      </div>
      <div ref="endOfMessages"></div>
    </div>
    <!-- مكان إرسال الرسالة ثابت -->
    <div class="send-message flex items-center justify-center p-4 ">
      <!-- زر لرفع الصور -->
      <input type="file" @change="handleImageUpload" class="hidden" ref="imageInput"/>
      <button @click="$refs.imageInput.click()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mr-2">صــورة</button>
      <input v-model="newMessage" type="text" placeholder="اكتب رسالة..." class="border p-2 w-[180px] md:w-fit rounded-lg flex-1" @keyup.enter="sendMessage" dir="rtl"/>
      <button @click="sendMessage" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 ml-2">إرسال</button>
    </div>
    <!-- مودال عرض الصورة بشكل مكبر -->
    <div v-if="selectedImage" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" @click="selectedImage = null">
      <img :src="selectedImage" class="max-w-full max-h-full rounded-lg" />
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      otherPartyName: "عبد العالي دوح",
      newMessage: "",
      messages: [
        {
          name: "عبد العالي دوح",
          text: "أهلا عبد الرحمان هذا تجريب فقط",
          avatar: "../public/build1.jpg",
          image: "../public/build2.jpg", // هنا يتم تعيين الصورة على null للرسائل بدون صور
          sent: false,
          timestamp: "10:00 AM",
          seen: true,
        }, 
        {
          name: "أنت",
          text: "أهلا عبد العالي نعم نحن نجرب هذا فقط",
          avatar: "../public/build1.jpg",
          image: null, // هنا أيضًا
          sent: true,
          timestamp: "10:02 AM",
          seen: true,
        },
        // يمكن إضافة المزيد من الرسائل حسب الحاجة
      ],
      selectedImage: null,
      showRequestButtons: true, // حالة للتحقق من عرض الأزرار
    };
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim() !== "") {
        this.messages.push({
          name: "أنت",
          text: this.newMessage,
          avatar: "../public/build1.jpg",
          image: null, // عند إرسال نص، نعين الصورة على null
          sent: true,
          timestamp: new Date().toLocaleTimeString(),
          seen: false,
        });
        this.newMessage = "";
      }
      this.$nextTick(() => {
        this.$refs.endOfMessages.scrollIntoView({ behavior: 'smooth', block: 'end' });
      });
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
          // إضافة الصورة كرسالة
          this.messages.push({
            name: "أنت",
            text: "", // عند إرسال صورة، نترك النص فارغًا
            avatar: "../public/build1.jpg",
            image: e.target.result, // نستخدم نتيجة قراءة الصورة كمسار
            sent: true,
            timestamp: new Date().toLocaleTimeString(),
            seen: false,
          });
          this.$nextTick(() => {
            this.$refs.endOfMessages.scrollIntoView({ behavior: 'smooth', block: 'end' });
          });
        };
        reader.readAsDataURL(file);
      }
    },
    acceptRequest() {
      alert("تم قبول الطلب");
      this.showRequestButtons = false;
    },
    rejectRequest() {
      alert("تم رفض الطلب");
      this.showRequestButtons = false;
    }
  },
};

</script>

<style scoped>
.messages {
  /* ضبط السكرول للرسائل فقط */
  overflow-y: scroll;
}
.message p {
  /* جعل النص يعود إلى السطر داخل الرسالة */
  word-wrap: break-word;
}
</style>
