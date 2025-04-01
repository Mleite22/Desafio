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
      alert('Usuario cadastrado com sucesso!');
      console.log('Usuario cadastrado com sucesso!');
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
  <header>
    <div class="wrapper">
      <img alt="banner login" class="banner" src="../../../assets/images/banner-2.png" />
      
    </div>
  </header>
  <div class="registro">
    <form class="form-registro" @submit.prevent="registrarUsuario">
      <h1>Cadastrar</h1>
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

      <div v-if="error" class="error">
        <p>{{ error }}</p>
      </div>

    </form>

  </div>

</template>

<style>
.form-registro {
  width: 100%;
  height: auto;
  display: grid;
  justify-content: center;
  align-items: center;
  /* margin: 5px 10px; */
  border-radius: 5px;
  /* background: #5e49fe; */
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
@media (min-width: 1024px) {
  .registro {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}

header {
  height: 100vh; 
  max-height: 100vh;
  
}

.banner {
  display: block;
  height: 100%;
  width: 100%;
  /* width: 100%;
  position: absolute; */
  margin-left: 20px;
  
}

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

  
}
</style>
