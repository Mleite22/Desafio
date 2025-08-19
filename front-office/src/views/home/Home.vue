<script setup lang="ts">
import Painel from '../layout/painel/Painel.vue'; 
import { useStore } from 'vuex';
import { computed } from 'vue';
import { onMounted, ref } from 'vue';

const store = useStore();

const cursos = ref([]);

const user = computed(() => store.getters.getUser);
const loading = ref(false);
const error = ref(null);

onMounted(async () => {
  if (user.value && user.value.id) {
    loading.value = true;
    error.value = null;
    try {
      const response = await store.dispatch('getCursoAluno');
      cursos.value = response.cursoAlunos || [];
      console.log('Cursos recebidos:', cursos.value);
    } catch (err) {
      error.value = 'Erro ao obter cursos do aluno';
      console.error('Erro ao obter cursos do aluno:', err);
    } finally {
      loading.value = false;
    }
  }
});


</script>

<template>
  <div v-if="user">
    
    <Painel>
      <template v-slot:painel-home>
        <h1>Meus Cursos</h1>
        <div class="card-principal">
          <div v-if="loading">Carregando cursos...</div>
          <div v-if="error">{{ error }}</div>

          <div v-if="!loading && !error && cursos.length === 0">
            <h3 class="mensagem">Você ainda não se matriculou em um curso</h3>
          </div>

          <div class="card" v-for="curso in cursos" :key="curso.id">
            <!-- Foto generica -->
            <div class="imagens-curso">
              <img src="../../assets/images/banner.jpg" alt="" srcset="">
            </div>

            <div class="titulo-card">
              <h2>{{ curso.curso.nome }}</h2>
            </div>
            <div class="descricao">
              <p>{{ curso.curso.descricao }}</p>
            </div>
          </div>
        </div>
      </template>
    </Painel>

  </div>

</template>

<style scoped>
.logout-link {
  color: hsla(160, 100%, 37%, 1);
  text-decoration: none;
  font-size: 1rem;

  .logout-link:hover {
    text-decoration: underline;
    /* Added hover effect for logout link */
  }
}
.card-principal {
  width: 100%;
  flex-wrap: wrap;
  margin-left: 20px;
  margin-top: 10px;
  gap: 16px;
  display: flex;
  justify-content: left;
  
}
.card {
  flex: 1 1 280px;
  max-width: 280px; /* Define uma largura máxima para os cards */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
  padding: 5px;
  background-color: var(--vt-c-indigo);
  transition: transform 0.2s ease;

  .imagens-curso {

    img {
      width: 100%;
      height: auto;
    }

  }
}

.mensagem {
  width: auto;
  padding: 25px;
  border-radius: 5px;
  color: var(--vt-c-red);
  font-weight: bold;
  background-color: var(--vt-c-indigo);
}
</style>