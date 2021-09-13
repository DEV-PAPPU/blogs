<template>
  <div>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h4>Admin Login {{admin}}</h4>
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

            admin: "",
       }
    },
    methods:{
        async login(){

            await axios.get('/sanctum/csrf-cookie');
            await this.loginForm.post('/login');
            await this.getUserData();
            // this.$router.push({name:'admin'});
            this.$swal.fire(
                'Success!',
                'You are Login Successfully!',
                'success'
            );
        },
        async getUserData(){
            await axios.get('/api/user').then(response =>{
                let user = response.data;
                let Isadmin = user.role;
                   // 0 for admin
                 if(Isadmin == '0'){

                    this.$router.push({name:'admin-home'});
                    this.$store.commit('SET_ADMIN',true);
                     // set admin-data on local storage
                    localStorage.setItem('admin', JSON.stringify(user));
                 }
                 // 1 for user
                 else if(Isadmin == '1')
                 {
                     this.$router.push({name:'home'});
                     this.admin = ("your are not admin");
                     console.log("your are not admin");
                 }

                 else {
                      this.admin = ("Error You Can`t Access");
                  }

                this.$store.commit('SET_USER', user);
                this.$store.commit('SET_AUTHENTICATED',true);
                // set data on local storage
                localStorage.setItem('auth',true);
            });
        },
    },
    mounted(){

    }
}
</script>
