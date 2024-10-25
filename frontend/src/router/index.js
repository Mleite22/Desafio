import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home/HomeView.vue'
import LoginView from '../views/Login/LoginView.vue'
import CursoView from '@/views/Curso/CursoView.vue'
import AlunosView from '@/views/Alunos/AlunosView.vue'
import MeusCursoView from '@/views/Meus Cursos/MeusCursoView.vue'
import InscreverCursoView from '@/views/Curso/InscreverCursoView.vue'
import EditProfileView from '@/views/Alunos/EditProfileView.vue'


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
    path: '/curso',
    name: 'curso',
    component: CursoView,
    meta: { requiresAuth: true }  // Rota protegida
  },
  {
    path: '/curso/inscrever_curso',
    name: 'inscrever_curso',
    component: InscreverCursoView,
    meta: { requiresAuth: true }  // Rota protegida
  },
  {
    path: '/alunos',
    name: 'alunos',
    component: AlunosView,
    meta: { requiresAuth: true }  // Rota protegida
  },
  {
    path: '/edit-profile',
    name: 'EditProfileView',
    component: EditProfileView, 
    //props: true,
    meta: { requiresAuth: true }  // Rota protegida
  },
  {
    path: '/lista_cursos',
    name: 'lista_cursos',
    component: MeusCursoView,
    meta: { requiresAuth: true }  // Rota protegida
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
