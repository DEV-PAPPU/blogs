<template>
     <form  class="py-8 items-center rounded  mt-7">
            <div class="">
                <label for="fname">Your Name:</label><br>
                <input type="text" v-model="form.name" placeholder="Email"
                    class="input-widht bg-white rounded border border-gray-400 text-base px-4 py-2 mb-4" required><br>
                    <span class="invalid-feedback" v-if="errors.hasOwnProperty('name')">
                {{ errors.name[0] }}
            </span>
            </div>
            <div class="">
                <label for="fname">Your Email:</label><br>
                <input type="text" v-model="form.email" placeholder="Email"
                    class="input-widht bg-white rounded border border-gray-400 text-base px-4 py-2 mb-4" required><br>
            </div>
            <div class="">
                <label for="fname">Your Project Info:</label><br>
                <input type="text" v-model="form.project" placeholder="Project"
                    class="input-widht bg-white rounded border border-gray-400 pb-16 text-base px-4 py-2 mb-4" required><br>
            </div>
            <!-- <button type="submit" value="Submit"
                class="text-white btn-color border-0 py-2 px-10  focus:outline-none rounded text-lg">Submit</button> -->

                   <VueLoadingButton
                    aria-label="Post message"
                    class="button text-white btn-color border-0 py-2 px-10  focus:outline-none rounded text-lg"
                    @click.native="sentmail"
                    :loading="isLoading"
                    :styled="isStyled"
                    >Send</VueLoadingButton>
        </form>
</template>

<script>
import VueLoadingButton from 'vue-loading-button';

    export default {

    data(){
       return{

        isLoading: false,
       isStyled: false,
       errors: '',
       form:{
        name: '',
         email: '',
         project: '',
       }
       }
    },

   components:{VueLoadingButton},

    methods: {

      sentmail(){
              this.isLoading = true
              this.isStyled = true
              axios.post('/api/sentmail', this.form)
             .then(response =>{
              this.errors = response.data.errors;
              this.form.name = ''
              this.form.email = ''
              this.form.project = ''
              Toast.fire({
                    icon: 'success',
                    title: 'Thanks Check Your Mail'
             });
            })
            .catch(response => {
                if(response.status === 422){
                    this.errors = response.data.errors
                }
            })
            .finally(() => this.isLoading = false)
          },

    },
        mounted() {
            console.log('Form mounted.')
        }
    }
</script>
