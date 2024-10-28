<template>
    <div>
        <DashboardComponent>
            <template v-slot:painel-perfil-alunos>
                <header class="titlle-pages">
                    <p>Perfil do Aluno</p>
                </header>
                <div class="message" v-if="message" :class="{ 'success': success, 'error': !success }">{{ message }}</div>
                <div class="contents-pages">
                    <div class="form-page">

                        <div class="title-form">
                            <h2>Editar Meu Perfil</h2>
                        </div>
                        <form @submit.prevent="updateUser">
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
                            <button class="botao" type="submit">Salvar</button>
                        </form>
                        
                    </div>
                </div>
            </template>
        </DashboardComponent>
    </div>
</template>

<script>
import axios from 'axios';
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
                name: '',
                email: '',
                password: '',
            },
            message: '',
            success: false,
        };
    },
    created() {
        this.fetchUser();
    },
    methods: {
        async fetchUser() {
            try { 
                //Função recupera dados
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

            } catch (error) {
                console.error(error);
                this.message = 'Erro ao buscar o usuário.'
            }
        },
        async updateUser() {
            try {
                //Função Edita Dados
                const token = localStorage.getItem('api_token');
                if (!token) {
                    this.message = "Token de autenticação não encontrado.";
                    return;
                }

                const userData = {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password ? this.user.password : undefined, // Só envia a senha se preenchida
                };

                const response = await axios.patch('http://127.0.0.1:8000/api/users/profile', userData, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.message = response.data.message;
                this.success = true;
                //temporizador para limpar as mensagens
                setTimeout(() => {
                    this.success = false;
                    this.message = '';
                }, 4000);
            } catch (error) {
                console.error('Erro ao atualizar usuário: ', error);
                this.message = 'Erro ao atualizar usuário.';
                this.success = false;
                
                //temporizador para limpar as mensagens
                setTimeout(() => {
                    this.success = false;
                    this.message = '';
                }, 4000);
            }
        }


    },
}
</script>

<style src="./styleEditProfile.css" scoped/>