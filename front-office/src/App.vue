<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  
  <header>
    

    <div class="wrapper">
      <img alt="banner login" class="banner" src="./assets/images/banner-2.jpg"/>
      <!-- <HelloWorld msg="You" /

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav> -->
    </div>
  </header>

  <RouterView />
</template>

<style scoped>
header {
  /* width: 100vh;*/
  height: 100vh; 
  /* line-height: 1.5; */
  max-height: 100vh;
  /* position: relative; */
  
}

.banner {
  display: block;
  height: 100%;
  width: 100%;
  /* width: 100%;
  position: absolute; */
  margin-left: 20px;
  
}

/* nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
  
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
} */

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

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
