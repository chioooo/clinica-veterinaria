<script setup>
import { ref } from "vue";

const num = ref("");
const mascota = ref("");
const raza = ref("");
const dueño = ref("");
const mensaje = ref("");

const registrarMascota = async () => {
  if (!num.value ||!mascota.value || !raza.value || !dueño.value) {
    mensaje.value = "Todos los campos son obligatorios";
    return;
  }

  const datos = {
    num: num.value,
    nombre: mascota.value,
    raza: raza.value,
    dueño: dueño.value,
  };
  console.log("Enviando datos:", datos);  
  try {
    const respuesta = await fetch("http://localhost/EjMascota/php/RegistrarMascota.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(datos),
    });
    console.log("Respuesta del servidor:", respuesta); 
    const resultado = await respuesta.json();
    mensaje.value = resultado.mensaje || resultado.error;
    
    // Limpiar los campos después del registro exitoso
    if (!resultado.error) {
      num.value = ""; 
      mascota.value = "";
      raza.value = "";
      dueño.value = "";
    }
  } catch (error) {
    mensaje.value = "Error de conexión con el servidor";
  }
};
</script>

<template>
  <div id="app">
    <header class="header">
      <h2>Clínica y Estética Veterinaria</h2>
    </header>

    <main class="contenido">
      <section>
        <h3>Registro de Mascota</h3>
        <form @submit.prevent="registrarMascota">
          <label>Cve:</label>
          <input type="text" v-model="num" required /> 
          
          <label>Nombre de la Mascota:</label>
          <input type="text" v-model="mascota" required />

          <label>Raza:</label>
          <input type="text" v-model="raza" required />

          <label>Nombre del Dueño:</label>
          <input type="text" v-model="dueño" required />

          <button type="submit">Registrar</button>
        </form>

        <p v-if="mensaje" class="mensaje">{{ mensaje }}</p>
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
  max-width: 400px;
  margin: auto;
}

form {
  display: flex;
  flex-direction: column;
}

input, button {
  margin: 5px 0;
  padding: 10px;
}

button {
  background: #007bff;
  color: white;
  border: none;
  cursor: pointer;
}

.mensaje {
  margin-top: 10px;
  font-weight: bold;
  color: #d9534f;
}
</style>