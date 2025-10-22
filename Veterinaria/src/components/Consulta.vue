<script setup lang="ts">
import { ref } from "vue";

const perroSeleccionado = ref("");
const nombre = ref("");
const raza = ref("");
const foto = ref("");
const consultas = ref([]);
const mensaje = ref("");

const obtenerConsulta = async () => {
  if (!perroSeleccionado.value) {
    mensaje.value = "Por favor, selecciona un perro.";
    return;
  }

  try {
    const respuesta = await fetch("http://localhost/clinica-veterinaria/php/control_consulta.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ nombrePerro: perroSeleccionado.value }),
    });

    const resultado = await respuesta.json();

    if (resultado.error) {
      mensaje.value = resultado.error;
      nombre.value = "";
      raza.value = "";
      foto.value = "";
      consultas.value = [];
      return;
    }

    nombre.value = resultado.nombre;
    raza.value = resultado.raza;
    foto.value = resultado.foto;
    consultas.value = resultado.consultas;
    mensaje.value = "";
  } catch (error) {
    mensaje.value = "Error de conexión con el servidor.";
  }
};
</script>

<template>
  <div class="container">

    <main class="contenido">
      <section>
        <h3>Consulta de Mascotas</h3>
        <form @submit.prevent="obtenerConsulta">
          <label for="perros">Selecciona un perro:</label>
          <select id="perros" v-model="perroSeleccionado">
            <option value="Tafi">Tafi</option>
            <option value="Rocky">Rocky</option>
            <option value="Timmy">Timmy</option>
            <option value="Cuco">Cuco</option>
          </select>
          <button type="submit">Ver Consulta</button>
        </form>

        <p v-if="mensaje" class="mensaje">{{ mensaje }}</p>

        <div v-if="nombre" class="resultado">
          <h4>Nombre: {{ nombre }}</h4>
          <h4>Raza: {{ raza }}</h4>
          <img v-if="foto" :src="'/img/' + foto" alt="Imagen de la mascota" />

          <h4>Consultas:</h4>
          <ul>
            <li v-for="(c, index) in consultas" :key="index">
              Fecha: {{ c.fecha }}, Motivo: {{ c.motivo }}, Costo: ${{ c.costo }}
            </li>
          </ul>
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

.contenido {
  padding: 20px;
}
</style>