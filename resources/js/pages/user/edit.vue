<template>
    <div class="">
            <form @submit.prevent="updatepost">
                <div class="product">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                        <h6>Edit User</h6>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" v-model="form.name" name="name" class="form-control"
                                            placeholder="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                    </div>

                                    <div class="form-group">
                                        <label for="email">User Email</label>
                                        <input type="text" v-model="form.email" name="email" class="form-control"
                                            placeholder="email" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                                    </div>

                                    <div class="form-group">
                                        <label for="role">User Role</label>
                                        <select v-model="form.role" name="role" id="role"
                                            :class="      {'is-invalid':  form.errors.has('role')}"
                                            class="form-control">
                                            <option value="" style="display: none" selected>Please select
                                            </option>
                                            <option value="1" selected>Blogger
                                            </option>
                                            <option value="0" selected>Admin
                                            </option>

                                        </select>
                                    </div>

                                    <div class="user-action">
                                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" v-model="form.read" ></td>
                                        <td><input type="checkbox" v-model="form.write" ></td>
                                        <td><input type="checkbox" v-model="form.edit" ></td>
                                        <td><input type="checkbox" v-model="form.destroy"></td>
                                    </tr>

                                </tbody>
                                        </table>
                                    </div>
                                     <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
    </div>
</template>

<script>

 import Form from 'vform'

   export default {
     data: () => ({
        form: new Form({
         email: '',
         email: '',
          role: '',
          read: '',
          write: '',
          edit: '',
          destroy: '',
           _method:'Put',

      }),

      }),

    methods: {
       updatepost(){
            let id = this.$route.params.id;

            // alert(this.form.read)
            this.form.post('/api/users/'+id).then(()=>{

                    Toast.fire({
                    icon: 'success',
                    title: 'User Updated Success'
                    });
            });
        },

        loadUser(){
            let id = this.$route.params.id;
            axios.get(`/api/users/${id}/edit`).then(response => {
                this.form.name = response.data.name;
                this.form.email = response.data.email;
                this.form.role = response.data.role;
                this.form.read = response.data.read;
                this.form.write = response.data.write;
                this.form.edit = response.data.edit;
                this.form.destroy = response.data.destroy;
            });
        },

    },

    mounted(){

        this.loadUser();
    }


    }
</script>

<style  scoped>

textarea#summernote {
    background: #efeded;
    border: solid 1px black !important;
}

textarea#summernote {
   width:660px !important;
}
</style>

