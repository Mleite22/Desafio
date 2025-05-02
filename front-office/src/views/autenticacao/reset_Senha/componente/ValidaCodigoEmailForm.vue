<!-- heading -->
<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';


const router = useRouter();
const store  = useStore();

const email = ref('');
const codigo = ref('');
const errorMessage = ref('');

const validateCode = async () => {
  try {
        const response = await store.dispatch('validarCodigo', { email: email.value, codigo: codigo.value });

        if (response.status) {
            // Código válido
            localStorage.setItem('token', response.token);
            localStorage.setItem('user', JSON.stringify(response.user));
            console.log('Validado com sucesso!', response);
            await router.push('NovaSenha');
        } else if (response.message === 'Código inválido') {
            // Código inválido
            errorMessage.value = 'O código inserido é inválido. Tente novamente.';
        } else if (response.message === 'Código expirado') {
            // Código expirado
            errorMessage.value = 'O código expirou. Solicite um novo código.';
        } else {
            // Outro erro
            errorMessage.value = 'Erro ao validar o código. Tente novamente.';
        }
    } catch (error) {
        errorMessage.value = 'Erro ao validar o código. Tente novamente.';
        console.error(errorMessage.value, error);
    }
};


</script>

<template>
  
  <div class="section">
        
    <form @submit.prevent="validateCode">
      <div class="login">
        <h1 class="title-login">Valide seu Código</h1>
      </div>
      <div>
        <label>Email</label>
        <input 
          type="email" 
          id="email"
          v-model="email" 
          placeholder="Digite seu e-mail cadastrado" 
          name="email"
          autocomplete="email"
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
      <div>
        <p>Enviamos um código em seu e-mail para validar</p>
        <p>o seu cadastro, verifique sua caixa de entrada</p>
        <p>ou a pasta de spam.</p>
        <p>Digite seu e-mail e o código recebido</p>
        
      </div>
      <button type="submit">Enviar</button>
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
