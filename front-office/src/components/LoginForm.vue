<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';

const email = ref('');
const password = ref('');

</script>

<template>
  <div class="login">
    <h1 class="title-login">Tela de Login</h1>
  </div>
  <form>
    <label for="">
      <span>Email</span>
      <input type="email" v-model="email" placeholder="E-mail" name="email">
    </label>
    <label for="">
      <span>Senha</span>
      <input type="password" v-model="password" placeholder="Senha" name="password">
    </label>
    <button type="submit">Entrar</button>
  </form>

</template>

<style scoped>
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 5px 10px;
  background: greenyellow;
}
.title-login {
  text-align: center;
}
</style>
