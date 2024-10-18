<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-alunos>
        <div class="contents-pages">
          <h2>Painél do Aluno</h2>

        </div>
      </template>
    </DashboardComponent>
    
  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';

export default {
  name: 'AlunosView',
  components: {
    DashboardComponent,
  }
}
</script>
