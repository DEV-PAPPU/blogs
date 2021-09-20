import Vue from 'vue';
import VueRouter from 'vue-router';

// User List
import User_list from '../pages/user/index.vue'
import User_Edit from '../pages/user/edit.vue'

import Admin_home from '../pages/admin/index.vue'
//Blogs Components
import Post_Lists from '../post/post/index.vue'
import Post_Create from '../post/post/create.vue'
import Post_Edit from '../post/post/edit.vue'

//Category Components
import Category_lists from '../post/category/index.vue'
import Category_Create from '../post/category/create.vue'
import Category_Edit from '../post/category/edit.vue'


import Category_single from '../public/post/single_category.vue'


// User Blog CRUD
import User_Post_Lists from '../post/userpost/index.vue'
import User_Post_Edit from '../post/userpost/edit.vue'


//Post Comments
import Post_Comment from '../components/comment/index.vue'
import Post_Comment_Edit from '../components/comment/edit.vue'


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


// POS Route

//Pos- Components
import Create_Product from '../pages/pos/product/create.vue'
import Product_List from '../pages/pos/product/index.vue'
import Product_Edit from '../pages/pos/product/edit.vue'
import Product_Sale from '../pages/pos/includes/posale.vue'
import Pos_Sale_Data from '../pages/pos/includes/sale_items.vue'
import Pos_Single_Sale from '../pages/pos/includes/pos_single_sale.vue'
import Search from '../components/form.vue'


// Task management
import Task_Index from '../pages/admin/task/index.vue'
import Task_Add from '../pages/admin/task/create.vue'
import Task_Edit from '../pages/admin/task/edit.vue'
import Task_Show from '../pages/admin/task/show.vue'

import Task_Draggable from '../pages/admin/task/draggable.vue'

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: website_home,
            name: 'home',
        },
        {
            path: '/admin',
            component: Admin_home,
            name: 'admin-home',
        },
        {
            path: '/admin/users',
            component: User_list,
            name: 'all-users',
        },
        {
            path: '/admin/users/edit/:id',
            component: User_Edit,
            name: 'edit-user',
        },
        {
            path: '/admin/post/lists',
            component: Post_Lists,
            name: 'all-post',
        },
        {
            path: '/admin/post/create',
            component: Post_Create,
            name: 'post-create',
        },

        {
            path: '/admin/post/edit/:id',
            component: Post_Edit,
            name: 'post-edit',
        },
        {
            path: '/admin/category/create',
            component: Category_Create,
            name: 'create-category',
        },
        {
            path: '/admin/category/lists',
            component: Category_lists,
            name: 'all-category',
        },
        {
            path: '/admin/category/edit/:id',
            component: Category_Edit,
            name: 'category-edit',
        },
        {
            path: '/admin/comments',
            component: Post_Comment,
            name: 'post-comments',
        },
        {
            path: '/admin/comments/edit/:id',
            component:Post_Comment_Edit,
            name: 'post-comments-edit',
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
            path: '/admin/search',
            component: Search,
            name: 'search',
        },
        //  Task management
        {
            path: '/admin/task/management',
            component: Task_Index,
            name: 'admin-task',
        },
        {
            path: '/admin/task/add',
            component: Task_Add,
            name: 'admin-task-add',
        },
        {
            path: '/admin/task/edit/:id',
            component: Task_Edit,
            name: 'task-edit',
        },
        {
            path: '/admin/task/show/:id',
            component: Task_Show,
            name: 'task-show',
        },
        {
            path: '/admin/task/draggable',
            component: Task_Draggable,
            name: 'task-draggable',
        },
        {
            path: '/post/category/:slug',
            component: Category_single,
            name: 'public-category-single',
        },

    ]
});

export default routes;

