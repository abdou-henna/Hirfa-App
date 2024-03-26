import './assets/tailwind.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// استيراد مكتبة v-calendar ومكون VDatePicker
import VCalendar from 'v-calendar';

const app = createApp(App)

// استخدام المكتبة وتمريرها كمكون لتطبيق Vue
app.use(router)
app.use(VCalendar)

app.mount('#app')
