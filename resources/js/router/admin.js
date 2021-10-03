import app from '../app'


//Post Comments
import Post_Comment from '../components/comment/index.vue'
import Post_Comment_Edit from '../components/comment/edit.vue'


//Blogs Components
import Post_Lists from '../post/post/index.vue'
import Post_Create from '../post/post/create.vue'
import Post_Edit from '../post/post/edit.vue'

//Category Components
import Category_lists from '../post/category/index.vue'
import Category_Create from '../post/category/create.vue'
import Category_Edit from '../post/category/edit.vue'


// Task management
import Task_Index from '../pages/admin/task/index.vue'
import Task_Add from '../pages/admin/task/create.vue'
import Task_Edit from '../pages/admin/task/edit.vue'
import Task_Show from '../pages/admin/task/show.vue'

import Task_Draggable from '../pages/admin/task/draggable.vue'

export default  [

    {
        path: '/admin',
        name: 'admin-home',
        component: () => import("../pages/admin/index.vue")

    },
    {
        path: '/admin/users',
        name: 'all-users',
        component: () => import("../pages/user/index.vue")
    },
    {
        path: '/admin/users/edit/:id',
        name: 'edit-user',
        component: () => import("../pages/user/edit.vue")

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

]
