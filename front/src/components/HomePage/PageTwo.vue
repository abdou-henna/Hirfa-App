<template>
  <section class="py-12 bg-gray-10">
    <h2 class="text-4xl font-bold text-center mb-28">الحرفيين المميزين</h2>
    <div
      class="container mx-auto px-4 flex flex-wrap items-center justify-center gap-6"
    >
      <div
        v-for="craftsman in sortedCards"
        :key="craftsman.order"
        :class="{ 'md:mb-36': craftsman.order === 2 }"
        class="relative card bg-white bg-opacity-60 mt-20 md:mt-0"
        @click="gotocraft"
      >
        <img
          :src="craftsman.image"
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
</script>

<script>
export default {
  data() {
    return {
      craftsmen: [
        {
          id: 1,
          name: "حرفي 1",
          hirfa: " صباغ ",
          rating: 2.9,
          image: "/HirfaType/Build.jpg",
          order: 2,
        },
        {
          id: 2,
          name: "حرفي 2",
          hirfa: " بناء ",
          rating: 3.5,
          image: "/HirfaType/Build.jpg",
          order: 1,
        },
        {
          id: 3,
          name: "حرفي 3",
          hirfa: " كهربائي ",
          rating: 4.8,
          image: "/HirfaType/Build.jpg",
          order: 3,
        },
      ],
    };
  },
  computed: {
    sortedCards() {
      return this.craftsmen.sort((a, b) => a.order - b.order);
    },
  },
  methods: {
    gotocraft(){
      this.$router.push('/craftsman');
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
