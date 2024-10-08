import { createRouter } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import AlunoView from '../views/AlunoView.vue'
import CursoView from '../views/CursoView.vue'

const routes = [
  {
    path: '/',
    name: 'login-User',
    component: LoginView
  },
  {
    path: '/aluno',
    name: 'aluno',
    component: AlunoView
  },
  {
    path: '/cadastro-curso',
    name: 'cadastro-curso',
    component: CursoView
  }
]

const router = createRouter({
  history: true,
  routes
})

export default router