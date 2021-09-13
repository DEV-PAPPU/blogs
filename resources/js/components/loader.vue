<template>
    <div class="container loader">
        <div class="loader">
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
        <div class="inner_loader"></div>
    </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Preloader Component mounted.')
        }
    }
</script>

<style scoped>

.container.loader {
    position: absolute;
    top: 20%;
    left: 40%;
}
    .loader{
        background-color: #fff;
        width: 145px;
        height: 80px;
        margin: 50px auto 0;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        position: relative;
    }
    .loader .inner_loader{
        background-color: #EA2027;
        width: 10px;
        height: 20px;
        position: absolute;
        left: 15px;
        bottom: 15px;
        animation: loader 1.5s ease-out infinite;
    }
    .loader .inner_loader:nth-child(2){
        left: 30px;
        animation-delay: 0.4s;
    }
    .loader .inner_loader:nth-child(3){
        left: 45px;
        animation-delay: 0.8s;
    }
    .loader .inner_loader:nth-child(4){
        left: 60px;
        animation-delay: 1.2s;
    }
    .loader .inner_loader:nth-child(5){
        left: 75px;
        animation-delay: 0.6s;
    }
    .loader .inner_loader:nth-child(6){
        left: 90px;
        animation-delay: 0.4s;
    }
    .loader .inner_loader:nth-child(7){
        left: 105px;
        animation-delay: 1s;
    }
    .loader .inner_loader:nth-child(8){
        left: 120px;
        animation-delay: 0.8s;
    }
    @keyframes loader{
        0%{
            background-color: #EA2027;
            height: 30px;
        }
        15%{
            height: 40px;
            background-color: #b71540;
        }
        35%{
            background-color: #3742fa;
            height: 50px;
        }
        45%{
            background-color: #009432;
            height: 40px;
        }
        75%{
            background-color: #EE5A24;
            height: 30px;
        }
        100%{
            background-color: #EA2027;
            height: 20px;
        }
    }
</style>

