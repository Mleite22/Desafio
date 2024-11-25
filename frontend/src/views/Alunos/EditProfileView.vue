<template>
    <div>
        <DashboardComponent>
            <template v-slot:painel-perfil-alunos>
                <header class="titlle-pages">
                    <p>Perfil do Aluno</p>
                </header>
                <div class="message" v-if="message" :class="{ 'success': success, 'error': !success }">{{ message }}
                </div>
                <div class="contents-pages">
                    <div class="form-page">

                        <div class="title-form">
                            <h2>Editar Meu Perfil</h2>
                        </div>
                        <form @submit.prevent="handleUpdateUser">
                            <div class="user-field">
                                <label for="name">Nome:</label>
                                <input type="text" id="name" v-model="user.name" required />
                            </div>
                            <div class="user-field">
                                <label for="email">E-mail:</label>
                                <input type="email" id="email" v-model="user.email" required />
                            </div>
                            <div class="user-field">
                                <label for="password">Senha:</label>
                                <input type="password" id="password" v-model="user.password" />
                            </div>
                            <small>(Deixe a senha em branco caso não queira alterar)</small>
                            <div class="form-button">
                                <button class="botao" type="submit">Salvar</button>
                                <!-- <button class="botao" type="#">Habilitar 2FA</button> -->
                            </div>
                        </form>

                    </div>
                </div>
            </template>
        </DashboardComponent>
    </div>
</template>

<script>

import UserServices from '@/services/UserServices';
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';

export default {
    props: ['id'],
    name: 'editProfileView',
    components: {
        DashboardComponent,
    },
    data() {
        return {
            user: {
                name: null,
                email: null,
                password: null,
            },
            message: '',
            success: false,
        };
    },
    created() {
        this.loadUser();
    },
    methods: {
        /**
         * Função Busca dados
         */ 
        async loadUser() {
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
        },

        /**
         * Atualiza Edita os Dados do usuário
         */
        async handleUpdateUser() {
            try {
                const token = localStorage.getItem('api_token');

                if (!token) {
                    this.message = 'Token não encontrado.';                    
                    return;
                }
                const userData = {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password || undefined
                }
                this.message = await UserServices.updateUser(userData, token);
                this.success = true;
                setTimeout(() => {
                    this.success = false;
                    this.message = '';
                }, 4000);
                

            } catch (error) {
                this.message = 'Erro ao atualizar usuário.';
                this.success = false;
                
            }
        }

    },
}
</script>

<style src="./styleEditProfile.css" scoped />