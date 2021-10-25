<template>
    <div class="pos_products">
        <div v-if="Isform == true" class="add-user-form">
           <adduserfrom v-on:close="close()"/>
        </div>

        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Product Info</h3>
                <a href="javascript:void(0);" @click="addUser()" class="btn btn-success btn-sm">Add User</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <!-- <th style="width: 100px"> Id </th> -->
                            <th style="width: 150px">Product</th>
                            <th> Qty</th>
                            <th>Subtotal</th>
                            <!-- <th> Date </th> -->
                            <th style="width: 170px"> Action </th>
                        </tr>
                    </thead>

                    <tbody v-if="post_list.length">
                        <tr v-for="product in post_list" :key="product.id" class="product-titms">
                            <td style="width: 150px"> {{ product.title }} </td>
                            <td style="width: 50px">

                                <div class="d-flex">
                                    <a @click="decrement(product)" href="javascript:void(0);" class="btn btn-danger btn-sm">
                                        <i class="las la-caret-left"></i>
                                    </a>
                                    <input type="text" @change="changeqty(product)" :value="product.qty" readonly
                                        class="qty">

                                    <a @click="increment(product)" href="javascript:void(0);" class="btn btn-danger btn-sm">
                                        <i class="las la-caret-right"></i>
                                    </a>
                                </div>

                            </td>
                            <td>$ {{ product.price * product.qty }} </td>
                            <td><a @click="removeitem(product)" href="javascript:void(0);" class="btn btn-danger btn-sm">
                                    <i class="las la-trash-alt icon"></i>
                                </a></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="4">
                                <h5 class="text-center mt-4 mb-4">No Items.</h5>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="cal">

                    <div v-if="post_list.length" class="total"> Subtotal {{total | currency}}</div>

                    <div v-if="post_list.length" class="form">
                        <form @submit.prevent="saleproduct">
                            <div class="form-group">
                                <label for="user_id">Customer Name</label>
                                <select v-model="form.user_id" name="user_id" id="user_id" class="form-control">
                                    <option value="" style="display: none" selected>Select Customer
                                    </option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}
                                    </option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="payment">Payment</label>
                                <select v-model="form.payment_method" name="payment_method" id="payment_method"
                                    class="form-control">
                                    <option value="" style="display: none" selected>Select Payment Method </option>
                                    <option value="0" selected>Hand Cash </option>
                                    <option value="1" selected>Bkash</option>
                                    <option value="2" selected>Rokect</option>
                                    <option value="3" selected>Stripe</option>
                                </select>
                            </div>

                            <div v-if="form.payment_method.length">
                                <div class="form-group">
                                    <label for="title">Pay</label>
                                    <input type="number" v-model="form.pay" name="pay" class="form-control">
                                </div>

                                <h4>Total Due <span id="due">{{total - pay | currency}}</span></h4>

                                <div class="form-group">
                                    <input type="hidden" v-model="form.due" name="due" :placeholder="total - pay"
                                        class="form-control" readonly>
                                </div>
                            </div>


                            <div v-if="form.payment_method == 3" class="paypal-payment">
                                <div class="stripe-form">
                                    <div class="panel-body">
                                        <div v-if="stripeerrors.length">
                                            {{stripeerrors}}
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                CARD NUMBER</label>
                                            <div class="input-group">
                                                <input type="text" v-model="stripe.cart_number" name="cart_number"
                                                    class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                                    required autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>

                                        <div class="form-group d-flex">
                                            <div class="exriry stripe-field">
                                                <label for="cardNumber">EXPIRY DATE</label>
                                                <div class="input-group">
                                                    <input type="number" v-model="stripe.exp_month" name="exp_month"
                                                        class="form-control " id="expityMonth" placeholder="MM"
                                                        required />
                                                    <input type="number" style="margin-left: 6px"
                                                        v-model="stripe.exp_year" name="exp_year"
                                                        class="form-control stripe-field" id="expityMonth"
                                                        placeholder="YY" required />
                                                </div>
                                            </div>

                                            <div class="cvc stripe-field">
                                                <label for="cardNumber">CVC</label>
                                                <div class="input-group">
                                                    <input type="text" v-model="stripe.cvc" name="stripe.exp_cvc"
                                                        class="form-control stripe-field" id="expityMonth"
                                                        placeholder="ex. 311" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>
</template>

<script>
import adduserfrom from '../../pos/includes/adduser.vue'

    export default {

        props:['post_list'],

        data() {
            return {
                users: {},
                loaded: false,
                paidFor: false,
                Isform: false,
                 qform:{
                     pqty: '',
                 },
                form:{
                    user_id: '',
                    pay: '',
                    due: '',
                    payment_method: '',
                },
                stripe:{
                    cart_number: '',
                    exp_month: '',
                    exp_year: '',
                    cvc: '',
                },
                stripeerrors:'',
                remove:'',
            }
        },

        components: {adduserfrom},

        methods:{

           loadUser(){
            axios.get('/api/users')
            .then(response =>{
                this.users = response.data;
            });
          },

           saleproduct(){
               let product = this.post_list;
               let form = this.form;
               let stripe = this.stripe;
               this.form.due =  this.due;
            axios.post('/api/pos',[product, form, stripe])
            .then(response =>{
                console.log(response);
                this.post_list = ''
                    Toast.fire({
                    icon: 'success',
                    title: 'Done !:)'
                })
            })
         .catch(e => {this.stripeerrors = e.response.data['message']});

          },

          removeitem(product){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
            if (result.isConfirmed) {
              this.post_list.splice(product, 1);
                Swal.fire(
                'Removed!',
                'Item has been removed.',
                'success'
                )
            }
            })
          },

          increment(product){
               this.post_list.find((item) => {
               if( item.product_id === product.product_id){
                   item.qty++
                }
                })
          },

          decrement(product){
               this.post_list.find((item) => {
               if( item.product_id === product.product_id){
                   if(item.qty == '1'){
                       alert('minimum 1 qty required')
                   }
                   else{
                       item.qty--
                   }
                }
                })
          },

          addUser(){
            this.Isform = true
          },

        close(){
            this.Isform = false
         }

        },

        computed:{

            total(){
                 return this.post_list.reduce((a,b) => a+ (b.price * b.qty), 0)
            },

            pay(){
                 return this.form.pay
            },

            due(){
                 return this.total - this.pay
            }

        },

        mounted() {
            this.loadUser();
        }
    }
</script>

<style scoped>
input.qty {
    width: 40px;
    margin: 0px 8px;
    padding: 0px 5px;
}

.total {
    text-align: right;
    margin-top: 6px;
    margin-right: 51px;
}

.stripe-field{
    padding: 0px 3px;
}

.add-user-form {
    position: absolute !important;
    z-index: 9;
    width: 100%;
    right: -77px;
}
</style>
