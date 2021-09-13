<template>
    <div class="">
        <div class="container">
            <div class="pos-div">
                <div class="product">
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Billing Info</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th> Pay </th>
                                                <th> Due </th>
                                                <th> SubTotal </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="customer in pos_billing" :key="customer.id">
                                                <td> {{ customer.user.name | strToUpper}} </td>
                                                <td> {{ customer.pay | currency}} </td>
                                                <td style="width: 200px">

                                                    <span v-if="new_pay.length">
                                                        <del>{{ customer.due | currency}}</del>
                                                        {{new_due | currency}}
                                                    </span>

                                                 <span v-else-if="customer.due == new_pay" class="badge badge-success">Paid</span>
                                                 <span v-else-if="new_due == 0" class="badge badge-success">Paid</span>

                                                 <span v-else >{{ customer.due | currency}}</span>

                                                </td>
                                                <td> {{subtotal | currency}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">All Products</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Product </th>
                                                <th> Qty </th>
                                                <th> Price </th>
                                                <th> Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="product in products" :key="product.id">
                                                <td> {{ product.product.title }} </td>
                                                <td> {{ product.qty }} </td>
                                                <td> {{ product.price | currency}} </td>
                                                <td> {{ product.price * product.qty | currency}} </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                           <h5>SubTotal : <span class="badge badge-success"> {{subtotal | currency}}</span></h5>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product Info</h3>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="update">
                                        <div class="form-group">
                                            <label for="user-name">Customer Name :{{pos_billing[0].user.name | strToUpper}} </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment">Payment</label>
                                            <select v-model="form.payment_method" name="payment_method"
                                                id="payment_method" class="form-control">
                                                <option value="" style="display: none" selected>Select Payment Method
                                                </option>
                                                <option value="0" selected>Hand Cash </option>
                                                <option value="1" selected>Bkash</option>
                                                <option value="2" selected>Rokect</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Pay Now</label>
                                            <input type="number" v-model="form.pay" name="pay" class="form-control">
                                        </div>

                                        <div v-if="form.pay.length">
                                            <h4>New Due <span id="due">{{new_due | currency}}</span></h4>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import product from '../../pos/includes/pos_products.vue'
//  import Form from 'vform'

    export default {

        data() {
            return {
                pos_billing:{},
                products:{},
                    form:{
                    pay: '',
                    due: '',
                    payment_method: '',
                },

                old_due: '',
                old_pay: ''
            }
        },
         components: { product},

        methods:{

            loadpos(){
            let id = this.$route.params.id;
            axios.get(`/api/pos/${id}/edit`).then(response => {
                this.pos_billing = response.data[0];
                let form = response.data[0];
                this.old_due = form[0].due
                this.old_pay = form[0].pay
                this.products = response.data[1];
            });
          },

            update(){
            this.form.due = this.new_due
            let id = this.$route.params.id;
            axios.put(`/api/pos/${id}`, this.form).then(response => {
                Toast.fire({
                    icon: 'success',
                    title: 'Updated Success'
                })
                console.log(response)
            });
          },

        },
        computed:{

            subtotal(){
                 return this.products.reduce((a,b) => a+ (b.price * b.qty), 0)
            },

            new_pay(){
                 return this.form.pay
            },

            new_due(){
                 return  this.old_due - this.new_pay
            },

        },
        mounted() {

            this.loadpos();
        }
    }
</script>
