<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-curso>
        <div class="contents-pages">
          <h2>Painél de Cuso</h2>

        </div>
      </template>
    </DashboardComponent>
    
  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';

export default {
  name: 'CursoView',
  components: {
    DashboardComponent,
  }
}
</script>
