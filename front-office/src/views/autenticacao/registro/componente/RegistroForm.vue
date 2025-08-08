<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import {useStore} from "vuex";

const router = useRouter();
const store = useStore();
const name = ref('');
const email = ref('');
const password = ref('');
const error = ref<string | null>(null);

const registrarUsuario = async () => {
  try {
    error.value = null;
    const response = await store.dispatch('registro', {
      name: name.value,
      email: email.value,
      password: password.value
    })
    if (response.status) {
      alert('Cadastrado com sucesso! Confira sue e-mail para confirmar o registro.');
      console.log('Cadastrado com sucesso! Confira sue e-mail para confirmar o registro.');
      await router.push('/');
    } 
    console.log('Usuario cadastrado com sucesso!');
  } catch (err) {
    alert('Erro ao registrar: ' + err.message);
    error.value = ('Erro ao registrar: ' + err.message);

  }
}

</script>

<template>
  
  <div class="section">

    
    <form @submit.prevent="registrarUsuario">
      <div class="resgistro">
        <h1 class="title-resgistro">Cadastrar</h1>
      </div>
      <div>
        <label>Seu nome</label>
        <input 
          class="input" 
          type="text" 
          v-model="name"  
          name="name" 
          placeholder="Nome"
        >
      </div>
      <div>
        <label>Seu e-mail</label>
        <input 
          class="input" 
          type="email" 
          v-model="email" 
          name="email" 
          placeholder="email@email.com.br"
        >
      </div>
      <div>
        <label>Senha</label>
        <input 
          class="input" 
          type="password"
          v-model="password"  
          name="password" 
          placeholder="Minimo 6 digitos"
        >
      </div>
      <button type="submit">Cadastrar</button>
      <div class="link-login">
      <!-- link do cadastro -->
      <a href="/">Retornar Login</a>
    </div>
      <div v-if="error" class="error-message">
        {{ error }}
      </div>
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

  .resgistro {
    width: 100%;
    height: auto;
    /* background: #49fec2; */
  }

  .title-resgistro {
    text-align: center;
  }

  form {
    width: 100%;
    display: block;
    /* flex-direction: column; */
    justify-content: center;
    align-items: center;
    


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

 

  .link-login {
    display: flex;
    justify-content: left;
    align-items: flex-end;
    /* margin: 5px 25px; */
   

    a {
      font-size: large;
      text-decoration: none;
      color: #5e49fe;
    }
  }


  .error-message {
    color: red;
    text-align: center;
    margin-top: 10px;
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
