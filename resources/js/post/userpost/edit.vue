<template>
    <div class="">
        <router-link :to="{name: 'user-all-post'}">Back</router-link>
        <div class="">
            <form @submit.prevent="updatepost">
                <div class="product">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header flex">

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

 import Form from 'vform'

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
       updatepost(){
            let id = this.$route.params.id;
            this.form.post('/api/posts/'+id).then(()=>{
                    Toast.fire({
                    icon: 'success',
                    title: 'Post Updated Success'
                    })
            });
        },

        loadpost(){
            let id = this.$route.params.id;

            axios.get(`/api/post/${id}/edit`).then(response => {
                this.form.title = response.data.title;
                this.form.image = response.data.image;
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

<style  scoped>

textarea#summernote {
    background: #efeded;
    border: solid 1px black !important;
}

textarea#summernote {
   width:660px !important;
}
</style>

