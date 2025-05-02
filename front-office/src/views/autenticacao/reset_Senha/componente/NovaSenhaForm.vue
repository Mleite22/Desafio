<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';


const router = useRouter();
const store  = useStore();

const email = ref('');
const password = ref('');
const codigo = ref('');
const errorMessage = ref("");

// Função para nova senha
const novasenha = async () => {
  try {
    if (!email.value || !password.value || !codigo.value) {
      errorMessage.value = 'Todos os campos são obrigatórios.';
      return;
    }

    const response = await store.dispatch('atualizarSenha', {
      email: email.value,
      password: password.value, 
      codigo: codigo.value,
    });

    console.log(response);
    router.push('/');
  } catch (error) {
    if (error.response && error.response.data && error.response.data.message) {
      errorMessage.value = error.response.data.message;
    } else {
      errorMessage.value = 'Erro ao atualizar a senha. Tente novamente.';
    }
    console.error('Erro ao atualizar senha:', error);
  }
};


</script>

<template>
  
  <div class="section">
        
    <form @submit.prevent="novasenha">
      <div class="login">
        <h1 class="title-login">Nova Senha</h1>
      </div>
      <div>
        <label>Email</label>
        <input 
          type="email" 
          id="email"
          v-model="email" 
          placeholder="E-mail" 
          name="email"
          autocomplete="email"
        >
      </div>
      <div>
        <label>Senha</label>
        
        <input 
          type="password" 
          id="password"
          v-model="password" 
          placeholder="Digite sua nova senha" 
          name="password"
          autocomplete="off"
        >
      </div>
      <div>
        <label>Código</label>        
        <input 
          type="text" 
          id="codigo"
          v-model="codigo"
          placeholder="Digite o código recebido" 
          name="codigo"
          autocomplete="off"
        >
      </div>
      <button type="submit">Alterar Senha</button>
      <div v-if="errorMessage" class="error-message">
        {{ errorMessage }}
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
