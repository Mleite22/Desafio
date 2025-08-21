<script setup lang="ts">
import Painel from '../layout/painel/Painel.vue';
import { useStore } from 'vuex';
import { computed, ref } from 'vue';

const store = useStore();
const user = computed(() => store.getters.getUser);
const message = ref('');
const success = ref(false);

const updateProfile = async () => {
  try {
    await store.dispatch('editarPerfil', user.value);
    message.value = 'Perfil atualizado com sucesso!';
    success.value = true;

    // Limpa a mensagem apés 5 segundos
    setTimeout(() => {
      message.value = '';
      success.value = false;
    }, 5000);
  } catch (error) {
    console.error('Erro ao atualizar perfil:', error);
    message.value = 'Erro ao atualizar perfil.';
    success.value = false;
  }
};

</script>

<template>
  <Painel>
    <template v-slot:painel-meu-perfil>
      <h1>Meu Perfil</h1>
      <!-- Edita o perfil do aluno -->
      <div class="mensagem-sucesso" v-if="message" :class="{ 'success': success, 'error': !success }">{{ message }}
      </div>
      <form @submit.prevent="updateProfile">
        <div>
          <label for="name">Nome:</label>
          <input type="text" id="name" v-model="user.name" />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="user.email" />
        </div>
        <div class="user-field">
          <label for="password">Senha:</label>
          <input type="password" id="password" v-model="user.password" />
        </div>
        <small>(Deixe a senha em branco caso não queira alterar)</small>
        <button type="submit">Salvar</button>
      </form>

    </template>
  </Painel>
</template>

<style lang="css" scoped>
form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 20px;
  /* background-color: aquamarine; */
}

div {
  margin-bottom: 12px;
}

label {
  margin-bottom: 4px;
  padding: 4px 5px;
  /* background-color: antiquewhite; */
}

input {
  width: 80%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 10px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #218838;
}

</style>