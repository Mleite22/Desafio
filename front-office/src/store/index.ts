import { createStore } from 'vuex'
import loginServico from '@/services/autenticacao/loginServico';
import resgistroService from "@/services/registro/resgistroService";
import recuperarSenhaService from '@/services/resetSenha/recuperarSenhaService';
import cursoAluno from '@/services/cursoAluno/cursoAluno';


interface UserState {
    user: {
        id: number;
        name: string;
        email: string;
        password: string;
    } | null;
    token: string | null;
    isAuthenticated: boolean;
}

export default createStore<UserState>({
    state: {
        user: null,
        token: null,
        isAuthenticated: false,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            state.isAuthenticated = true;
        },
        setToken(state, token) {
            state.token = token;
            state.isAuthenticated = true;
        },
        logout(state) {
            state.user = null;
            state.token = null;
            state.isAuthenticated = false;
        },
    },
    actions: {
        // Inicializar o store
        initializeStore({ commit }) {
            const token = localStorage.getItem('token');
            const user = JSON.parse(localStorage.getItem('user') || 'null');
            
            if (token && user) {
                commit('setToken', token);
                commit('setUser', user);
            }
        },
        // Login do usuário
        async login({ commit }, { email, password }) {
            const store = await loginServico.autenticUser(email, password);
            commit('setToken', store.token);
            commit('setUser', store.user);
            return store;
        },
        // Registro novo usuário
        async registro({ commit }, { name, email, password }) {

            try {
                const response = await resgistroService.registerUser( name, email, password );
                const {token, user} = response;
                commit('setToken', token);
                commit('setUser', user);
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user));
                return response;
            } catch (error) {
                console.error('Erro ao registrar usuário:', error);
                throw error;
            }
        },
        // Logout Sair do sistema
        async logout({ commit }) {
            await loginServico.logout();
            commit('logout');
            localStorage.removeItem('token');
            localStorage.removeItem('user');

        },
        // Recuperar senha
        async recuperSenha({ commit }, { email }) {
            try {
                const response = await recuperarSenhaService.recuperarSenha(email);
                console.log('Resposta do serviço de recuperação de senha:', response);
                return response;
            } catch (error) {
                console.log('Erro ao recuperar senha:', error);
                throw error;
            }
        },
        // Validar código enviado pro email
        async validarCodigo({ commit }, { email, codigo }) {
            try {
                const response = await recuperarSenhaService.validarCodigo(email, codigo);
                console.log('Validado com sucesso!', response);
                return response;
            } catch (error) {
                console.log('Erro ao validar código:', error);
                throw error;
            }
            
        },
        // Atualizar senha
        async atualizarSenha({ commit }, { email, codigo, password }) {
            try {
                const response = await recuperarSenhaService.atualizarSenha(email, codigo, password); // Use "password" aqui
                commit('setToken', response.token);
                commit('setUser', response.user);
                console.log('Senha atualizada com sucesso!', response);
                return response;
            } catch (error) {
                console.log('Erro ao atualizar senha:', error);
                throw error;
            }
        },
        // Lista de cursos do aluno
        async getCursoAluno({  }) {
            try {
                const response = await cursoAluno.getCursoAluno();
                // Não precisa de commit de token/user aqui
                return response;
            } catch (error) {
                console.error('Erro ao obter curso do aluno:', error);
                throw error;
            }
        },
    },
    getters: {
        isAuthenticated: (state) => state.isAuthenticated,
        getUser: (state) => state.user,
        getToken: (state) => state.token,
    }
})