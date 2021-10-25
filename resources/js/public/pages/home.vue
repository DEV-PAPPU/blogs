<template>
    <div>
        <!-- Start hero section-->

        <div id="home" class="hero-section border-b-2 lg:py-8 border-gray-200">

            <div class="hero-innder-section  section-padding">

                <div class="hero-section-left mt-10 md:my-5" data-aos="zoom-in">
                    <h1 class="hero-heading mt-10 lg:pr-60">Hi I'm Full Stack Web
                        Developer</h1>
                    <p class="mt-10 ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
optio, eaque rerum! Provident similique accusantium nemo autem.
                    </p>
                    <div class="text-anima0tion grid items-center mt-8">
                        <h1 class="heading mr-4">Lorem ipsum dolor sit amet consectetur</h1>
                    </div>
                    <button id="service"
                        class="mt-10 text-white btn-color border-0 py-2 px-6 focus:outline-none hover:bg-indigo-700 rounded text-md">Get
                        Now Service</button>
                </div>

                <div class="hero-section-right items-center" data-aos="fade-left">
                    <img src="http://development.rooberp.com/Devpappu/images/hero-1.png" class="hero-img" alt=""
                        srcset="">
                </div>
            </div>

        </div>

        <!-- End hero section--->


        <div class="category section-margin container-box items-center  border-b-2 border-gray-200">

            <div class="service-info-heading container-box text-center section-margin-top">
                <h1 class="heading before-after lg:mt-10">All Blogs</h1>
            </div>

                <div v-if="post_all.data.length"
                    class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10">
                    <div v-for="post in post_all.data" :key="post.id" class="">
                        <div class="mb-2">
                            <div
                                class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-white  shadow-sm hover:shadow-sm">

                                <img :src="post.image" class="post-image">
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                        {{post.title | trimpost}}
                                    </h1>

                                    <router-link :to="{name: 'post-single', params: {slug: post.slug}}"
                                        class="btn btn-primary btn-block mt-3">View post</router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tfoot >
                        <pagination :data="posts" @pagination-change-page="loadPost"></pagination>
                    </tfoot>
                </div>


        </div>


    </div>
</template>

<script>
import axios from 'axios'
    export default {

      data() {
          return {
              post_all:{}
          }
      },

        mounted() {
             axios.get('/api/public/posts').then(response=>{
                  this.post_all = response.data
            })
        }
    }
</script>

<style scoped>


nav > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
}

nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #e74c3c ;
}
.tab-content{
  background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #e74c3c;
    border-bottom:5px solid #e74c3c;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
}

</style>
