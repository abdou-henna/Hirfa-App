<template>
  <div class="w-full flex items-stretch">
    <div
      class="w-1/2 min-h-screen bg-hirfa-four-01 flex items-center justify-center"
    >
      <img src="../../public/HomeImg.jpg" class="w-[80%] place-self-center" />
    </div>
    <div class="w-1/2 flex items-center justify-center">
      <div class="w-[80%] m-auto h-full">
        <header class="w-full h-[50px] mt-10">
          <RouterLink to="/">
          <img
            src="../../public/Hirfa.png"
            class="w-[100px] float-right pr-[5px]"
          /></RouterLink>
        </header>
        <section class="w-full mx-10 mt-10">
          <div dir="rtl" class="m-6">
            <h1 class="font-cairo text-xl mb-2">تأكيد هويتك كحرفي</h1>
            <p class="font-normal text-lg">
              أكمل البيانات التالية لتأكيد هويتك.
            </p>
          </div>
          <div dir="rtl" class="m-6">
            <!-- رفع صورة شخصية -->
            <div class="mb-4">
              <label class="block mb-1 font-semibold">رفع صورة شخصية:</label>
              <div class="custom-file-upload">
                <input
                  type="file"
                  @change="handleFileUpload($event, 'personalPhoto')"
                  id="personalPhoto"
                  class="file-input"
                />
                <label for="personalPhoto" class="file-label">{{
                  personalPhotoName || "اختر ملف"
                }}</label>
              </div>
            </div>
            <!-- رفع بطاقة التعريف -->
            <div class="mb-4">
              <label class="block mb-1 font-semibold">رفع بطاقة التعريف:</label>
              <div class="custom-file-upload">
                <input
                  type="file"
                  @change="handleFileUpload($event, 'idCard')"
                  id="idCard"
                  class="file-input"
                />
                <label for="idCard" class="file-label">{{
                  idCardName || "اختر ملف"
                }}</label>
              </div>
            </div>
            <!-- رفع شهادة الحرفي إن وجدت -->
            <div class="mb-4">
              <label class="block mb-1 font-semibold"
                >رفع شهادة الحرفي (إن وجدت):</label
              >
              <div class="custom-file-upload mb-12">
                <input
                  type="file"
                  @change="handleFileUpload($event, 'craftCertificate')"
                  id="craftCertificate"
                  class="file-input"
                />
                <label for="craftCertificate" class="file-label">{{
                  craftCertificateName || "اختر ملف"
                }}</label>
              </div>
            </div>
            <button type="submit" @click="submitIdentityConfirmation()" class="form-button">تأكيد الهوية</button>
          </div>
        </section>
        
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      personalPhoto: null,
      personalPhotoName: "",
      idCard: null,
      idCardName: "",
      craftCertificate: null,
      craftCertificateName: "",
    };
  },
  methods: {
    handleFileUpload(event, type) {
      const file = event.target.files[0];
      this[type] = file;
      this[type + "Name"] = file ? file.name : "";
    },
    async submitIdentityConfirmation() {
      const formData = new FormData();
      if (this.personalPhoto) formData.append("personalPhoto", this.personalPhoto);
      if (this.idCard) formData.append("idCard", this.idCard);
      if (this.craftCertificate) formData.append("craftCertificate", this.craftCertificate);
      const config = {
					headers: {
						'Content-Type': 'multipart/form-data',
					}};
      try {
        const response = await axios.post('/complete_register', formData, config);
        console.log("Identity confirmed successfully", response);
      } catch (error) {
        console.error("Error confirming identity", error);
      }
    },
  },
};
</script>

<style scoped>
.file-input {
  display: none;
}

.custom-file-upload {
  display: block;
  width: 100%;
  border: 2px solid #f8f8f8;
  border-radius: 0.375rem;
  padding: 0.5rem;
  text-align: center;
  background-color: #f8f8f8;
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s;
}

.custom-file-upload:hover {
  background-color: #f4f4f4;
  border-color: #3b82f6;
}

.file-label {
  cursor: pointer;
  width: 100%;
  display: inline-block;
}

.form-button {
  display: block;
  width: 100%;
  background-color: #005cff;
  color: white;
  padding: 0.5rem;
  border-radius: 0.375rem;
  margin-top: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.form-button:hover {
  background-color: #004aca;
}
</style>
