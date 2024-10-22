<template>
    <div class="sidbar">
        <div class="avatar-top">
            <div class="avatar">
                <span><i class="fa fa-user" style="color: darkgray; font-size: 25px;"></i></span>
            </div>
            <div class="avatar-nome">
                <h4 class="wellcome">Bem Vindo!</h4>
                <p class="name-user" >{{ user?.name }}</p>
            </div>
        </div>
        <hr>
        <div class="menu">
            <ul>
                
                <li><RouterLink :to="{name: 'home'}" class="routers-link"><i class="fa-solid fa-house" style="margin-right: 5px;"></i>Início</RouterLink></li>
                <li><RouterLink :to="{name: 'curso'}" class="routers-link"><i class="fa-solid fa-code" style="margin-right: 5px;"></i>Cursos</RouterLink></li>
                <li><RouterLink :to="{name: 'alunos'}" class="routers-link"><i class="fa-solid fa-circle-user" style="margin-right: 5px;"></i>Alunos</RouterLink></li>
                <li><RouterLink :to="{name: 'lista_cursos'}" class="routers-link"><i class="fa-solid fa-list" style="margin-right: 5px;"></i>Listar meus curso</RouterLink></li>            
                <!-- <li><RouterLink to="/home" class="routers-link">Listar Matriculados</RouterLink></li> -->
                
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
                        this.user = response.data.user; // resposta da sua API
                    })
                    .catch(error => {
                        console.error("Erro ao buscar usuário:", error);
                    });
            } else {
                console.error("Usuário não está definido");
            }
        }
    },
    mounted() {
        this.getUser(); // Chama o método ao montar o componente
    }
}
</script>

<style src="./styleComponets.css" />