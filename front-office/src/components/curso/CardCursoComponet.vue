<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
  curso: {
    id: number;
    titulo: string;
    descricao: string;
  };
}>();
</script>

<template>
  <div class="card-curso">
    <h2>{{ curso.titulo }}</h2>
    <p>{{ curso.descricao }}</p>
    <router-link :to="`/cursos/${curso.id}`">Ver mais</router-link>
  </div>
</template>



<style scoped>
.card-curso {
  border: 1px solid #eee;
  border-radius: 4px;
  padding: 16px;
  margin: 16px 0;
}
</style>