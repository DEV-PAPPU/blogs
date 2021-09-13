<template>

    <div class="main-comtent">

        <div v-if="Isloader == true" class="loader">
            <preloader></preloader>
        </div>

        <div v-else class="">
            <div class="posts">
                <div v-if="posts.length"
                    class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10 shop py-10 mx-20">
                    <div v-for="post in posts" :key="post.id" class="">
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
            }
        },
        methods: {

            loadPost(){
            let slug = this.$route.params.slug;
            axios.get(`/api/category/single/${slug}`).then(response => {
                this.posts = response.data;

            })
            .finally(() => this.Isloader = false)
           },

        },

        mounted() {
            this.loadPost();
        },
    }
</script>
