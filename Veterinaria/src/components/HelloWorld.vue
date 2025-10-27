<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const msg = '¡Bienvenidos a la clínica Estética Veterinaria!';
const imgActive = ref('');
const imgs = [
  '/src/assets/img/gatoyperro.jpg',
  '/src/assets/img/dalmata.jpg',
  '/src/assets/img/huellas.jpg',
  '/src/assets/img/labrador.jpg',
  '/src/assets/img/perritos.jpg',
];
const indexNbr = ref(0);
let intervalId;

const newImg = () => {
  indexNbr.value++;
  if (indexNbr.value >= imgs.length) {
    indexNbr.value = 0;
  }
  imgActive.value = imgs[indexNbr.value];
};

onMounted(() => {
  imgActive.value = imgs[0];
  intervalId = setInterval(newImg, 2000);
});

onBeforeUnmount(() => {
  clearInterval(intervalId);
});
</script>

<template>
  <h2>{{ msg }}</h2>

  <div class="card">
    <p>¡Todo para tu mascota!</p>
  </div>

  <transition name="fade">
    <img v-if="imgActive" :key="imgActive" :src="imgActive" alt="Imagen de la mascota">
  </transition>

  <p class="read-the-docs">Conoce nuestros servicios</p>
</template>

<style scoped>
.read-the-docs {
  color: #888;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
img {
  width: 150px;
  margin: 20px;
  border-radius: 8px;
}
img:hover {
  cursor: pointer;
}
</style>
