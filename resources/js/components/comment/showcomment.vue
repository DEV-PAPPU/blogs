<template>
    <div class="post-comment-show">
        <div class="card">
            <div class="card-header">Post Comments</div>
            <div class="card-body">
                <!-- <a href="#" @click.prevent="loadcomment">Show Comments</a> -->
                <div v-if="comments.length" class="comment-content">
                    <div v-for="comment in comments" :key="comment.id">
                        <h6 class="user-name">Name : {{ comment.name }}</h6>
                        <p class="user-name">{{ comment.comment }}</p>
                    </div>
                </div>
                <tbody v-else>
                    <tr>
                        <td colspan="4">
                            <h5 class="text-center mt-4 mb-4">No Comment found.</h5>
                        </td>
                    </tr>
                </tbody>
            </div>
        </div>
    </div>
</template>
<script>
   export default {
    props:['comments'],
    }
</script>

<style scoped>
.user-name{
    text-transform: capitalize !important;
}
</style>

