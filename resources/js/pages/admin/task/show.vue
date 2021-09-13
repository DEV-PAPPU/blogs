<template>
        <div class="container">
                <div class="product">
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About</h3>
                                </div>
                                <div class="card-body">
                                    <div class="title">
                                        <h4>{{task.title}}</h4>
                                    </div>

                                    <div class="detail" style="width:400px">
                                        <h4 v-html="task.detail"></h4>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Info Topic</h3>
                                </div>
                                <div class="card-body">
                                    <div class="status">
                                        {{task.status}}
                                    </div>
                                    <div class="topic">
                                    {{task.topic}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</template>

<script>
   export default {
     data: () => ({
         task:{}
      }),
    methods: {
        loadTask(){
            let id = this.$route.params.id;
            axios.get(`/api/task/${id}`).then(response => {
                this.task = response.data;
            });
        },
    },
    mounted(){
        this.loadTask();
    }

    }
</script>

<style scoped>
</style>
