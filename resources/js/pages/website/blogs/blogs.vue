<template>
        <div class="shop site-padding">
            <div v-if="blogs.length" class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10">
                <div v-for="blog in blogs" :key="blog.id" class="">
                    <div class="my-8">
                        <div
                            class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden  shadow-lg hover:shadow-2xl">

                            <img :src="blog.image" class="blog-image">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-1"> {{blog.title}}</h1>

                                <router-link :to="{name: 'blog-single', params: {slug: blog.slug}}"
                                    class="btn btn-primary btn-block mt-3">View blog</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <tbody v-else>
                <tr>
                    <td colspan="6">
                        <h5 class="text-center mt-4 mb-4">No blog Found.</h5>
                    </td>
                </tr>
            </tbody>
        </div>

</template>

<script>
export default {

    props:['blogs'],

    mounted() {
        console.log('Blog-Component Loaded')
    },
}
</script>

