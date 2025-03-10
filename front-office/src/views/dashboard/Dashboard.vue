<script setup lang="ts">
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';

const store = useStore();
const user = computed(() => store.getters.getUser);

onMounted(() => {
  console.log('Dados do usuário:', user.value);
});
</script>

<template>
  <div class="dashboard">
    <h1>Dashboard</h1>
    <div v-if="user" class="user-info">
      <h2>Bem-vindo!</h2>
      <p>Nome: {{ user.name }}</p>
      <p>Email: {{ user.email }}</p>
      <p>ID: {{ user.id }}</p>
    </div>
  </div>
</template>