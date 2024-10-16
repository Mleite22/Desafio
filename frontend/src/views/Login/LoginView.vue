<template>
  <div class="container">
    <LoginUser  />
    <RegisterUser />
  </div>


</template>

<script>
import LoginUser from '@/components/LoginUser/LoginUser.vue';
import RegisterUser from '@/components/LoginUser/RegisterUser.vue';

export default {
  components: {
    LoginUser, 
    RegisterUser
  },
}
</script>

<!-- <style src="./styleLogin.css" scoped /> -->
<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #e0dada;;
  }
</style>