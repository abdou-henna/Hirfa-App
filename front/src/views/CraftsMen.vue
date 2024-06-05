<template>
  <div>
    <NavBarR />
    <div class="p-4 container bg-gray-50 bg-opacity-50 rtl">
      <h1 class="text-5xl font-marhey mb-10 text-center text-gray-800">
        قائمة الحرفيين
      </h1>
      <div class="flex justify-start mb-10 mr-8">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="ابحث عن الحرفي بالاسم"
          class="border border-gray-300 rounded-lg p-2 ml-4"
        />
        <select
          v-model="selectedCraft"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">اختر الحرفة</option>
          <option v-for="typpe in craftsmanTypes" :value="typpe" :key="typpe">
            {{ typpe }}
          </option>
        </select>
        <select
          v-model="selectedRating"
          class="border border-gray-300 rounded-lg p-2 mr-4"
        >
          <option value="0">كل التقييمات</option>
          <option value="2">أكثر من نجمتين</option>
          <option value="3">أكثر من 3 نجمات</option>
          <option value="4">أكثر من 4 نجمات</option>
        </select>
      </div>
      <div
        v-for="(craftsmen, type) in filteredCraftsmen"
        :key="type"
        class="mb-28"
      >
        <h3 class="text-3xl font-marhey my-10 mr-10 text-gray-800">
          {{ type }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="craftsman in craftsmen"
            :key="craftsman.id"
            @click="gotocraft(craftsman.id)"
            class="flex flex-col items-center p-6 border rounded-xl shadow-xl bg-white bg-opacity-50 cursor-pointer hover:shadow-2xl transition-shadow duration-300 ease-in-out"
          >
            <img
              :src="craftsman.ProfileImg"
              :alt="craftsman.name"
              class="w-32 h-32 rounded-full border-2 border-gray-300"
            />
            <h2 class="text-xl font-bold mt-4">{{ craftsman.name }}</h2>
            <div class="flex items-center mt-2" dir="ltr">
              <star-rating :rating="craftsman.rating"></star-rating>
            </div>
            <p class="text-md mt-2 text-gray-500">{{ craftsman.place }}</p>
          </div>
        </div>
      </div>
    </div>
    <footer-f></footer-f>
  </div>
</template>


<script>
import NavBarR from "../components/NavBarR.vue";
import StarRating from "../components/StarRating.vue";
import FooterF from "../components/FooterF.vue";
import { craftsmen, getCraftsmenByType } from "@/assets/data.js";

export default {
  name: "CraftsmenList",
  components: {
    StarRating,
    FooterF,
    NavBarR,
  },
  data() {
    return {
      craftsmen: craftsmen,
      selectedCraft: "",
      selectedRating: 0,
      searchQuery: "", // إضافة حقل البحث
    };
  },
  methods: {
    gotocraft(craftsmanId) {
      this.$router.push({
        name: "craftsmanprofile",
        params: { id: craftsmanId },
      });
    },
    getCraftsmenByType,
  },
  computed: {
    craftsmanTypes() {
      return [...new Set(this.craftsmen.map((craftsman) => craftsman.type))];
    },
    filteredCraftsmen() {
      let filtered = {};
      for (let type of this.craftsmanTypes) {
        let craftsmenOfType = this.craftsmen.filter((craftsman) => {
          return (
            craftsman.type === type &&
            craftsman.rating >= this.selectedRating &&
            (this.selectedCraft === "" || craftsman.type === this.selectedCraft) &&
            (this.searchQuery === "" || craftsman.name.includes(this.searchQuery))
          );
        });
        if (craftsmenOfType.length > 0) {
          filtered[type] = craftsmenOfType;
        }
      }
      return filtered;
    },
  },
};

</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Cairo:wght@600&family=Amiri:ital,wght@0,700;1,400&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Marhey:wght@300..700&display=swap");

/* إضافة دعم للغة العربية وتغيير اتجاه النص */
.rtl {
  direction: rtl;
  font-family: "Cairo", sans-serif;
}

.font-marhey {
  font-family: "Marhey", sans-serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}
/* يمكنك إضافة المزيد من التعديلات النمطية هنا */
</style>
