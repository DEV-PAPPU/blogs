import Vue from 'vue';
import VueRouter from 'vue-router';

import Admin from './admin';

import Category_single from '../public/post/single_category.vue'

// User Blog CRUD
import User_Post_Lists from '../post/userpost/index.vue'
import User_Post_Edit from '../post/userpost/edit.vue'


//Public Post
import Public_Posts from '../public/post/posts.vue'
import Single_Post from '../public/post/single.vue'

// website
Vue.use(VueRouter)
import website_home from '../public/pages/home.vue'

// Auth Component
import Login from '../pages/auth/login.vue'
import Register from '../pages/auth/register.vue'
import Password_Reset_Email_Sent from '../pages/auth/email.vue'
import Reset_Password from '../pages/auth/passwordchange.vue'

//Pos- Components
import Create_Product from '../pages/pos/product/create.vue'
import Product_List from '../pages/pos/product/index.vue'
import Product_Edit from '../pages/pos/product/edit.vue'
import Product_Sale from '../pages/pos/includes/posale.vue'
import Pos_Sale_Data from '../pages/pos/includes/sale_items.vue'
import Pos_Single_Sale from '../pages/pos/includes/pos_single_sale.vue'




const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        ...Admin,
        {
            path: '/',
            component: website_home,
            name: 'home',
        },
           //singup
        {
            path: '/user/sign-up',
            component: Register,
            name: 'user-sign-up',
        },
           //login
        {
            path: '/user/singing',
            component: Login,
            name: 'singing',
            meta:{
				requiresVisitor:true,
			}

        },
        {
            path: '/email/sent',
            component: Password_Reset_Email_Sent,
            name: 'email-sent',
        },
        {
            path: '/user/password/reset',
            component: Reset_Password,
            name: 'reset-password',
        },
           //User Blog Route
        {
            path: '/user/dashboard',
            component: User_Post_Lists,
            name: 'user-dashboard',
            meta:{
				requiresAuth:true,
			}
        },
        {
            path: '/user/dashboard/post/edit/:id',
            component: User_Post_Edit,
            name: 'user-post-edit',
        },

           //Pos Route
           {
            path: '/admin/product/create',
            component:  Create_Product,
            name: 'product-create',
        },
           {
            path: '/admin/products',
            component: Product_List,
            name: 'product-list',
        },
           {
            path: '/admin/product/edit/:id',
            component:  Product_Edit,
            name: 'product-edit',
        },
           {
            path: '/admin/product/sale',
            component:  Product_Sale,
            name: 'product-sale',
        },
           {
            path: '/admin/pos/sale/data',
            component:  Pos_Sale_Data,
            name: 'pos-sales',
        },
           {
            path: '/admin/pos/edit/:id',
            component:  Pos_Single_Sale,
            name: 'pos-edit',
        },

           //Public Blog Route
           {
            path: '/blogs',
            component: Public_Posts,
            name: 'public-post',
        },

        {
            path: '/post-single/:slug',
            component: Single_Post,
            name: 'post-single',
        },

        {
            path: '/post/category/:slug',
            component: Category_single,
            name: 'public-category-single',
        },

        {
            path: "/:catchAll(.*)",
            name: "NotFound",
            component: () => import("../components/404/NotFound.vue")
          },

    ]
});

export default routes;

