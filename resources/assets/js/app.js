
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import VeeValidate from 'vee-validate';
import tinymce from 'vue-tinymce-editor';
import VAnimateCss from 'v-animate-css';
import Notifications from 'vue-notification'
import velocity      from 'velocity-animate'
import VModal from 'vue-js-modal'
import { Modal } from 'bootstrap-vue/es/components';
import { Button } from 'bootstrap-vue/es/components';
import VueCharts from 'vue-charts';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VeeValidate)
Vue.use(VAnimateCss)
Vue.use(Notifications, {velocity})
Vue.use(VModal)
Vue.use(Modal)
Vue.use(Button)
Vue.use(VueCharts)

Vue.component('tour-all', require('./components/TourAll.vue'));
Vue.component('tour-add', require('./components/TourAdd.vue'));
Vue.component('tour-show', require('./components/TourShow.vue'));
Vue.component('tour-photo', require('./components/TourPhoto.vue'));
Vue.component('tour-packages', require('./components/frontend/TourPackages.vue'));
Vue.component('tour-package-show', require('./components/frontend/TourPackageShow.vue'));

Vue.component('post-all', require('./components/PostAll.vue'));
Vue.component('post-add', require('./components/PostAdd.vue'));
Vue.component('post-show', require('./components/PostShow.vue'));

Vue.component('auth-login', require('./components/AuthLogin.vue'));

Vue.component('account-profile', require('./components/AccountProfile.vue'));
Vue.component('account-credentials', require('./components/AccountCredentials.vue'));

Vue.component('site-contents', require('./components/SiteContents.vue'));

Vue.component('report', require('./components/Report.vue'));

Vue.component('tinymce', tinymce);
const app = new Vue({
    el: '#app',
});
