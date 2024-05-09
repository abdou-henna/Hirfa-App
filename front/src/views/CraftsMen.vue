<template>
  <div>
    <NavBarR />
    <div class="p-4 container bg-gray-50 bg-opacity-50 rtl">
      <h1 class="text-5xl font-marhey mb-10 text-center text-gray-800">
        قائمة الحرفيين
      </h1>
      <div class="flex justify-start mb-10 mr-8">
        <select
          v-model="selectedCraft"
          class="border border-gray-300 rounded-lg p-2"
        >
          <option value="">اختر الحرفة</option>
          <option
            v-for="(craftsmen, craft) in craftsGroupedByType"
            :value="craft"
            :key="craft"
          >
            {{ craft }}
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
        v-for="(craftsmen, craft) in filteredCraftsmen"
        :key="craft"
        class="mb-28"
      >
        <h3 class="text-3xl font-marhey my-10 mr-10 text-gray-800">
          {{ craft }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="craftsman in craftsmen"
            :key="craftsman.id"
            @click="gotocraft"
            class="flex flex-col items-center p-6 border rounded-xl shadow-xl bg-white bg-opacity-50 cursor-pointer hover:shadow-2xl transition-shadow duration-300 ease-in-out"
          >
            <img
              :src="craftsman.image"
              alt="صورة الحرفي"
              class="w-32 h-32 rounded-full border-2 border-gray-300"
            />
            <h2 class="text-xl font-bold mt-4">{{ craftsman.name }}</h2>
            <div class="flex items-center mt-2" dir="ltr">
              <star-rating :rating="craftsman.rating"></star-rating>
            </div>
            <p class="text-md mt-2 text-gray-500">{{ craftsman.workZone }}</p>
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

export default {
  name: "CraftsmenList",
  components: {
    StarRating,
    FooterF,
    NavBarR,
  },
  methods: {
    gotocraft() {
      this.$router.push("/craftsman");
    },
  },
  data() {
    return {
      selectedCraft: "",
      selectedRating: 0,
      // Example structure for craftsmen organized by craft type
      craftsGroupedByType: {
        "صباغون :": [
          {
            id: 1,
            name: "Alice Smith",
            rating: 2,
            workZone: "Uptown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 2,
            name: "Alice Smith",
            rating: 1,
            workZone: "Uptown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 3,
            name: "Alice Smith",
            rating: 3,
            workZone: "Uptown",
            image: "/HirfaType/Build.jpg",
          },
        ],
        "كهربائيون :": [
          {
            id: 4,
            name: "Bob Johnson",
            rating: 4,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 5,
            name: "Bob Johnson",
            rating: 5,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 6,
            name: "Bob Johnson",
            rating: 2.5,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
          // ...more electricians
        ],
        "سباكون :": [
          {
            id: 7,
            name: "Bob Johnson",
            rating: 4.5,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 8,
            name: "Bob Johnson",
            rating: 4.5,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
          {
            id: 9,
            name: "Bob Johnson",
            rating: 4.5,
            workZone: "Downtown",
            image: "/HirfaType/Build.jpg",
          },
        ],
        // ...other crafts
      },
    };
  },
  computed: {
    filteredCraftsmen() {
      if (!this.selectedCraft && this.selectedRating === 0) {
        return this.craftsGroupedByType;
      }
      let filtered = {};
      for (let craft in this.craftsGroupedByType) {
        if (!this.selectedCraft || this.selectedCraft === craft) {
          filtered[craft] = this.craftsGroupedByType[craft].filter(
            (craftsman) => craftsman.rating > this.selectedRating
          );
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
