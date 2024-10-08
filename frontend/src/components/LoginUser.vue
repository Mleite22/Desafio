<template>
    <div>
        <form @submit.prevent="login">
        <label>Usuário:</label>
        <input type="text" v-model="username" />
        <br />
        <label>Senha:</label>
        <input type="password" v-model="password" />
        <br />
        <button type="submit">Entrar</button>
      </form>
    </div>
</template>

<script>
  export default {
    name: 'Login-User',
    data() {
      return {
        username: '',
        password: ''
      }
    },
    methods: {
      login() {
        //Adicionar a lógica de login
        
        console.log('Usuário:', this.username)
        console.log('Senha:', this.password)
      }
    }
  }
  </script>
  
  <style scoped>
  /* Adicione estilos aqui */
  </style>