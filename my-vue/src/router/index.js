import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Users from '@/components/UsersComponents'
import AddUser from '@/components/AddUserComponents'
import EditUser from '@/components/EditUserComponents'

Vue.use(Router)

export default new Router({
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
      path: '/Add-user',
      name: 'AddUser',
      component: AddUser
    },
    {
      path: '/Edit-user/:id',
      name: 'EditUser',
      component: EditUser
    }
  ]
})
