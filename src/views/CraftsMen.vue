<template>
    <div class="p-4 container">
      <div v-for="(craftsmen, craft) in craftsGroupedByType" :key="craft" class="mb-6">
        <h3 class="text-xl font-semibold mb-4">{{ craft }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="craftsman in craftsmen" :key="craftsman.id" class="flex flex-col items-center p-4 border rounded-lg shadow-lg">
            <img :src="craftsman.image" alt="Craftsman Photo" class="w-24 h-24 rounded-full">
            <h2 class="text-lg font-bold mt-2">{{ craftsman.name }}</h2>
            <div class="flex items-center mt-1">
              <star-rating :rating="craftsman.rating"></star-rating>
            </div>
            <p class="text-sm text-gray-600">{{ craftsman.workZone }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import StarRating from "../components/StarRating.vue";
  
  export default {
    name: 'CraftsmenList',
    components: {
      StarRating
    },
    data() {
      return {
        // Example structure for craftsmen organized by craft type
        craftsGroupedByType: {
          'Painting': [
            {
              id: 1,
              name: 'Alice Smith',
              rating: 4.7,
              workZone: 'Uptown',
              image: '/HirfaType/Build.jpg'
            },
            {
              id: 2,
              name: 'Alice Smith',
              rating: 4.7,
              workZone: 'Uptown',
              image: '/HirfaType/Build.jpg'
            },
            {
              id: 3,
              name: 'Alice Smith',
              rating: 4.7,
              workZone: 'Uptown',
              image: '/HirfaType/Build.jpg'
            },
          ],
          'Electrical': [
            {
              id: 4,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
            {
              id: 5,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
            {
              id: 6,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
            // ...more electricians
          ],
          'Plumbing': [
          {
              id: 7,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
          {
              id: 8,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
          {
              id: 9,
              name: 'Bob Johnson',
              rating: 4.5,
              workZone: 'Downtown',
              image: '/HirfaType/Build.jpg'
            },
          ],
          // ...other crafts
        }
      }
    }
  }
  </script>
  

  