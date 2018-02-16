import Vue from 'vue'
import Router from 'vue-router'
import predictions from '@/components/predictions'
import livescore from '@/components/livescore'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: predictions
    },{
      path: '/livescore',
      name: 'livescore',
      component: livescore
    }
  ]
})
