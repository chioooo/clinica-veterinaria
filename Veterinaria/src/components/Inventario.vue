<script setup lang="ts">
import { ref, onMounted } from 'vue'

const inventario = ref([])

onMounted(async () => {
  const response = await fetch('http://localhost/clinica-veterinaria/php/get_inventario.php')
  inventario.value = await response.json()
})
</script>

<template>
  <div id="titulo">
    <h1>Inventario de medicamentos  </h1>
 </div>
<div>
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Nombre del medicamento</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Fecha de caducidad</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="inv in inventario" :key="inv.id">
        <td>{{ inv.id_medicamento }}</td>
        <td>{{ inv.nombre }}</td>
        <td>{{ inv.cantidad }}</td>
        <td>{{ inv.precio }}</td>
        <td>{{ inv.fecha_caducidad }}</td>
      </tr>
      </tbody>
    </table>
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
</style>