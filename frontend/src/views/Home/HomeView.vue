<template>
  <div>

    <DashboardComponent>
      <template v-slot:painel-home>
        
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
