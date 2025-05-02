<script setup lang="ts">
import NovaSenhaForm from './componente/NovaSenhaForm.vue';



</script>

<template>
  <div class="section">
    <header>
      <div class="wrapper">
        <img alt="banner login" class="banner" src="../../../assets/images/banner-2.png" />      
      </div>
    </header>
    <main>
      <NovaSenhaForm />
    </main>
  </div>
</template>

<style scoped>
.section {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  
}
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
  .section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    
  }
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