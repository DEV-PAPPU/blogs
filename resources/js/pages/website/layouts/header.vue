<template>
    <div class="header site-header">

        <div class="menu flex justify-between items-center">

            <!-- Website logo div-->
            <div class="logo">
                <router-link :to="{name: 'home'}"><img src="https://development.rooberp.com/Devpappu/pappu.png"
                        class="brang-logo" alt="" srcset=""></router-link>
            </div>


            <!-- <div class="search-box">
                <button @click="search()" class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" v-model="form.text" name="text" class="input-search" placeholder="Type to Search...">
            </div> -->

            <!-- <div class="form">
                <form  @submit.prevent="search">
                    <input type="text" v-model="form.text" name="text" class="rounded-sm mr-2 text-sm px-1" placeholder="Search...">
                <button type="submit"  class=" text-white text-sm">search</button>
                </form>
            </div> -->

            <!-- Menu itesms div-->

            <div class="menu-items list-none">

                <div class="phone-menu">
                    <a href="#" id="icon-menu"><i class="fa fa-bars"></i></a>
                </div>

                <nav class="nav-menu">

                    <li>
                        <router-link :to="{name: 'home'}">Home</router-link>
                    </li>
                    <li>
                        <a href="#service"> <i class="fab fa-app-store-ios header-icons"></i> <span> Services</span></a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-book header-icons"></i> <span>Portfolio</span> </a>
                    </li>
                    <li>
                        <router-link :to="{name: 'public-post'}">Blogs</router-link>
                    </li>
                    <li>
                        <a href="#about"> <i class="fa fa-address-book header-icons"></i> <span>About</span> </a>
                    </li>

                    <li>
                        <a href="#contact"> <i class="fa fa-address-book header-icons"></i> <span>Contact</span> </a>
                    </li>
                    <li>

                    <!-- real time hide show with vuex -->
                    <li>
                        <div class="auth-header">
                            <div class="authenticated" v-if="auth == true">
                                <router-link :to="{name: 'user-dashboard'}">My Account</router-link>
                                <a href="#" @click="logout()">Logout</a>
                            </div>

                            <div class=""  v-else>
                                <router-link :to="{name: 'user-sign-up'}">Register</router-link>
                                <router-link :to="{name: 'singing'}">Log in</router-link>
                        </div>
                        </div>
                    </li>

                </nav>

            </div>

        </div>
    </div>

</template>

<script>
// import axios from 'axios'
import Form from 'vform'
export default {

     data: () => ({
        form: new Form({
          text: '',
      })

      }),

    methods:{
      logout(){
        axios.post('/logout').then(response =>{
          this.$router.push({name:'home'});
          console.log('Logut success',response);
          this.$store.commit('SET_AUTHENTICATED',false);
          localStorage.removeItem("authuser");
          localStorage.removeItem("auth");
        });
      },

      search() {
                this.form.get('/api/search').then(({ response }) => {
                console.log(response);
                //  this.$router.push({name:'search'});

                })
            },

    //   search(){
    //        let  data = this.form.text;
    //       axios.get('/search/', + data).then(response =>{
    //       this.$router.push({name:'search'});
    //     });

    //   }

    },

  computed:{
      auth(){
        return this.$store.getters.getAuthenticated;
      },

      authuser(){
        return localStorage.getItem('authuser')
      },

    }
}
</script>

<style scoped>
*{
  box-sizing: border-box;
}

.search-box{
  width: fit-content;
  height: fit-content;
  position: relative;
}
.input-search{
  height: 50px;
  width: 50px;
  border-style: none;
  padding: 10px;
  font-size: 18px;
  letter-spacing: 2px;
  outline: none;
  border-radius: 25px;
  transition: all .5s ease-in-out;
  background-color: #22a6b3;
  padding-right: 40px;
  color:#fff;
}
.input-search::placeholder{
  color:rgba(255,255,255,.5);
  font-size: 18px;
  letter-spacing: 2px;
  font-weight: 100;
}
.btn-search{
  width: 50px;
  height: 50px;
  border-style: none;
  font-size: 20px;
  font-weight: bold;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  position: absolute;
  right: 0px;
  color:#ffffff ;
  background-color:transparent;
  pointer-events: painted;
}
.btn-search:focus ~ .input-search{
  width: 250px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}
.input-search:focus{
  width: 250px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}


.header.site-header {
    margin-top: -26px;
}
</style>
