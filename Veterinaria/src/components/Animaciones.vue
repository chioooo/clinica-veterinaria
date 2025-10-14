<template>
    
    <button @click="mover = true">Inicio</button>
    <div :class="{ move: mover }"></div>
    <button @click="exists = !exists">{{ btnText }}</button><br>
    <p v-if="exists">¡Hola!</p>
    <p>Agregar nuevos servicios</p>
  <input type="text" v-model="inpNombre"> 
  <button @click="addEl">Agregar</button>
  <TransitionGroup tag="ol">
    <li v-for="x in servicios" :key="x">
      {{ x }}
    </li>
  </TransitionGroup>

    
  </template>
  
  <script>
  export default {
    data() {
      return {
        mover: false,
        exists: false,
        servicios: ['Baño','corte','consulta'],
        inpNombre: ''
      };
    },
    computed: {
      btnText() {
        return this.exists ? 'Remover' : 'Agregar';
      }
    },
    methods: {
      addEl() {
        const el = this.inpNombre;
        this.servicios.push(el);
        this.inpNombre = null;
      }
    }
  };
  </script>
  
  <style scoped>
  .move {
    animation: move 0.5s alternate 4 ease-in-out;
  }
  @keyframes move {
    from {
      transform: translate(0, 0);
    }
    to {
      transform: translate(70px, 0);
    }
  }
  div {
    border: solid black 2px;
    background-color: rgba(170, 182, 14, 0.625);
    border-radius: 50%;
    width: 60px;
    height: 60px;
  }
  h1, button, div {
    margin: 10px;
  }
  </style>