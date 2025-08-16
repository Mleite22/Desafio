import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/autenticacao/login/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/registro',
      name: 'registro',
      component: () => import('@/views/autenticacao/registro/RegistroView.vue'),
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('@/views/home/Home.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/ResetSenha',
      name: 'ResetSenha',
      component: () => import('@/views/autenticacao/reset_Senha/ResetSenha.vue'),
    },
    {
      path: '/ValidaCodigo',
      name: 'ValidaCodigoEmail',
      component: () => import('@/views/autenticacao/reset_Senha/ValidaCodigoEmail.vue'),
    },
    {
      path: '/NovaSenha',
      name: 'NovaSenha',
      component: () => import('@/views/autenticacao/reset_Senha/NovaSenha.vue'),
    },
    // {
    //   path: '/painel',
    //   name: 'Painel',
    //   component: () => import('@/views/dashboard/painel/Painel.vue'),
    //   meta: { requiresAuth: true },
    // }
  ],
})

// Guarda global para verificar a autenticação
router.beforeEach((to, from, next) => {
  // Verifica se o token existe no localStorage
  const isLoggedIn = localStorage.getItem('token');
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Se a rota exigir autenticação e o usuário não estiver logado
    if (!isLoggedIn) {
      next({ name: 'login' });  // Redirecionar para o login
    } else {
      next(); // Se estiver logado, seguir para a rota
    }
  } else {
    next(); // Se a rota não exigir autenticação, seguir normalmente
  }
});

export default router