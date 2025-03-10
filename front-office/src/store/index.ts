import { createStore } from 'vuex'
import loginServico from '@/services/autenticacao/loginServico';
import resgistroService from "@/services/registro/resgistroService";

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
        initializeStore({ commit }) {
            const token = localStorage.getItem('token');
            const user = JSON.parse(localStorage.getItem('user') || 'null');
            
            if (token && user) {
                commit('setToken', token);
                commit('setUser', user);
            }
        },
        async login({ commit }, { email, password }) {
            const store = await loginServico.autenticUser(email, password);
            commit('setToken', store.token);
            commit('setUser', store.user);
            return store;
        },
        async registro({ commit }, { name, email, password }) {


            try {
                const response = await resgistroService.registerUser({ name, email, password });
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
        logout({ commit }) {
            commit('logout');
            localStorage.removeItem('token');
            localStorage.removeItem('user');

        },
    },
    getters: {
        isAuthenticated: (state) => state.isAuthenticated,
        getUser: (state) => state.user,
        getToken: (state) => state.token,
    }
})