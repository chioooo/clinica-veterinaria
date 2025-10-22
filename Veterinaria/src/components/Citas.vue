<script setup lang="ts">
import { ref, onMounted } from 'vue'

const citas = ref([])
const showModal = ref(false)
const id_mascota = ref(null)
const id_veterinario = ref(null)
const fecha = ref(null)
const motivo = ref(null)
const mascotas = ref([])
const veterinarios = ref([])

const openModal = () => showModal.value = true
const closeModal = () => showModal.value = false

onMounted(async () => {
  try {
    const response = await fetch('http://localhost/EjMascota/php/get_citas.php')
    citas.value = await response.json()

    const resMascotas = await fetch('http://localhost/EjMascota/php/get_mascota.php')
    mascotas.value = await resMascotas.json()
    console.log("Mascotas:", mascotas.value)

    const resVet = await fetch('http://localhost/EjMascota/php/get_veterinarios.php')
    veterinarios.value = await resVet.json()
  } catch (error) {
    console.error('Error al obtener datos:', error)
  }
})

const registrarCita = async () => {
  try {
    const datos = {
      id_mascota: id_mascota.value,
      id_veterinario: id_veterinario.value,
      fecha: fecha.value,
      motivo: motivo.value
    }

    console.log("Datos enviados al servidor:", datos)

    const respuesta = await fetch('http://localhost/EjMascota/php/registro_cita.php', {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(datos)
    })

    const resultado = await respuesta.json()
    console.log("Respuesta del servidor:", resultado)

    if (!resultado.error) {
      id_mascota.value = null
      id_veterinario.value = null
      fecha.value = null
      motivo.value = null
      closeModal()

      const response = await fetch('http://localhost/EjMascota/php/get_citas.php')
      citas.value = await response.json()
    } else {
      alert("Error: " + resultado.mensaje)
    }
  } catch (error) {
    console.error('Error al registrar cita:', error)
  }
}
</script>

<template>

  <div id="titulo">
    <h1>Registros de citas</h1>
    <button class="btn-cita" @click="openModal"><i class="fa-solid fa-plus"></i>Crear</button>
  </div>

  <div>
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>ID mascota</th>
        <th>ID Veterinario</th>
        <th>Fecha</th>
        <th>Motivo</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="cita in citas" :key="cita.id">
        <td>{{ cita.id_cita }}</td>
        <td>{{ cita.id_mascota }}</td>
        <td>{{ cita.id_veterinario }}</td>
        <td>{{ cita.fecha }}</td>
        <td>{{ cita.motivo }}</td>
      </tr>
      </tbody>
    </table>
  </div>

  <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
    <div class="modal-content">
      <h2>Nueva cita</h2>
      <form @submit.prevent="registrarCita">
        <label>Mascota:</label>
        <select v-model="id_mascota" required>
          <option value="" disabled>Selecciona una mascota</option>
          <option v-for="m in mascotas" :key="m.id_mascota" :value="m.id_mascota">
            {{ m.nombre }}
          </option>
        </select>

        <label>Veterinario:</label>
        <select v-model="id_veterinario" required>
          <option value="" disabled>Selecciona un veterinario</option>
          <option v-for="v in veterinarios" :key="v.id_veterinario" :value="v.id_veterinario">
            {{ v.nombre }}
          </option>
        </select>

        <label>Fecha:</label>
        <input type="date" v-model="fecha" required />

        <label>Motivo:</label>
        <input type="text" v-model="motivo" required />

        <div class="modal-actions">
          <button type="button" @click="closeModal">Cancelar</button>
          <button type="submit">Guardar</button>
        </div>
      </form>

    </div>
  </div>


</template>

<style scoped>
#titulo {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.btn-cita {
  background: #04b54b;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  margin-bottom: 10px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #007bff;
  color: white;
}

.modal-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: #fff;
  padding: 30px 25px;
  border-radius: 12px;
  width: 420px;
  max-width: 90%;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  animation: modalFade 0.3s ease;
}

.modal-content h2 {
  margin-bottom: 20px;
  font-size: 1.6rem;
  color: #04b54b;
  text-align: center;
}

.modal-content label {
  display: block;
  margin-top: 12px;
  margin-bottom: 5px;
  font-weight: 500;
  color: #333;
}

.modal-content input,
.modal-content select {
  width: 400px;
  padding: 10px 12px;
  border: 1.5px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
  transition: 0.2s;
}

.modal-content input:focus,
.modal-content select:focus {
  border-color: #04b54b;
  outline: none;
  box-shadow: 0 0 5px rgba(4, 181, 75, 0.4);
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.modal-actions button {
  margin-left: 10px;
  padding: 8px 16px;
  border: none;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.2s;
}

.modal-actions button:first-child {
  background-color: #ccc;
  color: #333;
}

.modal-actions button:first-child:hover {
  background-color: #b3b3b3;
}

.modal-actions button:last-child {
  background-color: #04b54b;
  color: white;
}

.modal-actions button:last-child:hover {
  background-color: #039944;
}
</style>