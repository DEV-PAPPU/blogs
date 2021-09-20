<template>
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{title}}</h3>
            </div>
            <div class="card-body">
                <div class=" gap-10 row">

                 <slot></slot>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:['title'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

