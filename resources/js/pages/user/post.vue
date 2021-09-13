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
                                    <td>  {{ user.name }} </td>
                                    <td> {{ user.email }} </td>
                                     <td>
                                        <span v-if="user.role == 0" class="badge badge-success">Admin</span>
                                        <span v-else class="badge badge-primary">Blogger</span>
                                    </td>
                                     <td> {{ user.created_at | dateformat}}</td>

                                    <td style="width: 170px">
                                        <router-link :to="{name: 'edit-user', params: {id: user.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                        <a @click.prevent="Deleteuser(user)" href="#" class="btn btn-danger btn-sm">Delete</a>
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
