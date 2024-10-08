<template>
    <div>
        <h2>Cadastro de Curso</h2>
        <form @submit.prevent="cadastrarCurso">
            <label>Nome do Curso:</label>
            <input v-model="curso.nome" type="text" />

            <label>Vagas:</label>
            <input v-model="curso.vagas" type="number" />

            <label>Modalidade:</label>
            <select v-model="curso.modalidade">
                <option value="online">Online</option>
                <option value="presencial">Presencial</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            curso: {
                nome: '',
                vagas: 0,
                modalidade: 'online'
            }
        };
    },
    methods: {
        cadastrarCurso() {
            axios.post('http://localhost:8000/api/curso', this.curso)
                .then(() => {
                    alert(`Curso cadastrado com sucesso!`);
                    this.curso.nome = '';
                    this.curso.vagas = 0;
                    this.curso.modalidade = 'online';
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.message) {
                        this.error = error.response.data.message;
                    } else {
                        this.error = 'Ocorreu um erro ao tentar cadastrar o curso.';
                    }
                });
        }
    }
};
</script>