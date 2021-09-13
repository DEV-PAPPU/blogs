<template>
    <div class="container">
        <div class="">
            <div class="">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">All comments Lists
                     <a @click="loadcomment()" href="#" class="btn btn-primary btn-sm">Refresh</a>
                    </div>

                    <div class="card-body">
                        <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th style="width: 100px"> Id </th> -->
                                    <th> Name</th>
                                    <th> Email </th>
                                    <th> Post Name </th>
                                    <th> Status </th>
                                    <!-- <th> Date </th> -->
                                    <th style="width: 170px"> Action </th>
                                </tr>
                            </thead>
                            <tbody v-if="comments.length">
                                <tr v-for="comment in comments" :key="comment.id">
                                    <td> {{ comment.name | strToUpper}} </td>
                                    <td> {{ comment.email }} </td>
                                    <td> {{ comment.post.title | trim}} </td>
                                     <td>
                                        <span v-if="comment.status == 0" class="badge badge-success">Approved</span>
                                        <span v-else class="badge badge-primary">Pending</span>
                                    </td>
                                    <td style="width: 170px">
                                        <router-link :to="{name: 'post-comments-edit', params: {id: comment.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                        <a @click.prevent="Deletecomment(comment)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4">
                                        <h5 class="text-center mt-4 mb-4">No Comment found.</h5>
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
           comments:{}
       }
   },

    methods: {

        loadcomment(){
            axios.get('/api/comment')
            .then(response =>{
                this.comments = response.data;
                console.log(response);
            });
          },

        Deletecomment(comment){
          axios.delete(`/api/comment/${comment.id}`).then(() => {

              Toast.fire({
                    icon: 'success',
                    title: 'Comment Deleted Success'
                    }),
                   console.log("Comment Deleted Success")

            });

            let index = this. comments.indexOf(comment);
            this. comments.splice(index, 1);
        }
    },

        mounted(){
        this.loadcomment();
        },
}
</script>

