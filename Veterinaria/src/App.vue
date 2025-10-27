<script setup>
import { RouterLink, RouterView } from 'vue-router';
</script>

<template>
  <div class="app-container">
    <nav class="navbar">
      <router-link to="/" class="nav-link">Inicio</router-link>
      <router-link to="/baño" class="nav-link">Baño</router-link>
      <router-link to="/consulta" class="nav-link">Consulta</router-link>
      <router-link to="/directivas" class="nav-link">Directivas</router-link>
      <router-link to="/registro" class="nav-link">Registro</router-link>
      <router-link to="/citas" class="nav-link">Citas</router-link>
      <router-link to="/inventario" class="nav-link">Inventario</router-link>
    </nav>

    <main class="content">
      <header class="header">
        <h2>Clínica y Estética Veterinaria</h2>
      </header>
      <router-view></router-view>
    </main>
  </div>
</template>

<style scoped>
.header {
  background: #007bff;
  color: white;
  text-align: center;
  padding: 15px;
}

/* Estilo general de la app */
.app-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  background: #f4f4f9;
  font-family: 'Arial', sans-serif;
}

/* Estilos para la barra de navegación */
.navbar {
  display: flex;
  justify-content: center;
  gap: 20px;
  width: 100%;
  background: #007bff;
  padding: 15px 0;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilos para los enlaces de navegación */
.nav-link {
  color: white;
  text-decoration: none;
  font-size: 18px;
  font-weight: bold;
  padding: 10px 15px;
  transition: background 0.3s, transform 0.2s;
  border-radius: 8px;
}

.nav-link:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.05);
}

/* Contenido principal */
.content {
  width: 90%;
  max-width: 1200px;
  margin-top: 20px;
  padding: 20px;
  background: white;
  border-radius: 10px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
</style>