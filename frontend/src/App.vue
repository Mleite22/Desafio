<template>
  <div>
    <LoginView />
    <AlunoView />
  </div>
</template>

<script>
import LoginView from './views/LoginView.vue';
import AlunoView from './views/AlunoView.vue';

export default {
  name: 'App',
  components: {
    LoginView,
    AlunoView
    
  }
};
</script>

<style>

</style>
