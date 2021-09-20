<template>
    <div class="container">
        <div class="task d-flex">
            <task-list title="Todo">
                <draggable
                v-model="tasks.data"
                group="taskapp"
                @end="onEnd"
                @change="todo()"
                >
                   <task-item v-for="task in tasks.data" :key="task.id" :item="task"></task-item>
                </draggable>
            </task-list>
            <task-list title="In Progress">
                 <draggable
                :list="progressdata.data"
                @end="onEnd"
                group="taskapp"
                @change="progress()"
                >
                   <task-item v-for="progress in progressdata.data" :key="progress.id" :item="progress"></task-item>
                </draggable>
            </task-list>
            <task-list title="Complated">
                 <draggable
                :list="complated"
                @end="onEnd"
                group="taskapp"
                @change="complated()"
                >
                   <task-item v-for="complated in complated" :key="complated.id" :item="complated"></task-item>
                </draggable>
            </task-list>

        </div>
    </div>
</template>

<script>
import TaskList from "../../admin/task/includes/taskbody.vue";
import TaskItem from "../../admin/task/includes/task.vue";
import draggable from 'vuedraggable'
    export default {
        data: () => ({
            test: 7,
            tasks:{},
            progressdata:{},
            // olddprogress:[
            //       {
            //         id : 3,
            //         title : 'Mobile App'

            //     }
            // ],
            complated:[
                 {
                    id : 6,
                    title : 'Wp CMS'
                },

            ],
        }),

    components: {
       TaskList,
       TaskItem,
       draggable
         },
         methods:{

        // Our method to GET results from a Laravel endpoint
        loadTasks(page = 1) {
            axios.get('/api/tasks?page=' + page)
                .then(response => {
                    this.tasks = response.data;
                });
         },

        loadproduct() {
            axios.get('/api/product')
                .then(response => {
                    this.progressdata = response.data;
                });
         },


         todo(){
            let todo = this.tasks
             console.log(todo)
         },

         progress(){
            let progress = this.progress
             console.log(progress)
         },

         complated(){
            let complated = this.complated
             console.log(complated)
         },

         },

        mounted() {
            this.loadTasks();
            this.loadproduct();
            console.log('Component mounted.')
        }
    }
</script>

