<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-meuscurso>
        <div class="contents-pages">
          <h2>Painél Meus Curso</h2>

        </div>
      </template>
    </DashboardComponent>

  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';

export default {
  name: 'MeusCursoView',
  components: {
    DashboardComponent,
  }
}
</script>
