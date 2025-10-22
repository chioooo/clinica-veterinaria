/*import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router';

App.use(router);
createApp(App).mount('#app')*/

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './assets/css/all.min.css'


const app = createApp(App);
app.use(router);
app.mount('#app');



