<script setup lang="ts">
import LoginForm from '@/views/autenticacao/login/componente/LoginForm.vue';

</script>

<template>
  <header>
    <div class="wrapper">
      <img alt="banner login" class="banner" src="../../../assets/images/banner-2.jpg" />      
    </div>
  </header>
  <main>
    <LoginForm />
  </main>
</template>

<style scoped>
header {
  height: 100vh; 
  max-height: 100vh;
  
}

.banner {
  display: block;
  height: 100%;
  width: 100%;
  /* width: 100%;
  position: absolute; */
  margin-left: 20px;
  
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }


  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
    
  }

  
}
</style>