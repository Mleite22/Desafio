<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-alunos>
        <header class="titlle-pages">
          <p>Alunos</p>
        </header>
        <div class="contents-pages">
          

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
