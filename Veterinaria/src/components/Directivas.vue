<template>
    <div>
      <h1 v-if="mostrar">¡Hola {{ nombre }}!</h1>
  
      <input v-model="nombre" placeholder="Escribe tu nombre">
      
      <button @click="toggleMostrar">
        {{ mostrar ? 'Ocultar' : 'Mostrar' }}
      </button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        nombre: '',
        mostrar: true
      }
    },
    methods: {
      toggleMostrar() {
        this.mostrar = !this.mostrar;
      }
    }
  }
  </script>