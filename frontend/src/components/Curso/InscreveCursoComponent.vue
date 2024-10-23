<template>
    <div class="list-curso">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modalidade</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="cursos.length === 0">
                    <td colspan="4">Nenhum curso disponível.</td>
                </tr>
                <tr v-for="curso in cursos" :key="curso.id">
                    <td>{{ curso.nome }}</td>
                    <td>{{ curso.modalidade }}</td>
                    <td>{{ curso.descricao }}</td>
                    <td>
                        <button class="botao" @click="inscreverCurso(curso.id)">Adquirir</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Anterior</button>
            <span>Página {{ currentPage }} de {{ lastPage }}</span>
            <button @click="goToPage(currentPage + 1)" :disabled="currentPage === lastPage">Próximo</button>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
export default {
    name: 'InscreveCursoComponent',
    data() {
        return {
            cursos: [],
            currentPage: 1,
            lastPage: 1,
        };
    },
    mounted() {
        this.fetchCursos(1);
        axios.get('http://127.0.0.1:8000/api/curso')
            .then(response => {
                this.cursos = response.data.curso;  
            })
            .catch(error => {
                console.error('Erro ao buscar os cursos', error);
            });
    },
    methods: {
        inscreverCurso(cursoId) {
            const token = localStorage.getItem('api_token');

            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };

            // Verificar se o usuário já está inscrito no curso
            axios.get(`http://127.0.0.1:8000/api/cursoaluno/${cursoId}`, config)
                .then(response => {
                    // Se a resposta contiver dados, o usuário já está inscrito
                    if (response.data.inscrito) {
                        alert('Você já está inscrito neste curso.'); // Mensagem de aviso
                    } else {
                        // Se não estiver inscrito, confirmar a inscrição
                        if (confirm("Você tem certeza que deseja se inscrever neste curso?")) {
                            axios.post('http://127.0.0.1:8000/api/cursoaluno', { curso_id: cursoId }, config)
                                .then(response => {
                                    alert(response.data.message); // Mensagem de sucesso
                                })
                                .catch(error => {
                                    console.error('Erro ao realizar inscrição', error.response?.data?.message || error.message);
                                    alert(error.response?.data?.message || 'Erro ao realizar a inscrição. Tente novamente.'); // Mensagem de erro
                                });
                        }
                    }
                })
                .catch(error => {
                    console.error('Erro ao verificar inscrição', error);
                    alert('Erro ao verificar inscrição. Tente novamente.'); // Mensagem de erro
                });
        },
        //Paginação
        fetchCursos(page = 1) {
            axios.get(`http://127.0.0.1:8000/api/curso?page=${page}`)
                .then(response => {
                    this.cursos = response.data.curso; // Cursos formatados
                    this.currentPage = response.data.pagination.current_page; // Página atual
                    this.lastPage = response.data.pagination.last_page; // Última página
                })
                .catch(error => {
                    console.error('Erro ao buscar os cursos', error);
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


<style scoped>



.list-curso {
    max-width: 950px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 25px;
    color: var(--font-color-2);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: var(--purple-color-2);
    color: white;
}

tr:hover {
    background-color: #f1f1f1;
}

.botao {
    background-color: #4CAF50;
    /* Verde */
    color: white;
    border: none;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.botao:hover {
    background-color: #3b8a3f;
    /* Verde mais escuro */
}

.pagination {
    margin-top: 20px;
    text-align: center;
    
    button {
        margin: 0 5px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
}

.pagination button:hover {
    background-color: #3b8a3f;
}

.pagination button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}
</style>