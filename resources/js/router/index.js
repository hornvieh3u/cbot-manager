import { setupLayouts } from 'virtual:generated-layouts'
import { createRouter, createWebHistory } from 'vue-router'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from './utils'
import routes from '~pages'
import { canNavigate } from '@layouts/plugins/casl'
import { nextTick } from 'vue'

const DEFAULT_TITLE = 'C-BOT';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // ℹ️ We are redirecting to different pages based on role.
    // NOTE: Role is just for UI purposes. ACL is based on abilities.
    {
      path: '/',
      redirect: to => {
        const userData = JSON.parse(localStorage.getItem('userData'))
        if( userData ) {
          return getHomeRouteForLoggedInUser(userData.is_admin)
        }

        return { name: 'login', query: to.query }
      },
    },
    {
      path: '/pages/user-profile',
      redirect: () => ({ name: 'pages-user-profile-tab', params: { tab: 'profile' } }),
    },
    {
      path: '/pages/account-settings',
      redirect: () => ({ name: 'pages-account-settings-tab', params: { tab: 'account' } }),
    },
    ...setupLayouts(routes),
  ],
})

// Docs: https://router.vuejs.org/guide/advanced/navigation-guards.html#global-before-guards
router.beforeEach((to, from, next) => {
  const isLoggedIn = isUserLoggedIn()
  if (!canNavigate(to)) {
    // Redirect to login if not logged in
    if (!isLoggedIn) return next({ name: 'login' })

    // If logged in => not authorized
    return next({ name: 'not-authorized' })
  }

  // Redirect if logged in
  if (to.meta.redirectIfLoggedIn && isLoggedIn) {
    const userData = getUserData()
    return next(getHomeRouteForLoggedInUser(userData ? userData.is_admin : null))
  }

  return next()
})
router.afterEach(to => {
  nextTick(() => document.title = `${DEFAULT_TITLE} - ${to.name.replace('-', ' ').toUpperCase()}`)
})
export default router
