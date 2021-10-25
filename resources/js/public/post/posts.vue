<template>

    <div class="main-comtent lg:mx-20 mx-10">

        <div v-if="Isloader == true" class="loader">
            <preloader></preloader>
        </div>

        <div v-else class="">
            <div class="relative  search-shorting mt-5">
                <div class="lg:flex justify-between bg-white items-centerrounded-sm shadow-sm px-3 py-6 align-items-center">

                    <div class="search flex form">
                        <div class="form">
                            <form>
                                <input type="text" v-model="search"
                                    class="bg-gray-200 rounded-sm mr-2 text-sm px-3 py-2" placeholder="Search...">
                            </form>
                        </div>
                    </div>

                    <div class="shorting ">
                        <div class="form">
                            <select v-model="form.shorting" @change="shorting" name="shorting" id="shorting">
                                <option value="" hidden selected>Sort by</option>
                                <option value="1">Popularity</option>
                                <option value="2">Latest</option>
                                <option value="3">Oldest</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="posts">
                <div v-if="posts.data.length"
                    class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10">
                    <div v-for="post in posts.data" :key="post.id" class="">
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

                <tbody v-else class="px-40 mt-20">
                    <tr >
                        <td colspan="6">
                            <h5 class="text-center mt-4 mb-4">No post Found.</h5>
                        </td>
                    </tr>
                </tbody>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                posts: {},
                Isloader: true,
                form: {
                    shorting: '',
                },
                search: '',
            }
        },
        methods: {

            // Our method to GET results from a Laravel endpoint
            loadPost(page = 1) {
                axios.get('/api/public/posts?page=' + page)
                    .then(response => {
                        this.posts = response.data;
                    })
                    .finally(() => this.Isloader = false)
            },

            shorting(event) {
                this.form.shorting = event.target.value
                this.Isloader = true
                axios.post('/api/posts/shorting', this.form).then(response => {
                        this.posts = response.data;
                    })
                    .finally(() => this.Isloader = false)
            },

            search_filter(searchvalue){
             axios.get('/api/post/search/'+searchvalue)
            .then(response =>{
                this.posts = response.data;
            })
           },
        },

        watch:{
        search(){
            this.search_filter(this.search);
            }
        },

        // computed:{

        //  livesearch(){
        //      return this.posts.data.filter(post => {
        //          return post.title.match(this.searchtext)
        //      });
        //  },

        // },

        mounted() {
            this.loadPost();
        },
    }
</script>

<style scoped>
.filter-btn{
    height: 37px;
}
</style>
