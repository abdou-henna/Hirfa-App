import './assets/tailwind.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'


import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

// استيراد مكتبة v-calendar ومكون VDatePicker
import VCalendar from 'v-calendar';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const app = createApp(App)

// استخدام المكتبة وتمريرها كمكون لتطبيق Vue
app.use(router)
app.use(VCalendar)

app.mount('#app')