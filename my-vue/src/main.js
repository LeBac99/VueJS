// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueConfirmDialog from 'vue-confirm-dialog'
Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)
Vue.use(VueAxios, axios)
Vue.config.productionTip = false
var $url= String
Vue.prototype.$apiURI = 'http://localhost/api/user/'
/* eslint-disable no-new */
class Errors {
  constructor() {
      this.errors = {};
  }

  has(field) {
      return this.errors.hasOwnProperty(field);
  }

  get(field) {
      if(this.errors[field]) {
          return this.errors[field][0];
      }
  }

  record(errors) {
      this.errors = errors;
  }

}
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
