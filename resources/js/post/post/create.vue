<template>
    <div class="">
        <div class="container">
            <form @submit.prevent="createpost">
                <div class="product">
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Post Info</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" v-model="form.title" name="title" class="form-control"
                                            placeholder="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
                                    </div>


                                    <div class="form-group text-editor">
                                        <label for="title">Description</label>
                                        <vue-editor v-model="form.description"></vue-editor>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Post Info</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select v-model="form.category_id" name="category_id" id="category_id"
                                            :class="      {'is-invalid':  form.errors.has('category_id')}"
                                            class="form-control">
                                            <option value="" style="display: none" selected>Please select
                                            </option>
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">{{category.name}}
                                            </option>
                                        </select>
                                    </div>

                                    <div v-if="filtersubcategory.length" class="form-group">
                                        <label for="category_id">Sub Category</label>
                                        <select v-model="form.sub_category_id" name="sub_category_id" id="category_id"
                                            :class="      {'is-invalid':  form.errors.has('category_id')}"
                                            class="form-control">
                                            <option value="" style="display: none" selected>Please select
                                            </option>
                                            <option v-for="sub_category in filtersubcategory" :key="sub_category.id"
                                                :value="sub_category.id">{{sub_category.name}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select v-model="form.status" name="status" id="status"
                                            :class="   {'is-invalid':  form.errors.has('status')}" class="form-control">

                                            <option value="0" selected>Publish
                                            </option>
                                            <option value="1" selected>Draft
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" @change="onImageChange" name="image" class="custom-file-input" id="Image">
                                                <label class="custom-file-label" for="Image">Choose Image</label>
                                            </div>
                                        </div>
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
import{objectToFormData} from 'object-to-formData'
 import Form from 'vform'
import { VueEditor } from "vue2-editor";

   export default {

     data: () => ({

         props: ['categories'],
        form: new Form({
          title: '',
          image: '',
          status: '',
          category_id:'',
          sub_category_id:'',
          description: ''
      }),
      categories:[],
      subcategories:[],

      }),

        components: {
       VueEditor
         },
        methods: {
            loadCategory(){
            axios.get('/api/category')
            .then(response =>{
                console.log(response);
                this.categories = response.data;
            });
          },

            loadSubCategory(){
            axios.get('/api/subcategory')
            .then(response =>{
                console.log(response);
                this.subcategories = response.data;
            });
          },

         createpost(){
            this.form.post('/api/post',{
                transformRequest:[function(data, headers){
                    return objectToFormData(data)
                }],
                onUploadProgress: e =>{
                    console.log(e)
                }
            }).then(({data})=>{
                console.log(data);
               this.form.reset();
               Toast.fire({
                    icon: 'success',
                    title: 'Post created'
                    });
            });
            console.log('form submited');
        },

            onImageChange(e){
            const file = e.target.files[0]
            this.form.image = file
        },
        },

            computed:{
            filtersubcategory(){
                 return this.subcategories.filter((items) => items.category_id == this.form.category_id)
            },

        },

        mounted(){
        this.loadCategory();
        this.loadSubCategory();
        },
    }
</script>


<style scoped>
.text-editor{
    margin-top: 10px;
}

</style>


