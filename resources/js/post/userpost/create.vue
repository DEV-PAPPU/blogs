<template>
    <div class="">
        <div class="">
            <form @submit.prevent="createpost">
                <div class="product">
                    <div class="row">
                        <div class="col-12">
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
                                        <label for="Image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" @change="onImageChange" name="image" class="custom-file-input" id="Image">
                                                <label class="custom-file-label" for="Image">Choose Image</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label> <br>
                                        <textarea v-model="form.description" name="description" id="summernote"
                                            style="height: 200px;"></textarea>
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
   export default {

     data: () => ({

         props: ['categories'],
        form: new Form({
          title: '',
          image: '',
          status: '',
          category_id:'',
          description: ''
      }),
      categories:[]

      }),
        methods: {
            loadCategory(){
            axios.get('/api/category')
            .then(response =>{
                console.log(response);
                this.categories = response.data;
            });
          },

         createpost(){
            this.form.post('/api/posts',{
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
                    title: 'Post Added success'
                    });
            });
            console.log('form submited');
        },

            onImageChange(e){
            const file = e.target.files[0]
            this.form.image = file
        },
        },

        mounted(){
        this.loadCategory();
        },
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




