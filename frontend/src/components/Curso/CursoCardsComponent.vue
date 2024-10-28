<template>
    <di class="card-p">
        <div v-if="loading">Carregando cursos...</div>
        <div v-if="error">{{ error }}</div>
        
        <!-- Card 1 -->
        <div class="card" v-for="curso in cursos" :key="curso.id">
            
            <!-- Foto generica -->
            <div class="imagens-curso">
                <img src="../../assets/images/curso-1.jpg" alt="" srcset="">
            </div>

            <div class="titulo-card">
                <h2>{{ curso.nome }}</h2>
            </div>
            <div class="descricao">
                <p>{{ curso.descricao }}</p>
            </div>
            <div class="descricao">
                <p><strong> {{ curso.modalidade }}</strong></p>
            </div>
        </div>
        <div class="pagination">
            <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Anterior</button>
            <span>Página {{ currentPage }} de {{ lastPage }}</span>
            <button @click="goToPage(currentPage + 1)" :disabled="currentPage === lastPage">Próximo</button>
        </div>
    </di>

</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            cursos: [],
            loading: false,
            error: null,
            currentPage: 1,
            lastPage: 1,
        };
    },
    mounted() {
        
        this.fetchCursos();
       
        axios.get('http://127.0.0.1:8000/api/curso')
            .then(response => {
                this.cursos = response.data.curso;
            })
            .catch(error => {
                console.error('Erro ao buscar os cursos', error);
            });
    },
    methods: {
    fetchCursos(page = 1) {
        this.loading = true; // Inicia o carregamento
        this.error = null; // Limpa erros anteriores

        axios.get(`http://127.0.0.1:8000/api/curso?page=${page}`)
            .then(response => {
                this.cursos = response.data.curso;
                this.currentPage = response.data.pagination.current_page; // Página atual
                this.lastPage = response.data.pagination.last_page; // Última página
            })
            .catch(error => {
                console.error('Erro ao buscar os cursos', error);
                this.error = 'Erro ao buscar os cursos';
            })
            .finally(() => {
                this.loading = false; // Finaliza o carregamento
            });
    },
    goToPage(page) {
        if (page > 0 && page <= this.lastPage) {
            this.fetchCursos(page); // Chama a função de busca para a nova página
        }
    }
}
}
</script>

<style src="./styleCardCurso.css" />