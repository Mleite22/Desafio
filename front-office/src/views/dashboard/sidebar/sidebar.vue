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
            <h2>DB Cursos</h2>
            <p>{{ user.name }}</p>
            <div class="menu-lateral">
                <router-link to="/home" class="menu-item"><p>Home</p></router-link>
                <router-link to="/perfil" class="menu-item"><p>Meu Perfil</p></router-link>
            </div>
            <router-link to="/" @click.prevent="logout" class="logout-link">Sair</router-link>
        </div>
    </div>
</template>

<style scoped>
.user-info {
    width: 100%;
    height: 100vh;
    margin: 0;
    font-size: 24px;
    background-color: var(--vt-c-black);
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.user-info p {
    margin: 5px 0;
    font-size: 1rem;
}

.logout-link {
    color: hsla(160, 100%, 37%, 1);
    font-size: 1rem;
    padding: 0 10px;
}
.menu-lateral {
    margin-top: 15px;
    display: flex;
    flex-direction: column;
    .menu-item {
        display: block;
        color: #fff;        
        padding: 5px 10px;

        &:hover {
            background-color: var(--vt-c-black-soft);
            border-radius: 5px;
        }
    }
}
</style>