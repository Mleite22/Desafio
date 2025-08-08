<script setup lang="ts">
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import router from '@/router';

const store = useStore();
const user = computed(() => store.getters.getUser);

// const logout = async () => {
//     try {
//         await store.dispatch('logout');
//         router.push('/');
//     } catch (error) {
//         console.log("Erro ao fazer o logout: ", error)
//     }

// }

// onMounted(() => {
//     console.log('Usuário Logado com sucesso!');
// });
</script>
<template>
    <div>
        
        <div v-if="user" class="user-info">
            <p>Olá! Bem vindo(a) {{ user.name }}</p>
            <!-- <router-link to="/" @click.prevent="logout">Sair</router-link> -->
        </div>
    </div>
</template>

<style scoped>
.user-info {
    width: 100%;
}


</style>