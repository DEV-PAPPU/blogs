<template>
    <div class="container content">
            <p class="item"> <i class="fa fa-align-justify handle"></i> {{item.title}}</p>
    </div>
</template>

<script>
    export default {
        props:['item'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style  scoped>
.item{
    padding: 4px 10px;
    border: 1px solid #d3d3d3;
    border-radius: 3px;
    background: #F4F6F9;
    cursor: pointer;
}
</style>

