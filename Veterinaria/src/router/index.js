import { createRouter, createWebHistory } from 'vue-router';
import Baño from '../components/Baño.vue';
import Consulta from "../components/Consulta.vue";
import Directivas from "../components/Directivas.vue";
import Registromascota from "../components/Registromascota.vue";
import Citas from "../components/Citas.vue";
import Inventario from "../components/Inventario.vue";

const routes = [
  { path: '/', component: () => import('../components/HelloWorld.vue') },
  { path: '/baño', component: Baño },
    { path: '/consulta', component: Consulta },
    { path: '/directivas', component: Directivas},
    { path: '/registro', component: Registromascota},
    { path: '/citas', component: Citas},
    {path: '/inventario', component: Inventario}

  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
