<script setup lang="ts">
import Navbar from './navbar/navbar.vue';
import Sidebar from './sidebar/sidebar.vue';

</script>

<template>
  
  <div class="conteiner">
    <Sidebar />
    <div class="main">
      <div class="header">
        <Navbar />

      </div>    
    </div>
    
  </div>
</template>

<style scoped>
.conteiner { 
  display: flex; /* Define o layout flexível */
  flex-direction: row;
  width: 100%;
  height: 100vh;
  background: #181818;
}
.main {
  flex: 1; /* Permite que o elemento principal ocupe o restante do espaço */ 
  background-color: #1f1f1f;
}
.header {
  height: 60px; /* Altura fixa para o cabeçalho */
  align-items: center;
  display: flex; /* Adicionando display flex para alinhar itens */
  justify-content: right; /* Alinhando itens à direita */
  padding: 0 20px; /* Adicionando espaçamento interno */
  background-color: #181818; /* Updated background color */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

</style>