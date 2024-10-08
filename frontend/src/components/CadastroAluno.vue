<template>
    <div>
        <h2>Cadastro de Aluno</h2>
        <form @submit.prevent="cadastrarAluno">
            <label>Nome:</label>
            <input v-model="aluno.name" type="text" />
            <br>
            <label>Email:</label>
            <input v-model="aluno.email" type="email" />
            <br>
            <label>Senha:</label>
            <input v-model="aluno.password" type="password" />
            <br>
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
    name: 'CadastroAluno',
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
            // Validação simples
            if (!this.aluno.name || !this.aluno.email || !this.aluno.password) {
                this.error = 'Todos os campos são obrigatórios.';
                return;
            }

            this.error = null; // Limpa qualquer erro anterior

            axios.post('http://localhost:8000/api/users', this.aluno)
                .then(response => {
                    alert(`Aluno cadastrado com sucesso! ID: ${response.data.id}`);
                    this.aluno.name = '';
                    this.aluno.email = '';
                    this.aluno.password = '';
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.message) {
                        this.error = error.response.data.message;
                    } else {
                        this.error = 'Ocorreu um erro ao tentar cadastrar o aluno.';
                    }
                });
        }
    }
};
</script>

<style>
.error {
    color: red;
    font-weight: bold;
}
</style>
