<template>
    <div class="container mt-24">

        <div class="product-single lg:flex md:flex">
            <div class="col-md-4">
                <div class="image">
                    <img class="object-center  shadow product-img w-1/4" :src="product.image" alt="blog">
                </div>
            </div>
            <div class="col-md-8">
                <div class="content">
                    <h1 class="product-title pb-8">{{ product.title }}</h1>
                    <h3 class="text-padding">Price $ {{ product.price }}</h3>
                    <div class="stock text-padding">
                        <h5>Availability :
                            : {{ product.quantity }} <br>
                        </h5>
                    </div>

                    <div class="qty flex">
                        <p class="pr-2 qty-text">Qty</p><input type="number" v-model="add_to_cart.product_quantity" name="product_quantity" class="quantity" @change="updateQuantity"
                            min="1" :max="product.quantity" placeholder="1"> <br>
                    </div>
                    <div class="total text-padding">
                        Total : {{ total }}
                    </div>
                    <h1 class="text-padding">Category: {{ product.category.name }}</h1>
                    <button @click.prevent="AddToCart(product)" class="btn btn-primary mt-3">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

   export default {
    data(){
        return {
            product: [],
            total: 0,
            add_to_cart: {
                quantity: '',
                product_id:'',
                product_title:'',
                product_image:'',
                price:'',
            },
        }
    },

    methods: {

        loadproduct(){
            let slug = this.$route.params.slug;
            axios.get(`/api/product-single/${slug}`).then(response => {
                this.product = response.data;
                console.log(response.data);
            });
        },

        AddToCart(product) {
                this.$store.commit('ADD_TO_CART', product);
                 Toast.fire({
                    icon: 'success',
                    title: 'Product Added'
                });
                // this.add_to_cart.product_id = product.id;
                // this.add_to_cart.product_title = product.title;
                // this.add_to_cart.product_image = product.image;
                // this.add_to_cart.price = product.price;

        },

        updateQuantity(event) {
        this.total = event.target.value
        this.total = this.total * this.product.price
      },
    },
    mounted(){
        this.loadproduct();
    }

    }
</script>

<style scoped>
.btn-primary{
padding: 10px 35px !important;
}

.product-title{
    font-size: 23px;
    font-weight: 800;
}


.product-single {
    justify-content: center !important;
    align-items: center;
}

.text-padding{
    padding: 10px;
font-size: 18px;
font-weight: 500;
}
.quantity{
    width: 55px;
    padding: 5px 15px;
}


.qty {
   width: 120px;
    background: #f0f0f0;
    padding: 10px 11px 9px 14px;
    border-radius: 0;
    margin-right: 10px;
    align-items: center;
}
.qty-text{
    font-weight: 100 !important;
}
</style>



