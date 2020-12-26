/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import Swal from 'sweetalert2'
window.Swal=Swal;

const Success = Swal.mixin({
    success: true,
    position: 'center',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Success=Success;
    import { Form, HasError, AlertError } from 'vform'
    window.Form = Form;
    Vue.component(HasError.name, HasError)
    Vue.component(AlertError.name, AlertError)
// Vue.component('example-component', requpaginationire('./components/ExampleComponent.vue').default);
Vue.component('users-component', require('./components/Users.vue').default);
Vue.component('drivers-component', require('./components/Drivers.vue').default);
//products cluster vues component
Vue.component('type-component', require('./components/products/Types.vue').default);
Vue.component('orders-component', require('./components/products/Orders.vue').default);
Vue.component('origin-component', require('./components/products/Origin.vue').default);
Vue.component('meate-shape', require('./components/products/MwateShpe.vue').default);
Vue.component('meate-aera', require('./components/products/MeateAera.vue').default);
Vue.component('meat-component', require('./components/products/Meats.vue').default);
Vue.component('stock-component', require('./components/products/Stock.vue').default);
Vue.component('store-component', require('./components/products/Store.vue').default);
Vue.component('stock-opration', require('./components/products/StockOpration.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
//Discount component
Vue.component('discount-component', require('./components/discount/Discount.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
