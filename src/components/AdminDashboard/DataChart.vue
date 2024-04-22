<template>
    <div :style="{ width: chartWidth, height: chartHeight }"  class="bg-white p-6 rounded-lg shadow">
      <canvas ref="dataChart"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  Chart.register(...registerables);
  
  export default {
    props: {
      chartData: {
        type: Object,
        required: true,
      },
      chartOptions: {
        type: Object,
        default: () => {},
      },
      chartWidth: {
      type: String,
      default: '100%', // تحديد القيمة الافتراضية للعرض
    },
    chartHeight: {
      type: String,
      default: '300px', // تحديد القيمة الافتراضية للارتفاع
    },
    },
    mounted() {
      this.createChart();
    },
    methods: {
      createChart() {
        const ctx = this.$refs.dataChart.getContext('2d');
        new Chart(ctx, {
          type: this.chartData.type, // 'line', 'bar', 'pie', etc.
          data: this.chartData.data,
          options: this.chartOptions,
        });
      },
    },
  };
  </script>
  
  <style scoped>
  /* Tailwind CSS styles if needed */
  </style>
  