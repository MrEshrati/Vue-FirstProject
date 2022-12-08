import { route } from 'quasar/wrappers';
import { useAuthStore } from 'src/stores/auth-store';
import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('src/layouts/login/loginLayout.vue'),
    beforeEnter(to,from,next){
      const auth = useAuthStore();
      auth.import();
      if (!auth.isAuthorized) {
        next();
      } else {

        next({name: 'dashboard'})
      }
    },
    redirect: <any> route(<any> {name: 'login'}),
    children: [{ path: '/login', name: 'login', component: () => import('pages/login/loginPage.vue') }],
  },
  {
    path: '/dashboard',
    component: () => import('src/layouts/dashboard/dashboardLayout.vue'),
    
    beforeEnter(to,from,next){
      const auth = useAuthStore();
      auth.import();
      if (auth.isAuthorized) {
        next();
      } else {

        next({name: 'login'})
      }
    },
    children: [
      { 
        path: 'dashboard', 
        name: 'dashboard', 
        component: () => import('pages/dashboard/dashboardPage.vue'), 
      },
      { 
        path: 'myPosts', 
        name: 'myPosts', 
        component: () => import('pages/dashboard/myPostsPage.vue'), 
      },
      { 
        path: 'allPosts', 
        name: 'allPosts', 
        component: () => import('src/pages/dashboard/allPostsPage.vue'), 
      },
      { 
        path: 'allUsers', 
        name: 'allUsers', 
        component: () => import('pages/dashboard/allUsersPage.vue'), 
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
