<template>
    <div>
        <!-- Start hero section-->

        <div id="home" class="hero-section border-b-2 lg:py-8 border-gray-200">

            <div class="hero-innder-section  section-padding">

                <div class="hero-section-left mt-10 md:my-5" data-aos="zoom-in">
                    <h1 class="hero-heading mt-10 lg:pr-60">Web-base software
                        Developer</h1>
                    <p class="mt-10 ">I'm working on web development since 2018 I have done 200+projects. Like
                        e-commerce site small,large-business site portfolio website. And done several bug-fixing
                        projects using custom CSS, js and etc.
                    </p>
                    <div class="text-anima0tion grid items-center mt-8">
                        <h1 class="heading mr-4">Hello! I am <span class="type"></span></h1>
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


        <!-- Start service section-->


        <div id="service" class="service-section  border-b-2 border-gray-200 mb-16" data-aos="fade-right">



            <div class="service-info-heading container-box text-center section-margin-top">
                <h1 class="heading before-after">My Services For You</h1>
            </div>

            <div id="owl-carousel" class="service-inner container-box section-margin owl-carousel owl-theme">

                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fab fa-wordpress-simple service-icons"></i></a>
                        <p class="service-name">Wordpress Website</p>
                    </div>
                    <div class="service-content mt-3">
                        <p>Any kind of wordpress website like business,portfolio,ecommerce-store,form,social media
                            website and much more.</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>

                <div class="service-items shadow">
                    <div class="flex items-center">
                        <i class="fas fa-code service-icons"></i>
                        <p class="service-name">Psd To Html</p>
                    </div>
                    <div class="service-content mt-3">
                        <p>Psd to html fully responsive design and user friendly using modern css framework which is
                            tailwind css and much more.</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>

                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fab fa-laravel service-icons"></i></a>
                        <p class="service-name">Laravel Website</p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>


                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fas fa-bug service-icons"></i></a>
                        <p class="service-name">Bug Fixing</p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>


                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="far fa-edit service-icons"></i></a>
                        <p class="service-name">Landing Page Design</p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>


                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fas fa-toolbox service-icons"></i></a>
                        <p class="service-name">Advance Form </p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>


                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fas fa-donate service-icons"></i></a>
                        <p class="service-name">Cost Calculator Form </p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>


                <div class="service-items shadow">
                    <div class="flex items-center">
                        <a href="#"><i class="fas fa-dollar-sign service-icons"></i></a>
                        <p class="service-name">Pricing Table </p>
                    </div>
                    <div class="service-content mt-3">
                        <p>This is service content div will add text then This is service content div will add text
                            then. Extra text</p>
                        <div class="service-action flex">
                            <button class="button">Get Service</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="category section-margin container-box items-center  border-b-2 border-gray-200">

            <div v-if="category.length"
                class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10 mx-20">
                <div v-for="category in category" :key="category.id" class="">
                    <div class="mb-2">
                        <div
                            class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-white  shadow-sm hover:shadow-sm">

                            <img :src="category.image" class="category-image">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                    Category name: {{category.name}}
                                </h1>
                                <router-link :to="{name: 'public-category-single', params: {slug: category.slug}}"
                                    class="btn btn-primary btn-block mt-3">View category</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Men</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Women</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                            <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about"
                                role="tab" aria-controls="nav-about" aria-selected="false">About</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                                       <div v-if="men.length"
                class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10 mx-20">
                <div v-for="post in men" :key="post.id" class="">
                    <div class="mb-2">
                        <div
                            class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-white  shadow-sm hover:shadow-sm">

                            <img :src="post.image" class="category-image">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                    Category name: {{post.title}}
                                </h1>
                                <router-link :to="{name: 'post-single', params: {slug: post.slug}}"
                                    class="btn btn-primary btn-block mt-3">View Post</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div v-if="women.length"
                class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10 mx-20">
                <div v-for="post in women" :key="post.id" class="">
                    <div class="mb-2">
                        <div
                            class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-white  shadow-sm hover:shadow-sm">

                            <img :src="post.image" class="category-image">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                    Category name: {{post.title}}
                                </h1>
                                <router-link :to="{name: 'post-single', params: {slug: post.slug}}"
                                    class="btn btn-primary btn-block mt-3">View Post</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            Et et consectetur ipsum labore excepteur est proident excepteur ad velit
                            occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim
                            pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua
                            ullamco irure incididunt irure non esse consectetur nostrud minim non minim
                            occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor
                            dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing
                            reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis
                            occaecat ex.
                        </div>
                        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                            Et et consectetur ipsum labore excepteur est proident excepteur ad velit
                            occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim
                            pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua
                            ullamco irure incididunt irure non esse consectetur nostrud minim non minim
                            occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor
                            dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing
                            reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis
                            occaecat ex.
                        </div>
                    </div>

                </div>
            </div>
        </div>





        <!-- Start about section-->

        <div id="about" class="about-section section-margin container-box items-center  border-b-2 border-gray-200"
            data-aos="fade-left">

            <div class="service-info-heading container-box text-center section-margin">
                <h1 class="heading before-after">About Me</h1>
            </div>

            <div class="about-inner section-margin">

                <div class="about-image"> <img src="http://development.rooberp.com/Devpappu/images/hero-1.png"
                        class="image-about" alt=""></div>

                <div class="about-content-items">
                    <h1 class="heading about-inf-title">Who I am</h1>
                    <p>let me introduce myself my name is Pappu from Dhaka Bangladesh web developer and digital
                        marketing expert I am working as a web developer expert and seo on the platform and playing
                        around with web-development
                    </p>
                    <div class="about-skills css-grid">

                        <div class="skill-items">
                            <h2 class="skill-label">Html & Css</h2>
                            <div class="skill">
                                <div class="w3-container value pl-10 skill-inner-text " style="width:95%">95%</div>
                            </div>
                        </div>

                        <div class="skill-items">
                            <h2 class="skill-label">Js</h2>
                            <div class="skill">
                                <div class="w3-container value pl-10 skill-inner-text" style="width:75%">75%</div>
                            </div>
                        </div>

                        <div class="skill-items">
                            <h2 class="skill-label">Php Laravel</h2>
                            <div class="skill">
                                <div class="w3-container value pl-10 skill-inner-text" style="width:60%">60%</div>
                            </div>
                        </div>

                        <div class="skill-items">
                            <h2 class="skill-label">Wordpress</h2>
                            <div class="skill">
                                <div class="w3-container value pl-10 skill-inner-text" style="width:80%">80%</div>
                            </div>
                        </div>

                    </div>

                    <div class="about-information css-grid items-center">
                        <div class="about-information-items shadow-inner">
                            <h3 class="about-info-text"> Name: Pappu Saha</h3>
                        </div>
                        <div class="about-information-items shadow-inner">
                            <h3 class="about-info-text"> Address: Dhaka</h3>
                        </div>
                        <div class="about-information-items shadow-sm">
                            <h3 class="about-info-text"> Phone: +8801629773987</h3>
                        </div>
                        <div class="about-information-items shadow-sm">
                            <h3 class="about-info-text"> Email: info@pappu.com</h3>
                        </div>
                    </div>


                </div>

            </div>

        </div>

        <!-- End service about--->
    </div>
</template>

<script>
import axios from 'axios'
    export default {

      data() {
          return {
              category:'',
              men:'',
              women:'',
          }
      },


     methods:{


         posts_of_catehory(){

             axios.get('/api/post/of/category').then(response=>{
                 this.men = response.data[0]
                 this.women = response.data[1]
            })

         }


     },

        mounted() {
            console.log('Home Component mounted.')
            axios.get('/api/home/category').then(response=>{
                this.category = response.data
            }),
            this.posts_of_catehory();
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
