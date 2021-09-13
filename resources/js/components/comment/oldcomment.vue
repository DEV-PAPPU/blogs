<template>
    <div class="">
        <form @submit.prevent="comment">
            <div class="comment">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <p>Post id </p>
                            <label for="name">Name</label>
                            <input type="text" v-model="form.name" name="name" class="form-control" placeholder="name"
                                :class="{ 'is-invalid': form.errors.has('name') }">
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" v-model="form.email" name="email" class="form-control"
                                placeholder="email" :class="{ 'is-invalid': form.errors.has('email') }">
                            <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                        </div>

                        <div class="form-group">
                            <label for="comment">comment</label> <br>
                            <textarea v-model="form.comment" name="comment" id="summernote"
                                style="height: 200px;"></textarea>
                        </div>
                        <input type="hidden"  v-model="form.blog_id" name="blog_id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

//  import Form from 'vform'

   export default {

    props:['post_id'],
    postdata:{},
    //  data: () => ({
    //     form: new Form({
    //      name: '',
    //      email: '',
    //      blog_id: '',
    //      comment: ''

    //   }),

    //   }),

    data(){
       return{
         form:{
         name: '',
         email: '',
         blog_id: '',
         comment: ''
           }
       }
    },
    methods: {
       comment(){
            this.form.post('/api/comment').then(()=>{
                    this.form.reset();
                    Toast.fire({
                    icon: 'success',
                    title: 'Thanks For Comment Your Comment Pending Now'
                    });
            });
        },

        post_id_pass_to_blog_id(){
            this.form.blog_id = this.post_id;
        }
    },
    computed:{

         test(){
             return 1;
         }
    },

    }
</script>

<style  scoped>

@media only screen and (max-width: 4000px) and (min-width: 900px)  {

textarea#summernote {
   width:757px !important;
}
}


@media only screen and (max-width: 800px) and (min-width: 0px)  {
textarea#summernote {
   width:460px !important;
}
}
textarea#summernote {
    background: #efeded;
    border: solid 1px black !important;
}

</style>

