<template>
    <div class="container mt-10">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Sign UP!</div>

                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div>
                                <input type="name" v-model="form.name" name="name" class="form-control"
                                    placeholder="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                            </div><br>

                            <div>
                                <input type="email" v-model="form.email" name="email" class="form-control"
                                    placeholder="email" :class="{ 'is-invalid': form.errors.has('email') }">
                                <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                            </div><br>

                            <div>
                                <input type="password" v-model="form.password" name="password" class="form-control"
                                    placeholder="password" :class="{ 'is-invalid': form.errors.has('password') }">
                                <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                            </div><br>

                            <div>
                                <input type="password" v-model="form.password_confirmation" name="password_confirmation" class="form-control"
                                    placeholder="password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                                <div v-if="form.errors.has('password_confirmation')" v-html="form.errors.get('password_confirmation')" />
                            </div><br>

                            <br>
                            <button type="submit" class="nav-link btn btn-lg btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

 import Form from 'vform'
   export default {

     data: () => ({
        form: new Form({
          email: '',
          name: '',
          password: '',
          password_confirmation: ''
      }),

      }),
        methods: {
           login() {
                this.form.post('/register').then(({ response }) => {
                  console.log(response)
                    this.form.reset();
                    this.$router.push({name:'singing'});
                   console.log("ok")
                })
            },

        },
    }
</script>



