<template>
    <div class="main">
        <div class="card">
            <div class="card-header">Search Filter</div>
            <div class="card-body">
                <div class="form">
                    <form class="d-flex">

                        <div class="form-group form-field">
                            <label for="customer_id">Customer</label>
                            <select v-model="form.customer_id" name="customer_id" id="customer_id" class="form-control">
                                <option value="" style="display: none" selected>Select Customer
                                </option>
                                <option value="0" selected>All Customers
                                </option>
                                <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                    {{customer.name}}
                                </option>
                            </select>
                        </div>

                        <div class="form-group form-field">
                            <label for="date_from">From</label>
                            <input type="date" v-model="form.date_from" name="date_from" class="form-control">
                        </div>

                        <div class="form-group form-field">
                            <label for="to_date">To</label>
                            <input type="date" v-model="form.to_date" name="to_date" class="form-control">
                        </div>
                        <VueLoadingButton aria-label="Post message" class="button btn btn-primary submit-btn"
                            @click.native="search_filter" :loading="isLoading" :styled="isStyled">Filter
                        </VueLoadingButton>
                        <button v-if="Isreset_btn == true" @click="reset()" class="btn btn-primary submit-btn reset-btn">Reset Filter</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import VueLoadingButton from 'vue-loading-button';

    export default {

        data() {
            return {
                isLoading: false,
                isStyled: false,
                Isdata: false,
                Isreset_btn: false,
                customers: '',
                filter_data: '',
                 form:{
                    customer_id: '',
                    date_from: '',
                    to_date: '',
            },
            }
        },

        components:{VueLoadingButton},

        methods:{
              search_filter(){
              this.isLoading = true
              this.isStyled = true
              axios.post('/api/pos/search', this.form)
             .then(response =>{
            this.filter_data = response.data;
            this.Isreset_btn = true
             this.$emit("search_filter", this.filter_data);

            })
            .catch(response => {
                if(response.status === 422){
                    console.log(response);
                }
            })
            .finally(() => this.isLoading = false)
          },

         reset(){
             this.$emit("reset_filter", this.Isdata)
             this.Isreset_btn = false
             this.form.customer_id = '',
             this.form.date_from = '',
             this.form.to_date = ''
         },

         },

        mounted() {
            axios.get('/api/users')
            .then(response =>{
                this.customers = response.data;
            });
            console.log('Filter Component mounted.')
        },

    }
</script>

<style scoped>
.form-field{
    margin-right: 10px;
}

button.btn.btn-primary.submit-btn {
    padding: 4px 40px !important;
    height: 40px !important;
    margin-top: 30px;
}

.reset-btn{
    margin-left: 10px;
}
</style>

