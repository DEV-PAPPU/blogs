<template>
    <div class="site-content lg:mx-20 mt-20 mx-10">
       <div v-if="Isloader == true" class="loader">
           <preloader></preloader>
        </div>

        <div v-else class="">
        <div class="lg:grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2 gap-10">

            <div class="post-detail">
                <div class="post-image">
                    <img :src="post.image" class="blog-image">
                </div>
                <div class="date lg:flex md:flex bg-white px-3 py-2 mt-3 rounded-sm shadow-sm border-dotted border-4 border-blue-1000">
                    <div class="flex">
                        <p class="mt-3">Post Publish Date : {{ post.created_at | dateformat}}</p>
                        <p class="mt-3 ml-5">View : {{ post.view_count}} Times</p>
                    </div>

                    <div class="flex ml-5 mt-3">
                        <a href=" https://www.facebook.com/sharer.php?u={fb}" target="_blank">Facebook Share</a>
                    </div>
                </div>

                <div class="bg-white rounded-sm shadow-sm py-1 px-4 mt-5 mb-5">
                    <h4 class="title mt-5"> {{post.title}}</h4>
                    <div class="mt-3 mb-5">
                        <h5>Post Description</h5><br>
                        <p class="description "><span v-html="post.description"></span></p>
                    </div>
                </div>

                <div class="comment-box">
                    <comment :post_id="post.id" />
                </div>

                <div class="my-10 show-comment">
                    <showcomment :comments="comments" />
                </div>
            </div>
            <div class="related-post">

                <!-- <div class="related-header bg-black text-center pt-2 pb-1 text-white mb-2 btn-primary">
                    <p>Related Blogs</p>
                </div> -->
                <div v-for="post in related_post" :key="post.id" class="">
                    <div class="mb-8">
                        <div
                            class="border-2 border-gray-200 border-opacity-60 rounded-lg bg-white overflow-hidden  shadow-sm hover:shadow-sm">
                            <img :src="post.image" class="post-image">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-1"> {{post.title | trimpost}}
                                </h1>
                                <a :href="post.slug" @click="get_related_post(post)" class="btn btn-primary btn-block mt-3">View post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</template>
<script>
import comment from '../../components/comment/comment.vue'
import showcomment from '../../components/comment/showcomment.vue'
   export default {
    data(){
        return {
            post: [],
            related_post: [],
            comments: [],
            fb: '',
            Isloader: true,
        }
    },

    components:{
        comment, showcomment
    },

    methods: {

        loadpost(){
            let slug = this.$route.params.slug;
            axios.get(`/api/post-single/${slug}`).then(response => {
                this.post = response.data[0];
                this.related_post = response.data[1];
                this.comments = response.data[2];
            })
            .finally(() => this.Isloader = false)
        },

        url(){
            this.fb = location.href

        },

        get_related_post(payload){
         location.href = payload.slug
         this.post = payload

        },


    },
    mounted(){
        this.loadpost();
        this.url();

    },

    }
</script>

<style scoped>
@media only screen and (max-width: 4000px) and (min-width: 1150px)  {

    .post-detail {
    width: 800px !important;
}

.related-post {
    width: 300px !important;
    margin-left: 270px;
}

}
</style>



