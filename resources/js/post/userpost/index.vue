<template>
<div class="site-conten">
     <div v-if="Isloader == true" class="loader">
           <preloader></preloader>
        </div>

        <section v-else class="py-5">
        <div class="w-full flex justify-center items-center">
        <div class="h-56 w-72 absolute flex justify-center items-center">
            <img class="object-cover h-20 w-20 rounded-full"
                src="https://development.rooberp.com/Devpappu/pappu.png"
                alt="" />
        </div>

        <div class="
          h-56
          mx-4
          w-5/6
          bg-blue-600
          rounded-3xl
          shadow-md
          sm:w-80 sm:mx-0
        ">
            <div class="h-1/2 w-full flex justify-between items-baseline px-3 py-5">
                <p class="text-white text-sm">Profile</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>

            <div class="bg-white mb-10 h-32 w-full rounded-3xl flex  p-15 flex-col ustify-around items-center lg:hidden md:hidden">
                <div class="w-full h-1/2 flex justify-between items-center px-3 pt-2">
                    <div class="flex flex-col justify-center items-center">
                        <h1 class="text-gray-500 text-xs">Orders</h1>
                        <h1 class="text-gray-600 text-sm">340</h1>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <h1 class="text-gray-500 text-xs">Spent</h1>
                        <h1 class="text-gray-600 text-sm">$2,004</h1>
                    </div>
                </div>
                <div class="w-full h-1/2 flex flex-col justify-center items-center">
                    <h5 class="text-gray-700 font-bold">{{user.name}}.</h5>
                    <h1 class="text-gray-500 mt-2 text-sm">Bangladesh</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="middle-section h-64 px-16 lg:mx-64 md:mx-32 sm:mx-10 mb-3  bg-white rounded-3xl">
        <div class="w-full h-1/2 flex justify-between items-center px-3 pt-2">
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-gray-500 text-xs">Orders</h1>
                <h1 class="text-gray-600 text-sm">340</h1>
            </div>
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-gray-500 text-xs">Spent</h1>
                <h1 class="text-gray-600 text-sm">$2,004</h1>
            </div>
        </div>
        <div class="w-full h-1/2 flex flex-col justify-center items-center">
            <h1 class="text-gray-700 font-bold">{{user.name | strToUpper}}.</h1>
            <h1 class="text-gray-500 mt2 text-sm">Bangladesh</h1>
        </div>

    </div>

    <div class="form-section bg-white rounded-lg p-10 lg:mx-64 md:mx-32 sm:mx-10">
        <div class="w-full p-4 px-5 py-5">
            <div class="flex flex-row mb-2">
                <h2 class="text-3xl font-semibold">Your Profile</h2>
                <h2 class="text-3xl text-green-400 font-semibold">.</h2>
            </div>
            <span class="mt-3">Profile Information</span>

            <form class="mt-5">
                <div class="grid md:grid-cols-2 md:gap-2">
                    <div class="form-field">
                        <Label class="mb-2 text-gray-500">Your Name</Label>
                        <input type="text" name=""
                            class="border rounded h-10 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm"
                            placeholder="Your name">
                    </div>
                    <div class="form-field">
                        <Label class="mb-2 text-gray-500">Your Email</Label>
                        <input type="text" name=""
                            class="border rounded h-10 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm"
                            placeholder="email">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-2 mt-3">
                    <div class="form-field">
                        <Label class="mb-2 text-gray-500">Your Address</Label>
                        <input type="text" name=""
                            class="border rounded h-10 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm"
                            placeholder="address">
                    </div>
                    <div class="form-field">
                        <Label class="mb-2 text-gray-500">Your Password</Label>
                        <input type="text" name=""
                            class="border rounded h-10 w-full focus:outline-none focus:border-green-200 px-2 mt-2 text-sm"
                            placeholder="password">
                    </div>
                </div>

                <button
                    class="px-3 mt-5 py-1 w-28  bg-blue-500 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>

            </form>
            <div v-if="user.read == 'true' || user.role == '0'">
                {{user}}
            </div>
        </div>

    </div>
    </section>
</div>
</template>

<script>
export default {

   data() {
       return {
           user_posts:{},
           user: {},
           Isloader: true,
       }
   },

    methods: {

        loadPost(){
            axios.get('/api/posts')
            .then(response =>{
                this.user_posts = response.data;
            });
          },

        loadUser(){
            axios.get('/api/auth/user/data')
            .then(response =>{
                this.user = response.data;
            })
            .finally(() => this.Isloader = false)
          },

        logout(){
            axios.post('/logout')
            .then(response =>{
                this.$router.push({name:'home'});
                 this.$store.commit('SET_AUTHENTICATED',false);
                console.log(response);
            });
          },

        Deletepost(post){
          axios.delete(`/api/posts/${post.id}`).then(() => {

              Toast.fire({
                    icon: 'success',
                    title: 'Post Deleted Success'
                    }),
                   console.log("Post Deleted Success")

            });

            let index = this.user_posts.indexOf(post);
            this.user_posts.splice(index, 1);
        }
    },

        mounted(){
        this.loadPost();
        this.loadUser();
        },
}
</script>

<style scoped>
    @media (max-width:768px)  {
        .middle-section{
           display: none;
        }

        .form-section{
            margin: 20px 20px !important;

        }
    }

    .middle-section,
    .form-section{
            margin-top: -100px;
        }
</style>

