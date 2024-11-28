<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const email = ref('');
const password = ref('');


//função logar
function logar(event: Event) {
  event.preventDefault();
  router.push('about');
}

</script>

<template>
  <div class="login">
    <h1 class="title-login">Tela de Login</h1>
  </div>
  <form @submit="logar">
    <label for="">
      <span>Email</span>
      <!-- <input type=""  placeholder="E-mail" name="email"> -->
      <input type="" v-model="email" placeholder="E-mail" name="email">
    </label>
    <label for="">
      <span>Senha</span>
      <!-- <input type="password"  placeholder="Senha" name="password"> -->
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
