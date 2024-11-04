<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-home>
        <div class="contents-pages">
          <h2>Painel</h2>

        </div>
      </template>
    </DashboardComponent>
    
  </div>
</template>

<script>
import DashboardComponent from '@/components/Dashboard/DashboardComponent.vue';

export default {
  name: 'HomeView',
  components: {
    DashboardComponent,
  }
}
</script>
