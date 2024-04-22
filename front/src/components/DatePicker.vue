<template>
  <VDatePicker
    dir="ltr"
    v-model="date"
    :popover="false"
    :masks="masks"
  >
    <template #default="{ togglePopover, inputEvents }">
      <input
        dir="rtl"
        :value="formattedDate"
        v-on="inputEvents"
        class="input-style w-full"
        @click="() => togglePopover()"
        :placeholder="placeholderText"
      />
    </template>
  </VDatePicker>
</template>

<script setup>
import { ref, computed } from 'vue';
const date = ref(null);

const masks = ref({
  input: 'YYYY-MM-DD',
});
const formattedDate = computed(() => {
  if (date.value) {
    return date.value.toLocaleDateString();
  } else {
    return '';
  }
});
const placeholderText = computed(() => {
  return  'تاريخ الميلاد';
});
</script>
<style scoped>
.input-style {
  background-color: #f8f8f8;
  border: 2px solid #f8f8f8;
  border-radius: 0.375rem; /* 6px */
  font-family: font-semibold;
  padding: 0.5rem;
  transition: background-color 0.3s, border-color 0.3s;
}

.input-style:hover,
.input-style:focus {
  background-color: #f4f4f4;
  border-color: #3B82F6; /* Tailwind blue-500 */
}
</style>