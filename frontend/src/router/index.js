import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home/HomeView.vue'
import LoginView from '../views/Login/LoginView.vue'

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginView
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    meta: { requiresAuth: true }  // Rota protegida
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue'),
    meta: { requiresAuth: true }  // Protegendo a rota About também
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// Guard global para verificar a autenticação
router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('api_token'); // Verifica se o token existe no localStorage

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

export default router;
