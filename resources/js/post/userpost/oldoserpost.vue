<template>
    <div class="container">
        <div class="">
            <div class="">
                <div class="card">

                    <div class="card-header">All posts Lists</div>

                    <div class="card-body">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 100px"> Id </th> -->
                                        <th> Title </th>
                                        <th> Category </th>
                                        <th> Status </th>
                                        <!-- <th> Date </th> -->
                                        <th style="width: 170px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody v-if="user_posts.length">
                                    <tr v-for="post in user_posts" :key="post.id">
                                        <td> {{ post.title }} </td>
                                        <td> {{ post.category.name }} </td>
                                        <td>
                                            <span v-if="post.status == 0" class="badge badge-success">Publish</span>
                                            <span v-else class="badge badge-warning">Draft</span>
                                        </td>
                                        <!-- <td> {{ post.create_at }} </td> -->
                                        <td style="width: 170px">
                                            <!-- <router-link :to="{name: 'user-post-edit', params: {id: post.id}}"
                                                class="btn btn-primary btn-sm">Edit</router-link> -->
                                            <a @click.prevent="Deletepost(post)" href="#"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4">
                                            <h5 class="text-center mt-4 mb-4">No post found.</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

   data() {
       return {
           user_posts:{}
       }
   },

    methods: {

        loadPost(){
            axios.get('/api/posts')
            .then(response =>{
                this.user_posts = response.data;
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
        },
}
</script>

