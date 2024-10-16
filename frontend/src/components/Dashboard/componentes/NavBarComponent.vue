<template>
    <div class="navbarIcons">
      <h3 class="logo">Logo</h3>
      <a href="#" class="sair" @click="logout"><i class="fa-solid fa-right-to-bracket"></i>Sair</a>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'NavBarComponent',
    methods: {
      logout() {
        const token = localStorage.getItem('api_token'); // Recupera o token do localStorage
  
        if (token) {
          axios.post('http://127.0.0.1:8000/api/logout', {}, {
            headers: {
              'Authorization': `Bearer ${localStorage.getItem('api_token')}` // Passa o token no cabeçalho
            }
          })
          .then(() => {
            localStorage.removeItem('api_token'); // Remove o token do localStorage
            this.$router.push({ name: 'login' }); // Redireciona para a página de login
            //alert('Deslogado com sucesso!');
          })
          .catch(error => {
            console.error(error);
            alert('Erro ao tentar deslogar!');
          });
        } else {
          alert('Nenhum token encontrado. Faça login primeiro.');
        }
      }
    }
  }
  </script>
  
  <style scoped>
  .navbarIcons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
  }
  
  .sair {
    padding: 5px;
    color: var(--font-color);
  }
  </style>
  