<template>
    <div class="">
        <div class="container">
            <form @submit.prevent="updateproduct">
                <div class="product">
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product Info</h3>
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


                                    <div class="form-group ">
                                        <label for="price">Price</label>
                                        <div class="product-data mr-3">
                                            <input type="number" v-model="form.price" name="price" class="form-control"
                                                placeholder="price" :class="{ 'is-invalid': form.errors.has('price') }">
                                            <div v-if="form.errors.has('price')" v-html="form.errors.get('price')" />
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label> <br>
                                        <vue2-editor/>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label> <br>
                                        <textarea v-model="form.description" name="description" id="summernote" style="width:670px !important; height: 200px;"></textarea>
                                    </div>
                                </div>
                                </div>
                        </div>

                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product Info</h3>
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

 import Form from 'vform'
import{objectToFormData} from 'object-to-formData'

   export default {
     data: () => ({
        form: new Form({
          title: '',
          image: '',
          status: '',
          category_id: '',
          description: '',
           _method:'Put',

      }),
       Showimage: '',
       categories:[],

      }),

    methods: {

            updateproduct(){
                      let id = this.$route.params.id;
            this.form.post('/api/product/'+id,{
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
                    title: 'Product Updated Success'
                    });
            });
            console.log('form submited');
        },

            onImageChange(e){
            const file = e.target.files[0]
            this.form.image = file
        },

        loadpost(){
            let id = this.$route.params.id;

            axios.get(`/api/product/${id}/edit`).then(response => {
                this.form.title = response.data.title;
                this.form.image = response.data.image;
                this.form.price = response.data.price;
                this.form.status = response.data.status;
                this.form.category_id = response.data.category_id;
                this.form.description = response.data.description;
                this.showimage = response.data[0].image;

            });
        },


        loadCategories(){
            axios.get('/api/category').then(response => {
                this.categories = response.data;
            });
        }

    },

    mounted(){

        this.loadpost();
        this.loadCategories();
    }


    }
</script>
