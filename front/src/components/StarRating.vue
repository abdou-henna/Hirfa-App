<template>
  <div class="star-rating flex">
    <span v-for="star in 5" :key="star" class="star" :style="{ fontSize: `${starSize}rem` }" v-html="getStar(star)"></span>
  </div>
</template>

<script>
export default {
  props: {
    rating: {
      type: Number,
      required: true
    },
    starSize: {
      type: Number, // تغيير النوع إلى Number
      default: 2 // قيمة افتراضية بـ 2
    }
  },
  methods: {
    getStar(star) {
      const fullStar = '<span style="color: #f5eb3b;">&#9733;</span>'; // Filled Star
      const emptyStar = '<span style="color: #dcdcdc;">&#9733;</span>'; // Unfilled Star
      const halfStar = `<span style="position: relative; display: inline-block; color: #dcdcdc;">&#9733;<span style="position: absolute; left: 0; top: 0; width: ${this.getHalfStarWidth(star)}%; overflow: hidden; color: #f5eb3b;">&#9733;</span></span>`; // Partially Filled Star

      if (star <= Math.floor(this.rating)) {
        return fullStar;
      } else if (star > Math.ceil(this.rating)) {
        return emptyStar;
      } else {
        return halfStar;
      }
    },
    getHalfStarWidth(star) {
      if (star === Math.ceil(this.rating)) {
        return (this.rating % 1) * 100; // Calculate the percentage of the filled part in the last star
      }
      return 0;
    }
  }
};
</script>

<style scoped>


</style>
