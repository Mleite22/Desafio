import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    users: [],
    cursos: []
  },
  mutations: {
    SET_users(state, users) {
      state.users = users;
    },
    SET_CURSOS(state, cursos) {
      state.cursos = cursos;
    }
  },
  actions: {
    fetchUsers({ commit }) {
      axios.get('http://localhost:8000/api/users')
        .then(response => {
          commit('SET_users', response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchCursos({ commit }) {
      axios.get('http://localhost:8000/api/cursos')
        .then(response => {
          commit('SET_CURSOS', response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
    cadastrarAluno({ dispatch }, aluno) {
      axios.post('http://localhost:8000/api/users', aluno)
        .then(() => {
          dispatch('fetchUsers');
        })
        .catch(error => {
          console.error(error);
        });
    },
    cadastrarCurso({ dispatch }, curso) {
      axios.post('http://localhost:8000/api/cursos', curso)
        .then(() => {
          dispatch('fetchCursos');
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  getters: {
    users: state => state.users,
    cursos: state => state.cursos
  }
});
