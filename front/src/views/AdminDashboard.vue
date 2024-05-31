<template>
  <div>
    <nav-bar-r />
    <div class="container mx-auto px-4 py-8 my-8" dir="rtl">
      <h1 class="text-3xl font-bold mb-8 text-center">لوحة تحكم الإدارة</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- بطاقات الإحصائيات -->
        <StatCard title="عدد الحرفيين" :value="craftsmen.length" @click="showCraftsmenModal = true" />
        <StatCard title="عدد المستخدمين" :value="users.length" @click="showUsersModal = true" />
        <StatCard title="الطلبات الجديدة" :value="stats.newOrders" />
        <StatCard title="المراجعات الجديدة" :value="stats.newReviews" />

        <!-- مخططات البيانات -->
        <div class="md:col-span-2 lg:col-span-3">
          <div class="grid grid-cols-2 gap-4">
            <DataChart :chartData="chartData1" :chartOptions="chartOptions1" />
            <DataChart :chartData="chartData2" :chartOptions="chartOptions2" />
            <DataChart :chartData="chartData3" :chartOptions="chartOptions3" />
          </div>
        </div>

        <!-- قائمة الطلبات -->
        <div class="lg:col-span-2">
          <OrdersList />
        </div>
        <div>
          <NewUsersList />
        </div>
      </div>
    </div>

    <!-- نافذة منبثقة لعرض قائمة الحرفيين -->
    <transition name="fade">
      <div v-if="showCraftsmenModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-4xl relative" dir="rtl">
          <button @click="showCraftsmenModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <div class="flex justify-center mb-4 space-x-2">
            <button @click="activeCraftsmenTab = 'craftsmen'" :class="{'bg-blue-500 text-white': activeCraftsmenTab === 'craftsmen', 'bg-gray-200 text-gray-800': activeCraftsmenTab !== 'craftsmen'}" class="px-4 py-2 rounded-full transition duration-300 ml-2 ease-in-out transform hover:scale-105 focus:outline-none">الحرفيين</button>
            <button @click="activeCraftsmenTab = 'blocked'" :class="{'bg-blue-500 text-white': activeCraftsmenTab === 'blocked', 'bg-gray-200 text-gray-800': activeCraftsmenTab !== 'blocked'}" class="px-4 py-2 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none">المحظورين</button>
          </div>
          <div v-if="activeCraftsmenTab === 'craftsmen'">
            <h3 class="text-2xl font-semibold mb-4 text-center">قائمة الحرفيين</h3>
            <div class="max-h-96 overflow-y-auto">
              <table class="min-w-full mb-6">
                <thead>
                  <tr class="border-b">
                    <th class="text-right px-2 py-3">ID</th>
                    <th class="text-right px-2 py-3">الاسم</th>
                    <th class="text-right px-2 py-3">الحرفة</th>
                    <th class="text-right px-2 py-3">تاريخ الانضمام</th>
                    <th class="text-right px-2 py-3">الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="craftsman in craftsmen" :key="craftsman.id" class="border-b">
                    <td class="px-2 py-3">{{ craftsman.id }}</td>
                    <td class="px-2 py-3">{{ craftsman.name }}</td>
                    <td class="px-2 py-3">{{ craftsman.type }}</td>
                    <td class="px-2 py-3">{{ craftsman.joinDate }}</td>
                    <td class="px-2 py-3 flex gap-2">
                      <button @click="viewProfile(craftsman.id)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض الملف الشخصي</button>
                      <button @click="blockCraftsman(craftsman.id)" class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded">حظر</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div v-if="activeCraftsmenTab === 'blocked'">
            <h3 class="text-2xl font-semibold mb-4 text-center">قائمة الحرفيين المحظورين</h3>
            <div class="max-h-96 overflow-y-auto">
              <table class="min-w-full">
                <thead>
                  <tr class="border-b">
                    <th class="text-right px-2 py-3">ID</th>
                    <th class="text-right px-2 py-3">الاسم</th>
                    <th class="text-right px-2 py-3">الحرفة</th>
                    <th class="text-right px-2 py-3">تاريخ الانضمام</th>
                    <th class="text-right px-2 py-3">الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="craftsman in blockedCraftsmen" :key="craftsman.id" class="border-b">
                    <td class="px-2 py-3">{{ craftsman.id }}</td>
                    <td class="px-2 py-3">{{ craftsman.name }}</td>
                    <td class="px-2 py-3">{{ craftsman.type }}</td>
                    <td class="px-2 py-3">{{ craftsman.joinDate }}</td>
                    <td class="px-2 py-3 flex gap-2">
                      <button @click="unblockCraftsman(craftsman.id)" class="text-white bg-green-500 hover:bg-green-700 px-3 py-1 rounded">إلغاء الحظر</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- نافذة منبثقة لعرض قائمة المستخدمين -->
    <transition name="fade">
      <div v-if="showUsersModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-4xl relative" dir="rtl">
          <button @click="showUsersModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
          <div class="flex justify-center mb-4 space-x-2">
            <button @click="activeUsersTab = 'users'" :class="{'bg-blue-500 text-white': activeUsersTab === 'users', 'bg-gray-200 text-gray-800': activeUsersTab !== 'users'}" class="px-4 py-2 rounded-full transition duration-300 ml-2 ease-in-out transform hover:scale-105 focus:outline-none">المستخدمين</button>
            <button @click="activeUsersTab = 'blockedUsers'" :class="{'bg-blue-500 text-white': activeUsersTab === 'blockedUsers', 'bg-gray-200 text-gray-800': activeUsersTab !== 'blockedUsers'}" class="px-4 py-2 rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none">المحظورين</button>
          </div>
          <div v-if="activeUsersTab === 'users'">
            <h3 class="text-2xl font-semibold mb-4 text-center">قائمة المستخدمين</h3>
            <div class="max-h-96 overflow-y-auto">
              <table class="min-w-full mb-6">
                <thead>
                  <tr class="border-b">
                    <th class="text-right px-2 py-3">ID</th>
                    <th class="text-right px-2 py-3">الاسم</th>
                    <th class="text-right px-2 py-3">البريد الإلكتروني</th>
                    <th class="text-right px-2 py-3">تاريخ الانضمام</th>
                    <th class="text-right px-2 py-3">الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id" class="border-b">
                    <td class="px-2 py-3">{{ user.id }}</td>
                    <td class="px-2 py-3">{{ user.name }}</td>
                    <td class="px-2 py-3">{{ user.email }}</td>
                    <td class="px-2 py-3">{{ user.joinDate }}</td>
                    <td class="px-2 py-3 flex gap-2">
                      <button @click="viewUserProfile(user.id)" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">عرض الملف الشخصي</button>
                      <button @click="blockUser(user.id)" class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded">حظر</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div v-if="activeUsersTab === 'blockedUsers'">
            <h3 class="text-2xl font-semibold mb-4 text-center">قائمة المستخدمين المحظورين</h3>
            <div class="max-h-96 overflow-y-auto">
              <table class="min-w-full">
                <thead>
                  <tr class="border-b">
                    <th class="text-right px-2 py-3">ID</th>
                    <th class="text-right px-2 py-3">الاسم</th>
                    <th class="text-right px-2 py-3">البريد الإلكتروني</th>
                    <th class="text-right px-2 py-3">تاريخ الانضمام</th>
                    <th class="text-right px-2 py-3">الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in blockedUsers" :key="user.id" class="border-b">
                    <td class="px-2 py-3">{{ user.id }}</td>
                    <td class="px-2 py-3">{{ user.name }}</td>
                    <td class="px-2 py-3">{{ user.email }}</td>
                    <td class="px-2 py-3">{{ user.joinDate }}</td>
                    <td class="px-2 py-3 flex gap-2">
                      <button @click="unblockUser(user.id)" class="text-white bg-green-500 hover:bg-green-700 px-3 py-1 rounded">إلغاء الحظر</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <FooterF />
  </div>
</template>

<script>
import StatCard from "../components/AdminDashboard/StatCard.vue";
import DataChart from "../components/AdminDashboard/DataChart.vue";
import OrdersList from "../components/AdminDashboard/OrdersList.vue";
import NewUsersList from "../components/AdminDashboard/NewUsersList.vue";
import NavBarR from "../components/NavBarR.vue";
import FooterF from "../components/FooterF.vue";
import { craftsmen, users } from "@/assets/data.js"; // استيراد البيانات من data.js

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
      showCraftsmenModal: false,
      showUsersModal: false,
      activeCraftsmenTab: 'craftsmen',
      activeUsersTab: 'users',
      stats: {
        userNember: 300,
        newOrders: 35,
        newReviews: 89,
      },
      craftsmen: craftsmen,
      blockedCraftsmen: [],
      users: users,
      blockedUsers: [],
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
  methods: {
    viewProfile(id) {
      // منطق لعرض الملف الشخصي للحرفي
      alert(`عرض الملف الشخصي للحرفي ID: ${id}`);
    },
    blockCraftsman(id) {
      // منطق لحظر الحرفي
      const craftsman = this.craftsmen.find(c => c.id === id);
      if (craftsman) {
        this.craftsmen = this.craftsmen.filter(c => c.id !== id);
        this.blockedCraftsmen.push(craftsman);
      }
    },
    unblockCraftsman(id) {
      // منطق لإلغاء حظر الحرفي
      const craftsman = this.blockedCraftsmen.find(c => c.id === id);
      if (craftsman) {
        this.blockedCraftsmen = this.blockedCraftsmen.filter(c => c.id !== id);
        this.craftsmen.push(craftsman);
      }
    },
    viewUserProfile(id) {
      // منطق لعرض الملف الشخصي للمستخدم
      alert(`عرض الملف الشخصي للمستخدم ID: ${id}`);
    },
    blockUser(id) {
      // منطق لحظر المستخدم
      const user = this.users.find(u => u.id === id);
      if (user) {
        this.users = this.users.filter(u => u.id !== id);
        this.blockedUsers.push(user);
      }
    },
    unblockUser(id) {
      // منطق لإلغاء حظر المستخدم
      const user = this.blockedUsers.find(u => u.id === id);
      if (user) {
        this.blockedUsers = this.blockedUsers.filter(u => u.id !== id);
        this.users.push(user);
      }
    }
  }
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
</style>
