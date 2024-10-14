<template>
    <div class="primeira">
        <form class="form" @submit.prevent="logarAluno">
            <h1>Logar</h1>
            <label>
                <span>Seu e-mail</span>
                <input class="input" type="email" v-model="email" name="email" placeholder="email@email.com.br">
            </label>
            <label>
                <span>Senha</span>
                <input class="input" type="password" v-model="password" name="password" placeholder="*********">
            </label>
            <button type="submit">Entrar</button>

            <div v-if="error" class="error">
                <p>{{ error }}</p>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
axios.defaults.withCredentials = true;

export default {
    name: 'LoginUser',  // Corrigido de 'nome' para 'name'
    data() {
        return {
            email: '',
            password: '',
            error: null
        };
    },

    methods: {
        async logarAluno() {
            // Obtém o cookie CSRF antes de logar
            await axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie');

            axios.post('http://127.0.0.1:8000/api', {
                email: this.email,
                password: this.password
            })
                .then(response => {
                    const token = response.data.token;
                    localStorage.setItem('api_token', token);
                    this.$router.push({ name: '/home' });
                })
                .catch(error => {
                    if (error.response && error.response.status === 401) {
                        this.error = 'Credenciais inválidas';
                    } else {
                        this.error = 'Ocorreu um erro ao tentar logar o aluno.';
                        console.error(error);
                    }
                    // Limpar os campos após erro de autenticação
                    this.email = '';   // Opcional: limpar o e-mail
                    this.password = '';
                });
        }
    }

}
</script>

<style src="./styleLogin.css" scoped />
