<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comment Edit</div>

                    <div class="card-body">

                        <form @submit.prevent="updateCategory">
                            <div >
                                 <div class="form-group">
                                        <label for="status">Status</label>
                                        <select v-model="form.status" name="status" id="status"
                                            :class="   {'is-invalid':  form.errors.has('status')}" class="form-control">

                                            <option value="0" selected>Approved
                                            </option>
                                            <option value="1" selected>Pending
                                            </option>
                                        </select>
                                    </div>
                            </div>

                            <div>
                                <h5>User Comment </h5>
                                  {{form.comment}}
                            </div>

                            <div class="form-group">
                            <label for="comment">Rating</label> <br>
                            <StarRating v-model="form.rating" v-bind:star-size="20"/>
                            <!-- <AwesomeVueStarRating/> -->
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
import StarRating from 'vue-star-rating'
// import AwesomeVueStarRating from 'awesome-vue-star-rating'


   export default {
     data: () => ({
        form: new Form({
          status: '',
          comment: '',
          rating: '',
      })

      }),

    components: {
   StarRating
    },

    methods: {
        updateCategory(){
            let id = this.$route.params.id;
            this.form.put(`/api/comment/${id}`).then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Comment Update successfully.'
                });

            })
        },


        loadComment(){
            let id = this.$route.params.id;
            axios.get(`/api/comment/${id}/edit`).then(response => {
                this.form.status = response.data.status;
                this.form.comment = response.data.comment;
                this.form.rating = response.data.rating;
            });
        }
    },


    mounted(){

        this.loadComment();
    }


    }
</script>
