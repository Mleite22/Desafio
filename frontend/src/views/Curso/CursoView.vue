<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-curso>
        <header class="titlle-pages">
          <p>Cursos Disponíveis</p>
        </header>
        <div class="contents-pages">


          <CursoCardsComponent />

        </div>
      </template>
    </DashboardComponent>

  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';
import CursoCardsComponent from '../../components/Cuso Cards/CursoCardsComponent.vue';

export default {
  name: 'CursoView',
  components: {
    DashboardComponent,
    CursoCardsComponent
  }
}
</script>

<style src="./styleCurso.css" />
