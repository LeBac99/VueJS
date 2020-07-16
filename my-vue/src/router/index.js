import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Users from '@/components/UsersComponents'
import AddUser from '@/components/AddUserComponents'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    // {
    //   path: '/',
    //   name: 'HelloWorld',
    //   component: HelloWorld
    // },
    {
      path: '/',
      name: 'Users',
      component: Users
    },
    {
      path: '/Add-user/:id',
      name: 'AddUser',
      component: AddUser
    },
  ]
})
