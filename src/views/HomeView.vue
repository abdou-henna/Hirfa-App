<template >
  <nav-bar-h class="z-50"/>
  <main class="flex flex-col flex-1 items-center  content-center ">
    <page-one class="h-screen w-full"/>
    <PageTwoVue/>
    <page-three/>
  </main>
</template>

<script setup>
import NavBarH from '@/components/NavBarH.vue';
import PageOne from '@/components/HomePage/PageOne.vue';
import PageTwoVue from '@/components/HomePage/PageTwo.vue';
import PageThree from '@/components/HomePage/PageThree.vue';

</script>

