<template>

  <div class="primeira">
    <form class="form" @submit.prevent="logarAluno">
      <h1>Login</h1>
      <label>
        <span>Seu e-mail</span>
        <input class="input" type="email" v-model="email" name="email" placeholder="email@email.com.br">
      </label>
      <label>
        <span>Senha</span>
        <input class="input" type="password" v-model="password" name="password" placeholder="password">
      </label>
      <button type="button">Entrar</button>
    </form>
  </div>

  <div class="segunda">
    <form class="form" @submit.prevent="cadastrarAluno">
      <h1>Cadastro</h1>
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
    </form>

    <div v-if="error" class="error">
      <p>{{ error }}</p>
    </div>

  </div>

</template>

<script>
import axios from 'axios';
export default {

  data() {
    return {
      aluno: {
        name: '',
        email: '',
        password: ''
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
      axios.post('http://localhost:8000/api/users', this.aluno)
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
    logarAluno() {
      axios.post('http://localhost:8000/api/login', {
        email: this.email,
        password: this.password
      })
        .then(response => {
          // Tratar a resposta da API, por exemplo, armazenar o token de acesso
          console.log(response.data);
        })
        .catch(error => {
          // Tratar o erro, por exemplo, exibir uma mensagem de erro
          console.error(error);
        });
    }
  }

}


</script>

<style scoped>
.primeira {
  width: 40%;
  height: 50%;
  display: inline-block;
  background: #fff;
  box-shadow: 0 19px 38px black, 0 15px 12px rgba(0, 0, 0, 0.22);
  border-radius: 25px;
  vertical-align: top;
}

.segunda {
  width: 40%;
  display: inline-block;
  background: #fff;
  box-shadow: 0 19px 38px black, 0 15px 12px rgba(0, 0, 0, 0.22);
  border-radius: 25px;
  vertical-align: top;
  margin-left: 30px;
}

.input,
button {
  border: none;
  outline: none;
  background: none;
}

.input {
  display: block;
  width: 100%;
  padding-bottom: 5px;
  margin-top: 5px;
  font-size: 16px;
  border-bottom: 1px solid rgba(109, 93, 93, 0.4);
  text-align: center;
  font-family: 'Munito', sans-serif
}

h1 {
  color: black;
  padding-top: 10px;
  font-size: 30px;
}

.form {
  padding: 50px 30px;
  -webkit-transition: -webkit-transform 1.2s ease-in-out;
  transition: -webkit-transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out, -webkit-transform 1.2 ease-in-out;
}

label {
  display: block;
  width: 260px;
  margin: 25px auto 0;
  text-align: center;
}

label span {
  font-size: 14px;
  font-weight: 600;
  color: #505f75;
  text-transform: uppercase;
}

button {
  display: block;
  width: 260px;
  margin: 25px auto;
  height: 36px;
  border-radius: 30px;
  background-color: blue;
  font-size: 15px;
  font-weight: 600;
  color: white;
  cursor: pointer;
}

button:hover {
  background-color: #4CAF50;
}
</style>