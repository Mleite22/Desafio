<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-inscrevercurso>
        <header class="titlle-pages">
          <p>Escolha seu curso</p>
        </header>
        <div class="contents-pages">
          <InscreveCursoComponent />
        </div>
      </template>
    </DashboardComponent>

  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';
import InscreveCursoComponent from '../../components/Curso/InscreveCursoComponent.vue';


export default {
  name: 'InscreverCursoView',
  components: {
    DashboardComponent,
    InscreveCursoComponent
  }
}
</script>

<style src="./styleCurso.css" />
