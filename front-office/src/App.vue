<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { useStore } from 'vuex';
import { onMounted } from 'vue';

const store = useStore();

onMounted(() => {
    store.dispatch('initializeStore');
});

</script>

<template>
  
 

  <RouterView />
</template>


