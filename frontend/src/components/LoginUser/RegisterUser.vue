<template>
  <div class="segunda">
    <form class="form" @submit.prevent="cadastrarAluno">
      <h1>Cadastrar</h1>
      <label>
        <span>Seu nome</span>
        <input class="input" type="text" v-model="aluno.name" name="name" placeholder="Nome">
      </label>
      <label>
        <span>Seu e-mail</span>
        <input class="input" type="email" v-model="aluno.email" name="email" placeholder="email@email.com.br">
      </label>
      <label>
        <span>Senha</span>
        <input class="input" type="password" v-model="aluno.password" name="password" placeholder="Minimo 6 digitos">
      </label>
      <button type="submit">Cadastrar</button>

      <div v-if="error" class="error">
        <p>{{ error }}</p>
      </div>

    </form>

  </div>
</template>

<script>
import Api from '@/http/Api';
export default {
  data() {
    return {
      aluno: {
        name: '',
        email: '',
        password: '',
      },
      error: null
    };
  },
  methods: {
    cadastrarAluno() {
      //Validação
      if (!this.aluno.name || !this.aluno.email || !this.aluno.password) {
        this.error = 'Todos os campos são obrigatórios.';
        return;
      }
      if (this.aluno.password.length < 6) {
        this.error = 'A senha deve ter no mínimo 6 caracteres.';
        return;
      }
      this.error = null; // Limpa qualquer erro anterior
      
     Api().post('/users', this.aluno)
      
        .then(response => {
          alert(`Aluno cadastrado com sucesso! name: ${response.data.user.name}`);

          this.aluno.name = '';
          this.aluno.email = '';
          this.aluno.password = '';
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            this.error = 'Email já cadastrado';
          } else {
            this.error = 'Ocorreu um erro ao tentar cadastrar o aluno.';
          }
        });
        
      

    },

  }
}
</script>

<style src="./styleLogin.css" scoped />