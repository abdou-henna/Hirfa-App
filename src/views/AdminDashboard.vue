<template>
  <nav-bar-r/>
  <div class="container mx-auto px-4 py-8 my-8" dir="rtl">
    <h1 class="text-3xl font-bold mb-8 text-center">لوحة تحكم الإدارة</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- بطاقات الإحصائيات -->
      <StatCard title="عدد الحرفيين" :value="stats.craftsmen" />
      <StatCard title="الطلبات الجديدة" :value="stats.newOrders" />
      <StatCard title="المراجعات الجديدة" :value="stats.newReviews" />

      <!-- مخططات البيانات -->
      <div class="md:col-span-2 lg:col-span-3">
        <div class="grid grid-cols-2 gap-4 ">
        <DataChart :chartData="chartData1" :chartOptions="chartOptions1" />
        <DataChart :chartData="chartData2" :chartOptions="chartOptions2" />
        <DataChart :chartData="chartData3" :chartOptions="chartOptions3" />
        </div>
      </div>

      <!-- قائمة الطلبات والمستخدمين الجدد -->
      <div class="lg:col-span-2">
        <OrdersList />
      </div>
      <div>
        <NewUsersList />
      </div>
    </div>
  </div>
  <FooterF/>
</template>

<script>
import StatCard from "../components/AdminDashboard/StatCard.vue";
import DataChart from "../components/AdminDashboard/DataChart.vue";
import OrdersList from "../components/AdminDashboard/OrdersList.vue";
import NewUsersList from "../components/AdminDashboard/NewUsersList.vue";
import NavBarR from "../components/NavBarR.vue";
import FooterF from "../components/FooterF.vue";

export default {
  components: {
    StatCard,
    DataChart,
    OrdersList,
    NewUsersList,
    NavBarR,
    FooterF,
  },
  data() {
    return {
      // يمكن هنا تحديد البيانات الخارجية أو جلبها من API
      stats: {
        craftsmen: 150,
        newOrders: 35,
        newReviews: 89,
      },
      chartData1: {
        type: "line",
        data: {
          labels: [
            "الأحد",
            "الاثنين",
            "الثلاثاء",
            "الأربعاء",
            "الخميس",
            "الجمعة",
            "السبت",
          ],
          datasets: [
            {
              label: "عدد الطلبات الجديدة",
              data: [12, 19, 3, 5, 2, 3, 9],
              fill: false,
              borderColor: "rgb(75, 192, 192)",
              tension: 0.1,
            },
          ],
        },
      },
      chartData2: {
        type: "bar",
        data: {
          labels: ["الحرفي A", "الحرفي B", "الحرفي C", "الحرفي D"],
          datasets: [
            {
              label: "متوسط التقييم",
              data: [4.5, 3.0, 5.0, 4.2],
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      },
      chartData3: {
        type: "pie",
        data: {
          labels: ["أعمال خشبية", "أعمال معدنية", "تصميم داخلي", "أعمال يدوية"],
          datasets: [
            {
              label: "توزيع الطلبات",
              data: [12, 19, 3, 5],
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
              ],
              hoverOffset: 4,
            },
          ],
        },
      },
    };
  },
};
</script>
