<template >
  <div>
  <nav-bar class="z-50"/>
  <main class="flex flex-col flex-1 items-center  content-center ">
    <page-one class="h-screen w-full"/>
    <PageTwoVue/>
    <page-three/>
    <PageFour/>
    <footer-f></footer-f>
  </main>
</div>
</template>

<script setup>
import NavBar from '@/components/NavBarR.vue';
import FooterF from '@/components/FooterF.vue';
import PageOne from '@/components/HomePage/PageOne.vue';
import PageTwoVue from '@/components/HomePage/PageTwo.vue';
import PageThree from '@/components/HomePage/PageThree.vue';
import PageFour from '@/components/HomePage/PageFour.vue';

</script>

