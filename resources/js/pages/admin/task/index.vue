<template>
    <div class="container">
        <div class="">
            <div class="">
                <div class="card">
                    <div class="card-header">All Tasks Lists</div>
                    <div class="card-body">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Title </th>
                                        <th> Status </th>
                                        <th> Topic </th>
                                        <th> Date </th>
                                        <th style="width: 170px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody v-if="tasks.data.length">
                                    <tr v-for="task in tasks.data" :key="task.id">
                                        <td>{{ task.title | strToUpper}} </td>

                                        <td>
                                            <span v-if="task.status == 0" class="badge badge-success">Done</span>
                                            <span v-else class="badge badge-primary">Pending</span>
                                        </td>

                                        <td>
                                            <span class="badge badge-success">{{task.topic}}</span>
                                        </td>

                                        <td> {{ task.created_at | dateformat}}</td>
                                        <td style="width: 220px">
                                            <router-link :to="{name: 'task-show', params: {id: task.id}}"
                                                class="btn btn-primary btn-sm">
                                                <i class="las la-eye icon"></i></router-link>
                                            <router-link :to="{name: 'task-edit', params: {id: task.id}}"
                                                class="btn btn-primary btn-sm"><i class="las la-pen-square icon"></i>
                                            </router-link>
                                            <a @click.prevent="Deletetask(task)" href="#" class="btn btn-danger btn-sm">
                                                <i class="las la-trash-alt icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <tfoot>
                                    <pagination :data="tasks" @pagination-change-page="loadTasks"></pagination>
                                </tfoot>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4">
                                            <h5 class="text-center mt-4 mb-4">No task found.</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {


   data() {
       return {
           tasks:{}
       }
   },

    methods: {

          // Our method to GET results from a Laravel endpoint
        loadTasks(page = 1) {
            axios.get('/api/task?page=' + page)
                .then(response => {
                    this.tasks = response.data;
                });
        },

        Deletetask(task){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success confirmButton',
                    cancelButton: 'btn btn-danger cancelButton'
                },
                buttonsStyling: false
                })

              swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/task/${task.id}`)
                    let index = this.tasks.data.indexOf(task);
                    this.tasks.data.splice(index, 1);
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your Task has been deleted.',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary Task is safe :)',
                    'error'
                    )
                }
            })
        }
    },

        mounted(){
        this.loadTasks();
        },

}
</script>


<style scoped>


.icon{
    font-size: 21px;
    margin-top: 5px;
    text-align: center;
}

</style>
