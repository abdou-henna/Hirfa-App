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
        class="flex bg-[#f8f8f8] w-full font-semibold leading-4 px-3 h-[50px] border-2 border-solid border-[#f8f8f8] hover:bg-[#f4f4f4] shadow-[0_0_0_1px_rgba(0,0,0,0.075)] mt-4 rounded-md focus:outline-none focus:border-blue-400"
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