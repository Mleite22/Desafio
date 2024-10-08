import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    alunos: [],
    cursos: []
  },
  mutations: {
    SET_ALUNOS(state, alunos) {
      state.alunos = alunos;
    },
    SET_CURSOS(state, cursos) {
      state.cursos = cursos;
    }
  },
  actions: {
    fetchAlunos({ commit }) {
      axios.get('http://localhost:8000/api/users')
        .then(response => {
          commit('SET_ALUNOS', response.data);
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
          dispatch('fetchAlunos');
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
    alunos: state => state.alunos,
    cursos: state => state.cursos
  }
});
