<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <router-link :to="{name: 'all-category'}" class="nav-link">Category To List</router-link>

                    <div class="card-header">Category Edit</div>

                    <div class="card-body">

                        <form @submit.prevent="updateCategory">
                            <div >
                                <input type="text" v-model="form.name" name="name" class="form-control" placeholder="name">

                            </div>
                             <br>
                            <button type="submit" class="nav-link btn btn-lg btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

 import Form from 'vform'
import axios from 'axios';

   export default {
     data: () => ({
        oldform: new Form({
          name: '',
      }),

      form:{
          name: '',
      }

      }),

    methods: {
        // updateCategory(){
        //     let id = this.$route.params.id;
        //     this.form.put(`/api/category/${id}`).then(() => {
        //         Toast.fire({
        //             icon: 'success',
        //             title: 'Category Update successfully.'
        //         });

        //     })
        // },


            updateCategory(){
            let id = this.$route.params.id;
            axios.put(`/api/category/${id}`, this.form).then(response => {
                console.log(response)
            });
          },


        loadCategory(){
            let id = this.$route.params.id;
            axios.get(`/api/category/${id}/edit`).then(response => {
                this.form.name = response.data.name;
            });
        }
    },


    mounted(){

        this.loadCategory();
    }


    }
</script>
