<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Login</div>

                    <div class="card-body">

                        <form @submit.prevent="login">
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
          password: ''
      }),

      }),
        methods: {
           login() {
                this.form.post('/login').then(({ response }) => {
                  console.log(response)
                    this.form.reset();
                    Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                    }),
                   console.log("login done")
                })
            },

        },
    }
</script>



