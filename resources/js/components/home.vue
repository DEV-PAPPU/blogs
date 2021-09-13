<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pappu Component</div>

                    <div class="card-body">
                        I'm an New component.
                        {{categories}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:['categories'],
        mounted() {
            console.log('Home Component mounted.')
        }
    }
</script>
