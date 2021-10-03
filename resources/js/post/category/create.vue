<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form @submit.prevent="createcategory">
                            <div>
                                <input type="text" v-model="form.name" name="name" class="form-control"
                                    placeholder="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                            </div>
                            <br>

                            <div style="margin-top: 20px;" class="d-flex mb-3">
                                <input id="image" @change="onImageChange" type="file"  class="form-control-file">
                                <div style="width:80px border-radius: 5px;">
                                    <img :src="showimg" class="img-fluid" />
                                </div>
                            </div>

                            <button type="submit" class="nav-link btn btn-lg btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Sub-Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form @submit.prevent="Add_Sub_Category">

                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                 <span v-if="errors['parent_category_id']" class="text-danger">
                                       {{errors['parent_category_id'][0]}}
                                    </span>
                                <select v-model="subcat_form.parent_category_id" name="parent_category_id" id="parent_category_id"
                                     class="form-control">
                                    <option value="" style="display: none" selected>Please select
                                    </option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <input type="text" v-model="subcat_form.name" name="name" class="form-control"
                                    placeholder="name">
                                    <span v-if="errors['name']" class="text-danger">
                                       {{errors['name'][0]}}
                                    </span>
                            </div>

                             <div style="margin-top: 20px;" class="d-flex">
                                <input id="image" @change="onImageChange" type="file"  class="form-control-file">
                                <div style="width:80px border-radius: 5px;">
                                    <img :src="showimg" class="img-fluid" />
                                </div>
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

    export default {

        data: () => ({
            form: new Form({
                name: '',
                image: '',
            }),

            subcat_form:{
                parent_category_id: '',
                name: '',
                image: '',
            },

          errors:{},
          categories:{},
          showimg: '',

        }),

        methods: {
            // createcategory() {

            //     this.form.post('/api/category').then(({
            //         response
            //     }) => {
            //         console.log(response)
            //         this.form.reset();
            //      Toast.fire({
            //             icon: 'success',
            //             title: 'Category Added successfully.'
            //       });

            //     })
            // },


            createcategory(){
                let data = new FormData();
                data.append('name', this.form.name);
                 if(document.getElementById('image').files[0]){data.append('image', document.getElementById('image').files[0])};
                axios.post('/api/category', data)
                .then( (response)=> {
                    this.form.reset();
                    this.errors = ''
                    Toast.fire({
                        icon: 'success',
                        title: 'Category Added successfully.'
                    });
                    console.log(response)
                })
                 .catch(e => {this.errors = e.response.data.errors;});
          },


            Add_Sub_Category(){
                let data = new FormData();
                data.append('parent_category_id', this.subcat_form.parent_category_id);
                data.append('name', this.subcat_form.name);
                 if(document.getElementById('image').files[0]){data.append('image', document.getElementById('image').files[0])};
                axios.post('/api/subcategory', data)
                .then( (response)=> {
                    this.form.reset();
                    this.errors = ''
                    Toast.fire({
                        icon: 'success',
                        title: 'SubCategory Added successfully.'
                    });
                    console.log(response)
                })
                 .catch(e => {this.errors = e.response.data.errors;});
          },


         onImageChange(e){
            const file = e.target.files[0]
            this.showimg = URL.createObjectURL(file);
         },

            loadCategory(){
            axios.get('/api/category')
            .then(response =>{
                console.log(response);
                this.categories = response.data;
            });
          },

        },


        mounted(){
            this.loadCategory()
        }

    }
</script>
