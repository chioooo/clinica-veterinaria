import { createRouter, createWebHistory } from 'vue-router';
import Baño from '../components/Baño.vue';
import Consulta from "../components/Consulta.vue";
import Directivas from "../components/Directivas.vue";
import Animaciones from "../components/Animaciones.vue";
import Registromascota from "../components/Registromascota.vue";

const routes = [
  { path: '/', component: () => import('../components/HelloWorld.vue') },
  { path: '/baño', component: Baño },
    { path: '/consulta', component: Consulta },
    { path: '/directivas', component: Directivas},
    { path: '/animaciones', component: Animaciones},
    { path: '/registro', component: Registromascota}
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
