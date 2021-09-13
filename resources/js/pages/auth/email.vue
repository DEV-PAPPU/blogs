<template>
  <div>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h4>Sent a request for password</h4>
                        </div>
                        <div class="card-body">
                            <form action="post" @click.prevent="emailsent()">
                                <div class="form-group">
                                    <label for="email">Your Email</label>
                                    <input type="text" v-model="form.email" :class="{'is-invalid': form.errors.has('email')}" name="email" class="form-control" placeholder="Enter your email">
                                    <span :form="form" field="email"></span>
                                </div>

                                <div class="form-group">
                                   <button type="submit"  class="btn btn-success px-4">Sent</button>
                                </div>
                            </form>
                        </div>
                    </div>
              </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Form from 'vform'
export default {
    data(){
       return{
           form: new Form({
                email:'',
            }),
       }
    },
    methods:{
        emailsent(){
             this.form.post('/password/email');
        },
    },
    mounted(){

    }
}
</script>
