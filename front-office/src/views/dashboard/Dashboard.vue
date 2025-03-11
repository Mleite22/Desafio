<script setup lang="ts">
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import router from '@/router';

const store = useStore();
const user = computed(() => store.getters.getUser);

const logout = async () => {
  try{
    await store.dispatch('logout');
    router.push('/');
  } catch (error) {
    console.log("Erro ao fazer o logout: ", error)
  }
  
}

onMounted(() => {
  console.log('Dados do usuário:', user.value);
});
</script>

<template>
  
  <div class="dashboard">
    <div>
      <router-link to="/" @click.prevent="logout">Sair</router-li
  </div>
    <h1>Dashboard</h1>
    <div v-if="user" class="user-info">
      <h2>Bem-vindo!</h2>
      <p>Nome: {{ user.name }}</p>
      <p>Email: {{ user.email }}</p>
      <p>ID: {{ user.id }}</p>
    </div>
  </div>
</template>