<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

import { useStore } from 'vuex';

const store = useStore();
const router = useRouter();

const email = ref('');

async function handleRecuperarSenha(email:string){
    try {
        const response = await store.dispatch('recuperSenha', { email });
        alert(response.message); // Exibe a mensagem de sucesso
        // Redireciona para a página de validação do código
        await router.push({ name: 'ValidaCodigoEmail' });        
    } catch (error) {
        alert('Erro ao recuperar senha. Tente novamente.');
    }
}

</script>

<template>
  
  <div class="section">
        
    <form @submit.prevent="handleRecuperarSenha(email)">
      <div class="login">
        <h1 class="title-login">Recuperar Senha</h1>
      </div>
      <div>
        <label>Email</label>
        <!-- <input type=""  placeholder="E-mail" name="email"> -->
        <input 
          type="email" 
          id="email"          
          v-model="email"
          placeholder="Digite seu e-mail cadastrado" 
          name="email"
          autocomplete="email"
        >
      </div>
    
      <button type="submit">Enviar</button>
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

 

  .link {
    /* width: 50%; */
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    
   

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
