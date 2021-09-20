<template>
    <div class="">
        <div class="container">
            <form @submit.prevent="addTask">
                <div class="product">
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <input type="text" v-model="form.title" title="title" class="form-control"
                                            placeholder="title">
                                        <span v-if="errors['title']" class="text-danger">
                                            {{errors['title'][0]}}
                                        </span>
                                    </div>

                                    <div class="form-group text-editor">
                                        <vue-editor v-model="form.detail"></vue-editor>

                                        <span v-if="errors['detail']" class="text-danger">
                                            {{errors['detail'][0]}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Info Topic</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="status">Status</label>

                                        <select v-model="form.status" name="status" id="status" class="form-control">
                                            <span v-if="errors['status']" class="text-danger">
                                                {{errors['status'][0]}}
                                            </span>

                                            <option value="" style="display:none;" selected>Select Status
                                            </option>

                                            <option value="0" selected>Done
                                            </option>
                                            <option value="1" selected>Pending
                                            </option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="topic">Topic</label>
                                        <select v-model="form.topic" name="topic" id="topic" class="form-control">

                                            <span v-if="errors['topic']" class="text-danger">
                                                {{errors['topic'][0]}}
                                            </span>

                                            <option value="" style="display:none;" selected>Select Topic
                                            </option>

                                            <option value="0" selected>learning
                                            </option>
                                            <option value="1" selected>Issue
                                            </option>
                                            <option value="2" selected>Vue Js
                                            </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { VueEditor } from "vue2-editor";

   export default {

     data: () => ({
      form:{
          title: '',
          status: '',
          topic:'',
          detail: ''
         },
         errors: {}
      }),

        components: {VueEditor},
        methods: {

         addTask(){
            axios.post('/api/task/store', this.form).then(response => {
                console.log(response)
                this.errors = ''
                this.form = ''
                Toast.fire({
                    icon: 'success',
                    title: 'Task Added'
                });
            })
            .catch(e => {this.errors = e.response.data.errors;});
        },

        },
        mounted(){
        },
    }
</script>


<style scoped>
.text-editor{
    margin-top: 20px;
}

</style>


