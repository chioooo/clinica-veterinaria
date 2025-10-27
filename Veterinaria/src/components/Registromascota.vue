<script setup>
import { ref, onMounted } from "vue";

const especie = ref("");
const nombre = ref("");
const raza = ref("");
const edad = ref("");
const peso = ref("");
const id_cliente = ref("");
const mensaje = ref("");
const clientes = ref([]);

const registrarMascota = async () => {
  if (!nombre.value ||!especie.value || !raza.value || !edad.value || !peso.value || !id_cliente.value) {
    mensaje.value = "Todos los campos son obligatorios";
    return;
  }

  const datos = {
    nombre: nombre.value,
    especie: especie.value,
    raza: raza.value,
    edad: edad.value,
    peso: peso.value,
    id_cliente: id_cliente.value,
  };
  console.log("Enviando datos:", datos);  
  try {
    const respuesta = await fetch("http://localhost/clinica-veterinaria/php/RegistrarMascota.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(datos),
    });
    console.log("Respuesta del servidor:", respuesta); 
    const resultado = await respuesta.json();
    mensaje.value = resultado.mensaje || resultado.error;
    
    // Limpiar los campos después del registro exitoso holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    if (!resultado.error) {
      nombre.value = "";
      especie.value = "";
      raza.value = "";
      edad.value = "";
      peso.value = "";
      id_cliente.value = "";
    }
  } catch (error) {
    mensaje.value = "Error de conexión con el servidor";
  }
};

onMounted(async () => {
  try {
    const response = await fetch('http://localhost/clinica-veterinaria/php/get_clientes.php')
    clientes.value = await response.json()
  } catch (error) {
    console.error('Error al obtener datos:', error)
  }
})
</script>

<template>
  <div id="app">
    <main class="contenido">
      <section>
        <h3>Registro de Mascota</h3>
        <form @submit.prevent="registrarMascota">
          <label>Nombre de la Mascota:</label>
          <input type="text" v-model="nombre" required />

          <label>Especie:</label>
          <input type="text" v-model="especie" required />

          <label>Raza:</label>
          <input type="text" v-model="raza" required />

          <label>Edad:</label>
          <input type="text" v-model="edad" required />

          <label>Peso:</label>
          <input type="text" v-model="peso" required />

          <label>Cliente:</label>
          <select v-model="id_cliente" required>
            <option value="" disabled>Selecciona un cliente</option>
            <option v-for="v in clientes" :key="v.id_cliente" :value="v.id_cliente">
              {{ v.nombre }}
            </option>
          </select>

          <button type="submit">Registrar</button>
        </form>

        <p v-if="mensaje" class="mensaje">{{ mensaje }}</p>
      </section>
    </main>
  </div>
</template>

<style scoped>


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