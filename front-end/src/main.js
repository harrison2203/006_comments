import './assets/main.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import '@fortawesome/fontawesome-free/css/all.css';

const app = createApp(App)
const pinia = createPinia();


import {Cloudinary} from "@cloudinary/url-gen";

const cld = new Cloudinary({cloud: {cloudName: '<cloud_name>',},});

app.use(pinia)
app.use(router)

app.mount('#app')


