<template>
    <div>
      <h2>Matrícula de Aluno</h2>
      <form @submit.prevent="matricularAluno">
        <label>Aluno:</label>
        <select v-model="matricula.aluno_id">
          <option v-for="aluno in alunos" :key="aluno.id" :value="aluno.id">{{ aluno.nome }}</option>
        </select>
        
        <label>Curso:</label>
        <select v-model="matricula.curso_id">
          <option v-for="curso in curso" :key="curso.id" :value="curso.id">{{ curso.nome }}</option>
        </select>
        
        <button type="submit">Matricular</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        matricula: {
          user_id: '',
          curso_id: ''
        },
        user: [],
        curso: []
      };
    },
    created() {
      this.buscarAlunos();
      this.buscarCursos();
    },
    methods: {
      buscarAlunos() {
        axios.get('http://localhost:8000/api/cursoaluno')
          .then(response => {
            this.alunos = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      buscarCursos() {
        axios.get('http://localhost:8000/api/cursos')
          .then(response => {
            this.cursos = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      matricularAluno() {
        axios.post('http://localhost:8000/api/cursoaluno', this.matricula)
          .then(() => {
            alert('Aluno matriculado com sucesso!');
            this.matricula.aluno_id = '';
            this.matricula.curso_id = '';
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  };
  </script>
  