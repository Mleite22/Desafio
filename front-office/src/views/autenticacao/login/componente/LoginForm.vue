<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';


const router = useRouter();
const store  = useStore();

const email = ref('');
const password = ref('');
const errorMessage = ref("");

//função logar
const login = async () => {
  try {
    const response = await store.dispatch('login', {
      email: email.value,
      password: password.value
    });

    if (response.status ) {
      localStorage.setItem('token', response.token);
      localStorage.setItem('user', JSON.stringify(response.user));
      await router.push('dashboard');
    } 
  } catch (error) {
    errorMessage.value = 'Erro ao fazer login. Verifique suas credenciais.';
    console.error('Login failed:', error);
  }
}

</script>

<template>
  
  <div class="section">
    <div class="login">
      <h1 class="title-login">Tela de Login</h1>
    </div>
    <div class="link-cadastro">
      <!-- link do cadastro -->
      <a href="registro">Cadastre-se</a>
    </div>
    
    <form @submit.prevent="login">
      <div>
        <label>Email</label>
        <!-- <input type=""  placeholder="E-mail" name="email"> -->
        <input 
          type="email" 
          id="email"
          v-model="email" 
          placeholder="E-mail" 
          name="email"
          autocomplete="email"
        >
      </div>
      <div for="">
        <label>Senha</label>
        <!-- <input type="password"  placeholder="Senha" name="password"> -->
        <input 
          type="password" 
          id="password"
          v-model="password" 
          placeholder="Senha" 
          name="password"
          autocomplete="current-password"
        >
      </div>
      <button type="submit">Entrar</button>
    </form>
  </div>

</template>

<style scoped>
.section {
  
  height: auto;
  display: grid;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
  
 
}

  .login {
    width: 100%;
    height: auto;
    /* background: #49fec2; */
  }

  .title-login {
    text-align: center;
  }

  form {
    width: 100%;
    display: block;
    /* flex-direction: column; */
    justify-content: center;
    align-items: center;
    

    label {
    /* margin: 10px 0; */
    }

    input {
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 100%;
    }

    button {
      margin: 10px 0;
      padding: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: auto;
      background: #5e49fe;
      color: #fff;
      cursor: pointer;
    }
  }

 

  .link-cadastro {
    display: flex;
    justify-content: right;
    align-items: flex-end;
    margin: 5px 25px;
    border-radius: 5px;

    a {
      font-size: large;
      text-decoration: none;
      color: #5e49fe;
    }
  }



@media screen and (min-width: 768px) {
  .section {
    width: 100%;
    height: auto;
    margin-top: 40px;
    padding-top: 25px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  
}
</style>
