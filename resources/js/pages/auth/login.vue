<template>
  <div>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h4> Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="post" @click.prevent="login()">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" v-model="loginForm.email" :class="{'is-invalid': loginForm.errors.has('email')}" name="email" class="form-control" placeholder="Enter your email">
                                    <span :form="loginForm" field="email"></span>
                                </div>
                                <div class="form-group">
                                     <label for="password">Password</label>
                                    <input type="password" v-model="loginForm.password" :class="{'is-invalid': loginForm.errors.has('password')}" name="password" class="form-control" placeholder="Enter your password">
                                    <span :form="loginForm" field="password"></span>
                                </div>
                                <div class="form-group">
                                   <button type="submit" :disabled="loginForm.busy"  class="btn btn-success px-4">Login</button>
                                </div>
                            </form>
                        </div>
                        <tfoot class=" px-4 pb-2">
                            <router-link :to="{name: 'reset-password'}">Password Forget?</router-link>
                        </tfoot>
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
           loginForm: new Form({
                email:'',
                password:'',
            }),
       }
    },
    methods:{
         login(){
            this.loginForm.post('/login');
            this.$router.push({name:'user-dashboard'});
            this.$store.dispatch("authUser")

        },

        // await this.getUserData();
        // async getUserData(){
        //     await axios.get('/api/auth/user/data').then(response =>{
        //         let user = response.data;
        //         // this.$store.commit('SET_USER', user);
        //         // set user-data on local storage
        //         localStorage.setItem('authuser', JSON.stringify(user));
        //         this.$store.commit('SET_AUTHENTICATED',true);
        //         // set data on local storage
        //         // localStorage.setItem('auth',true);
        //     });
        // },
    },
    mounted(){

    }
}
</script>
