<template>
    <div class="pos_products">
        <tbody>

        </tbody>

        <div class="form">
            <form @submit.prevent="saleproduct">

                <input type="number" v-model="form.price" name="price" id="">

                <div class="form-group">
                    <label for="payment">Payment {{form.price}}</label>
                    <select v-model="form.payment_method" name="payment_method" id="payment_method"
                        class="form-control">
                        <option value="" style="display: none" selected>Select Payment Method </option>
                        <option value="0" selected>Hand Cash </option>
                        <option value="1" selected>Bkash</option>
                        <option value="2" selected>Rokect</option>
                        <option value="3" selected>Paypal</option>
                    </select>
                </div>


                <div v-if="paidFor">
                     <h1>Noice, you bought a beautiful lamp!</h1>
               </div>

               <div v-if="form.payment_method == 3">paypal</div>

                  <div  class="paypal-payment">
                      <div ref="paypal"></div>
                  </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  name: "HelloWorld",

  data: function() {
    return {
      loaded: false,
      paidFor: false,
      form:{
         payment_method: '',
         price:''
      },
      product: {
        price: 777.77,
        description: "leg lamp from that one movie",
      }
    };
  },
  mounted: function() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AdGH9Y0lFtkfPAw2gFkQRa12l1YJKEiZsQq89pnZxPNw3H2I_Bu4Uw0uUomQU0xd4jZQiv8P5DkSAuE1";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
  methods: {
    setLoaded: function() {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: this.product.description,
                  amount: {
                    currency_code: "USD",
                    value: this.form.price
                  }
                }
              ]
            });
          },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();
            this.paidFor = true;
            console.log(order);
          },
          onError: err => {
            console.log(err);
          }
        })
        .render(this.$refs.paypal);
    }
  },



        computed:{
            paypal(){
                 return this.form.payment_method
            },

        },
};
</script>
