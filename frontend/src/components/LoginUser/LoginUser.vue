<template>
    <div class="primeira">
        <form class="form" @submit.prevent="logarAluno">
            <h1>Logar</h1>
            <label>
                <span>Seu e-mail</span>
                <input class="input" type="email" v-model="email" name="email" placeholder="email@email.com.br"
                    aria-label="Digite seu e-mail">
            </label>
            <label>
                <span>Senha</span>
                <input class="input" type="password" v-model="password" name="password" placeholder="*********"
                    aria-label="Digite sua senha">
            </label>
            <button type="submit">Entrar
                {{ isLoading ? 'Entrando...' : 'Entrar' }}
            </button>

            <div v-if="error" class="error">
                <p>{{ error }}</p>
            </div>
        </form>
    </div>
</template>

<script>
import Api from '@/http/Api';

export default {
    name: 'LoginUser',
    data() {
        return {
            email: '',
            password: '',
            isLoading: false,
            error: null
        };
    },

    methods: {
        async logarAluno() {

            if (!this.email || !this.password) {
                this.error = 'Preencha todos os campos';
                this.isLoading = false;
                return;
            }

            this.isLoading = true;
            this.error = null;

            try {
                const { data } = await Api().post('/login', { email: this.email, password: this.password })
                const { token, userId } = data;

                // Salva o token e o ID do usuário no localStorage
                localStorage.setItem('api_token', token);
                localStorage.setItem('user_id', userId); // Salva o ID do usuário

                // Redireciona para a página inicial
                this.$router.push({ name: 'home' });
            }
            catch (error) {
                const status = error.response?.status;
                if (status === 401) {
                    this.error = 'Credenciais inválidas';
                } else if (status === 500) {
                    this.error = 'Erro de credencial. Tente novamente mais tarde';
                    console.error(error);
                } else {
                    this.error = 'Erro desconhecido';
                }
                this.email = '';   // Opcional: limpar o e-mail
                this.password = '';
            }
            finally {
                this.isLoading = false;
            }
        }
    }

}
</script>

<style src="./styleLogin.css" scoped />
