<script setup lang="ts">
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import router from '@/router';

const store = useStore();
const user = computed(() => store.getters.getUser);

const logout = async () => {
    try {
        await store.dispatch('logout');
        router.push('/');
    } catch (error) {
        console.log("Erro ao fazer o logout: ", error)
    }

}

onMounted(() => {
    console.log('Usuário Logado com sucesso!');
    // console.log('Dados do usuário:', user.value);
});
</script>
<template>
    <div>
        <div>
        </div>
        <div v-if="user" class="user-info">
            <h2>Dashboard</h2>
            <p>Bem-vindo!</p>
            <p>Nome: {{ user.name }}</p>
            <p>Email: {{ user.email }}</p>
            <p>ID: {{ user.id }}</p>
            <router-link to="/" @click.prevent="logout" class="logout-link">Sair</router-link>
        </div>
    </div>
</template>

<style scoped>
.user-info {
    width: 100%;
    height: 100vh;
    background-color: #181818;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.user-info {
    margin: 0;
    font-size: 24px;
}
.user-info p {
    margin: 5px 0;
    font-size: 1rem;
}
.logout-link {
    color: hsla(160, 100%, 37%, 1);
    text-decoration: none;
    font-size: 1rem;
    
    .logout-link:hover {
        text-decoration: underline; /* Added hover effect for logout link */
    }
}
</style>