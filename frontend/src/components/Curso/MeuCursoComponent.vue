<template>
    <div class="card-p">
        <div v-if="loading">Carregando cursos...</div>
        <div v-if="error">{{ error }}</div>
        <div class="card" v-for="curso in cursos" :key="curso.id">
            <div class="titulo-card">
                <h2>{{ curso.curso.nome }}</h2>
            </div>
            <div class="descricao">
                <p>{{ curso.curso.descricao }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'MeuCursoComponent',

    data() {
        return {
            cursos: [],
            loading: false,
            error: null
        };
    },

    mounted() {
        this.fetchCursos();
    },

    methods: {
        fetchCursos() {
            const token = localStorage.getItem('api_token');
            if (!token) {
                this.error = "Token de autenticação não encontrado.";
                console.log("Token de autenticação não encontrado.");
                return;
            }

            this.loading = true; // Inicia o carregamento
            this.error = null; // Limpa erros anteriores

            axios.get('http://127.0.0.1:8000/api/cursoaluno', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
                .then(response => {
                    // Verifica se a estrutura da resposta é válida
                    this.cursos = response.data.cursoAlunos || [];
                })
                .catch(error => {
                    if (error.response) {
                        this.error = error.response.data.message || "Erro ao carregar cursos.";
                        console.error("Erro na requisição: ", error);
                    } else {
                        this.error = "Erro de rede ou servidor.";
                    }
                })
                .finally(() => {
                    this.loading = false; // Finaliza o carregamento
                });
        }
    }
}

</script>

<style src="./styleMeuCurso.css" scoped />