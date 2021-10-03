<template>
<!-- <div>hello kaka</div> -->
    <div class="loader-container" >
        <div class="white-overlady"></div>
        <div class="loader">  </div>
    </div>
</template>
<script>
export default {

}
</script>
<style  scoped>

    .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        top: 45%;
        position: absolute;
        left: 45%;

    }
    .white-overlady{
        background-color: rgba(255,255,255,0.5);
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>
