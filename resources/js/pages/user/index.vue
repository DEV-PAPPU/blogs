<template>
    <div class="container">
        <div class="">
            <div class="">
                <div class="card">

                    <div class="card-header">All users Lists</div>

                    <div class="card-body">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 100px"> Id </th> -->
                                        <th> User Name </th>
                                        <th> Email </th>
                                        <th> User Role</th>
                                        <th> Date </th>
                                        <th style="width: 170px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody v-if="users.length">
                                    <tr v-for="user in users" :key="user.id">
                                        <td> {{ user.name }} </td>
                                        <td> {{ user.email }} </td>
                                        <td>
                                            <span v-if="user.role == 0" class="badge badge-success">Super-Admin</span>
                                            <span v-else-if="user.role == 'admin'" class="badge badge-success">Sub-Admin</span>
                                            <span v-else class="badge badge-primary">Blogger</span>
                                        </td>
                                        <td> {{ user.created_at | dateformat}}</td>

                                        <td class="d-flex" style="width: 200px">

                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="las la-eye icon"></i></a>

                                            <router-link v-if="auth.edit == 'true' || auth.role == '0'"
                                                :to="{name: 'edit-user', params: {id: user.id}}"
                                                class="btn btn-primary btn-sm">
                                                <i class="las la-pen-square"></i>
                                            </router-link>

                                            <div v-if="auth.destroy == 'true' || auth.role == '0'" class="delete">

                                                <a @click.prevent="Deleteuser(user)" v-if="user.role == 1" href="#"
                                                    class="btn btn-danger btn-sm"><i class="las la-trash-alt"></i>
                                                </a>

                                                <a v-else href="#" @click="adminDelete()" class="btn btn-danger btn-sm">
                                                    <i class="las la-trash-alt"></i>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4">
                                            <h5 class="text-center mt-4 mb-4">No user found.</h5>
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
           users:{},
           auth:{}
       }
   },
    methods: {

        loadUser(){
            axios.get('/api/users')
            .then(response =>{
                this.users = response.data;
            });
          },

        Deleteuser(user){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/users/${user.id}`)
                let index = this. users.indexOf(user);
                this. users.splice(index, 1);
                Swal.fire(
                'Deleted!',
                'User has been deleted.',
                'success'
                )
            }
            })
        },

            adminDelete(){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Admin Can`t Be Delete!',
                footer: '<a href="">Why do I have this issue?</a>'
                })
            }
    },

        mounted(){
        this.loadUser();

         axios.get('/api/auth/user/data')
            .then(response =>{
                this.auth = response.data;
            })
        },


}
</script>


<style scoped>


.la[data-v-794fb692], .las[data-v-794fb692] {
    font-size: 21px;
    margin-top: 5px;
}

</style>

