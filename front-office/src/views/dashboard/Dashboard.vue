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
  console.log('Usuário Logado com sucesso!');
  // console.log('Dados do usuário:', user.value);
});
</script>

<template>
  
  <div class="main">
    <div>
      <router-link to="/" @click.prevent="logout">Sair</router-link>
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

<style scoped>
.main {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background: #3a3939;
}
.user-info {
  background-color: #82cf8f;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.user-info h2 {
  margin: 0;
  font-size: 24px;
}
.user-info p {
  margin: 5px 0;
  font-size: 18px;
}
</style>