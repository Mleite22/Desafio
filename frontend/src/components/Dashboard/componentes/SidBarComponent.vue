<template>
    <div class="sidbar">
        <div class="avatar-top">
            <div class="avatar">
                <span><i class="fa fa-user" style="color: darkgray; font-size: 25px;"></i></span>
            </div>
            <div class="avatar-nome">
                <h4 class="wellcome">Bem Vindo!</h4>
                <p>{{ user?.name }}</p>
            </div>
        </div>
        <hr>
        <div class="menu">
            <ul>
                <a href="">
                    <li>Matricula</li>
                </a>
                <a href="">
                    <li>Cursos</li>
                </a>
                <a href="">
                    <li>Lista de curso</li>
                </a>
                <a href="">
                    <li>Alunos Matriculados</li>
                </a>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'SidBarComponent',
    data() {
        return {
            user: null
        };
    },
    methods: {
        getUser() {
            const userId = localStorage.getItem('user_id'); // Obtém o ID do usuário do localStorage
            if (userId) {
                axios.get(`http://127.0.0.1:8000/api/users/${userId}`, {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('api_token') // Usa o token do localStorage
                    }
                })
                    .then(response => {
                        this.user = response.data.user; // Ajuste conforme a estrutura da resposta da sua API
                    })
                    .catch(error => {
                        console.error("Erro ao buscar usuário:", error);
                    });
            } else {
                console.error("ID não está definido");
            }
        }
    },
    mounted() {
        this.getUser(); // Chama o método ao montar o componente
    }
}
</script>

<style src="./styleComponets.css" />