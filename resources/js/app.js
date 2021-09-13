
require('./bootstrap');
window.Vue = require('vue').default;
import routes from './router/route';
import store from './store/index';
import filter from './components/filter'
import moment from 'moment';


Vue.component('pagination', require('laravel-vue-pagination'));
// Pages Componenta
Vue.component('admin-home', require('./pages/admin/index.vue').default);
Vue.component('webite-header', require('././pages/website/layouts/header.vue').default);
Vue.component('footer-form', require('././pages/website/layouts/contactform.vue').default);

// Public Blog
Vue.component('public-blog', require('./pages/website/blogs/blogs.vue').default);

//User Blog Component

// Post Componenta
Vue.component('user-post-index', require('./post/userpost/index.vue').default);
Vue.component('user-post-create', require('./post/userpost/create.vue').default);


//Blog Comment
Vue.component('post-comment', require('./components/comment/comment.vue').default);

Vue.component('post-comment-show', require('./components/comment/showcomment.vue').default);

Vue.component('preloader', require('./components/preloader.vue').default);



//Vue Filter to make first letter Capital
Vue.filter("strToUpper", function(text) {
	return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('currency', value=> {
    return '$' + parseFloat(value).toFixed(2);
});

Vue.filter('trim', value=> {
    if (!value) return ''
    return value.substring(0, 40) + '...'
});

Vue.filter('trimpost', value=> {
    if (!value) return ''
    return value.substring(0, 30) + '...'
});


Vue.filter('dateformat', value=> {
    if (!value) return ''
    return moment(String(value)).format('DD/MM/YYYY')
});


//Nagivation Gard Authentication
function isLoggedIn() {
    return store.getters.getAuthenticated;
}

routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: 'singing',
            })
        } else {
            next() // make sure to always call next()!
        }
    }else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: 'user-dashboard',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
});


const app = new Vue({
    el: '#app',
    router : routes,
    filter,
    store,
});
