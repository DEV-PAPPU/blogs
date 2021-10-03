<template>
    <div class="">
        <div class="container">
            <div class="pos-div">
                <div class="product">
                    <div class="row">
                        <div class="col-7">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">All Products</h3>
                                </div>
                                <div class="card-body">
                                    <div class=" gap-10 row">
                                        <div v-for="product in products.data" :key="product.id" class=" col-3">
                                            <div>
                                                <img :src="product.image" class="product-image">
                                                <div class="p-6">
                                                    <h2
                                                        class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2">
                                                    </h2>
                                                    <p class="title-font text-center">
                                                        $ {{product.price}} <br>
                                                        {{product.title | trimproduct}}
                                                    </p>
                                                     <button @click="addproduct(product)" class="btn btn-primary btn-block mt-3">Add</button>
                                                    <!-- <a href="#"  @click="addSession(product)" class="btn btn-primary btn-block mt-3">Session</a> -->
                                                </div>
                                            </div>
                                        </div>

                                        <tfoot>
                                            <pagination :data="products" @pagination-change-page="loadProduct">
                                            </pagination>
                                        </tfoot>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                             <product :post_list="pos_list" v-on:add-User="user_form($event)" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import search from '../../pos//includes/search.vue'
import product from '../../pos/includes/pos_products.vue'

   export default {
     data: () => ({
         products: {},
         pos_list: [],

      }),

      components: { product, search},
        methods: {
         loadProduct(page = 1) {
            axios.get('/api/product?page=' + page)
                .then(response => {
                    this.products = response.data;
             });
        },

        addSession(product){

          axios.post('/api/pos/session', product)
                .then(() => {
                    console.log('ok')
             });

        },

         addproduct(product) {
            let product_check = this.pos_list.find((item)=>item.product_id === product.id);
              if(product_check){
                  product_check.qty++
              }
              else{
                let product_data = {
                product_id: product.id,
                price: product.price,
                title: product.title,
                image: product.image,
                qty: 1,
             };
             this.pos_list.unshift(product_data);
            }

        },


        },
        mounted(){
        this.loadProduct();
        },
    }
</script>

<style scoped>
.add-user-form {
    position: absolute !important;
    z-index: 9;
    width: 100%;
    right: -77px;
}
</style>



