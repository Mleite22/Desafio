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
                
                <RouterLink :to="{name: 'home'}" class="routers-link"><li><i class="fa-solid fa-house" style="margin-right: 5px;"></i>Início</li></RouterLink>
                <RouterLink :to="{name: 'curso'}" class="routers-link"><li><i class="fa-solid fa-code" style="margin-right: 5px;"></i>Cursos</li></RouterLink>
                <RouterLink :to="{name: 'inscrever_curso'}" class="routers-link"><li><i class="fa-solid fa-pen" style="margin-right: 5px;"></i>Inscreva-se</li></RouterLink>
                <RouterLink :to="{name: 'lista_cursos'}" class="routers-link"><li><i class="fa-solid fa-list" style="margin-right: 5px;"></i>Listar meus curso</li></RouterLink>
                <RouterLink :to="{ name: 'EditProfileView'}" class="routers-link"><li><i class="fa-solid fa-circle-user" style="margin-right: 5px;"></i>Editar Perfil</li></RouterLink>
                
            </ul>
        </div>
    </div>
</template>

<script>
import UserServices from '@/services/UserServices';

export default {
    name: 'SidBarComponent',
    data() {
        return {
            user: null
        };
    },
    methods: {
        /**
         * Função Busca dados
         */ 
        async getUser() {
            try {
                const userId = localStorage.getItem('user_id');
                const token = localStorage.getItem('api_token');

                if (userId && token){
                    this.user = await UserServices.fetchUser(userId, token);
                } else {
                    console.error("Usuário não encontrados.");
                }

            } catch (error) {
                this.message = 'Erro ao carregar o perfil do usuário.';
                
            }
        }
    },
    mounted() {
        this.getUser(); // Chama o método ao montar o componente
    }
}
</script>

<style src="./styleComponets.css" />