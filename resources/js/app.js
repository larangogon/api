import Vue from 'vue'
import './bootstrap'
import FormComponent from "./ components/FormComponent";
import ShowOrderComponent from "./ components/ShowOrderComponent";

window.Vue = Vue

Vue.component('form-component', FormComponent)
Vue.component('show-order-component', ShowOrderComponent)

new Vue({
    el: '#app'
})
