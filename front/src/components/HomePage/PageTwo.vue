<template>
  <section class="py-12 bg-gray-10">
    <h2 class="text-4xl font-bold text-center mb-28">الحرفيين المميزين</h2>
    <div
      class="container mx-auto px-4 flex flex-wrap items-center justify-center gap-6"
    >
      <div
        v-for="craftsman in sortedCards"
        :key="craftsman.rank"
        :class="{ 'md:mb-36': craftsman.rank === 1 }"
        class="relative card bg-white bg-opacity-60 mt-20 md:mt-0"
        @click="gotocraft(craftsman.id)"
      >
        <img
          :src="craftsman.ProfileImg"
          :alt="craftsman.name"
          class="card-img border rounded-3xl  shadow-xl bg-white bg-opacity-50 cursor-pointer hover:shadow-2xl transition-shadow duration-300 ease-in-out absolute -top-10 left-1/2 transform -translate-x-1/2"
        />
        <div class="card-content p-4">
          <h3 class="font-bold text-xl mb-2 text-center">
            {{ craftsman.name }}
          </h3>
          <StarRating :rating="craftsman.rating" />
        </div>
      </div>
      <RouterLink :to="{name: 'craftsmen'}">
      <button class="btn mb-20">عرض كل الحرفيين</button></RouterLink>
    </div>
  </section>
</template>

<script setup>
import StarRating from "../StarRating.vue";
import { craftsmen, best_craftsmen } from '@/assets/data.js';
</script>

<script>
export default {
  data() {
    return {
      
    };
  },
  computed: {
    sortedCards() {
    // إعادة ترتيب الحرفيين بحيث يكون الحرفي رقم 1 في المنتصف
    const rankedCraftsmen = this.bestCraftsmenDetailed.slice(); // نسخة من المصفوفة
    const firstRankedIndex = rankedCraftsmen.findIndex(c => c.rank === 1);

    if (firstRankedIndex > -1) {
      // إزالة الحرفي برتبة 1 من مكانه الأصلي
      const [firstRankedCraftsman] = rankedCraftsmen.splice(firstRankedIndex, 1);
      // إضافة الحرفي برتبة 1 في المنتصف
      rankedCraftsmen.splice(Math.floor(rankedCraftsmen.length / 2), 0, firstRankedCraftsman);
    }
    
    return rankedCraftsmen;
  },
    bestCraftsmenDetailed() {
      return best_craftsmen.map(craftsman => {
        const detail = craftsmen.find(c => c.id === craftsman.id);
        return {
          ...detail,
          rank: craftsman.rank  // دمج الترتيب في البيانات المفصلة
        };
      });
    }
  },
  methods: {
    gotocraft(craftsmanId) {
      this.$router.push({ name: 'craftsmanprofile', params: { id: craftsmanId } });
    },
    getCraftsmanById(id) {
      return craftsmen.find(craftsman => craftsman.id === id);
    }
  },
};
</script>

<style scoped>
.card {
  width: 300px;
  height: 200px;
  border-radius: 0.25rem;
  position: relative;
  cursor: pointer;
  transition: box-shadow 0.3s ease;
  box-shadow: -4px 4px 6px 1px rgba(0, 0, 0, 0.1);
}

.card:hover {
  box-shadow: -10px 25px 30px 2px rgba(0, 0, 0, 0.1);
}

.card-img {
  width: 120px; /* Adjust size as needed */
  height: 120px; /* Adjust size as needed */
  object-fit: cover;
  position: absolute;
  top: -60px; /* Half the height to move it above the card content */
  left: 50%;
  transform: translateX(-50%);
  border-radius: 9999px;
  border: 4px solid white;
  background: white;
  z-index: 10;
}

.card-content {
  margin-top: 60px; /* Same as half the height of the image to push content down */
  z-index: 5;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.btn {
  @apply text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded;
}
</style>
