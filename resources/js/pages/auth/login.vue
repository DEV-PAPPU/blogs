<template>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h6> Login</h6>
                        </div>
                        <div class="card-body">
                            <form action="post" @click.prevent="login()">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" v-model="loginForm.email" class="form-control" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                     <label for="password">Password</label>
                                    <input type="password" v-model="loginForm.password" class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="form-group">
                                   <button type="submit" class="btn btn-success px-4">Login</button>
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
</template>

<script>
import axios from 'axios';
export default {
    data(){
       return{
           loginForm: {
                email:'',
                password:'',
            },
       }
    },
    methods:{
         login(){
            axios.post('/login',this.loginForm );
              this.$router.push({name:'user-dashboard'});
              this.$store.commit('SET_AUTHENTICATED', true);
              // set user-data on local storage
             localStorage.setItem('auth',true);
        },
    },
}
</script>
