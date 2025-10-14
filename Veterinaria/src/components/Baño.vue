<script setup>
import {ref} from "vue";

const razaSeleccionada = ref("");
const costo = ref(null);
const nombre = ref("");
const raza = ref("");
const foto = ref("");
const mensaje = ref("");

const calcularCosto = async () => {
  if (!razaSeleccionada.value) {
    mensaje.value = "Por favor, selecciona una raza.";
    return;
  }

  try {
    const respuesta = await fetch("http://localhost/Ejmascota/php/control.php", {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body: new URLSearchParams({razas: razaSeleccionada.value}),
    });

    const resultado = await respuesta.json();

    if (resultado.error) {
      mensaje.value = resultado.error;
      costo.value = null;
      return;
    }

    costo.value = resultado.costo;
    nombre.value = resultado.nombre;
    raza.value = resultado.raza;
    foto.value = resultado.foto;
    mensaje.value = "";
  } catch (error) {
    mensaje.value = "Error de conexión con el servidor.";
  }
};
</script>

<template>
  <div class="container">
    <header class="header">
      <h2>Clínica y Estética Veterinaria</h2>
    </header>

    <nav class="menu">
      <h3>Menú</h3>
      <div class="submenu">
        <router-link to="/registro-mascota">Registro de la Mascota</router-link>
      </div>
    </nav>

    <main class="contenido">
      <section>
        <h3>Calcula el costo del baño</h3>
        <form @submit.prevent="calcularCosto">
          <label for="razas">Selecciona una raza:</label>
          <select id="razas" v-model="razaSeleccionada">
            <option value="chihuahua">Chihuahua</option>
            <option value="golden">Golden Retriever</option>
            <option value="salchicha">Salchicha</option>
            <option value="pastor belga">Pastor belga</option>
          </select>
          <button type="submit">Calcular</button>
        </form>

        <p v-if="mensaje" class="mensaje">{{ mensaje }}</p>

        <div v-if="costo !== null" class="resultado">
          <h3>El costo del baño es: ${{ costo }}</h3>
          <h4>Para el perrito: {{ nombre }}</h4>
          <h4>Raza: {{ raza }}</h4>
          <img v-if="foto" :src="'/img/' + foto" alt="Imagen de la mascota"/>
        </div>
      </section>
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

.menu {
  background: #f4f4f4;
  padding: 15px;
}

.submenu a {
  color: #333;
  text-decoration: none;
}

.contenido {
  padding: 20px;
}
</style>