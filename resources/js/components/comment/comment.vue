<template>
    <div class="">
        <form @submit.prevent="comment">

            <div class="comment">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="form.name" name="name" class="form-control" required placeholder="name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" v-model="form.email" name="email" required class="form-control"
                                placeholder="email">
                        </div>


                        <div class="form-group">
                            <label for="comment">Rating</label> <br>
                            <StarRating v-model="form.rating" v-bind:star-size="20"/>
                        </div>

                        <div class="form-group">
                            <label for="comment">comment</label> <br>
                            <textarea v-model="form.comment" class="w-full border border-gray" name="comment" required id="summernot"
                                style="height: 200px;"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'
// import AwesomeVueStarRating from 'awesome-vue-star-rating'

import axios from 'axios';
   export default {
 props:['post_id'],
    data(){
       return{
       form:{
        name: '',
         email: '',
         comment: '',
         rating: '',
       }
       }
    },

    components: {
  StarRating
},
    methods: {

        comment(){
            this.form.post_id = this.post_id
          axios.post('/api/comment', this.form).then(response =>{
              console.log(response)
              this.form.name = ''
              this.form.email = ''
              this.form.comment = ''
              this.form.rating = ''
              Toast.fire({
                    icon: 'success',
                    title: 'Thanks For Comment Your Comment Pending Now'
             });


        });

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

