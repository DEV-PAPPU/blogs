<template>
    <div class="container">

        <div class="filter">
            <searchfilter v-on:search_filter="filter_data($event)" v-on:reset_filter="reset_filter($event)" />
        </div>
        <div class="card">
            <div class="card-header">All Pos Lists</div>
            <div class="card-body">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th style="width: 100px"> Id </th> -->
                                <th> Customer Name </th>
                                <th> Pay </th>
                                <th> Due </th>
                                <th> Subtotal </th>
                                <!-- <th> Date </th> -->
                                <th style="width: 170px"> Action </th>
                            </tr>
                        </thead>
                        <tbody v-if="pos_order.data.length">
                            <tr v-for="pos in pos_order.data" :key="pos.id">
                                <td>{{ pos.user.name | strToUpper}} </td>
                                <td>{{ pos.pay | currency}} </td>
                                <td>
                                  <span v-if="pos.due == 0" class="badge badge-success">Paid</span>
                                  <span v-else class="badge badge-primary">{{ pos.due | currency}} </span>
                               </td>
                                <td>{{ pos.subtotal | currency}} </td>
                                <td style="width: 170px">
                                    <router-link :to="{name: 'pos-edit', params: {id: pos.id}}" class="btn btn-primary btn-sm">
                                        View</router-link>
                                    <a @click.prevent="Deletepos(pos)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <tfoot>
                            <pagination :data="pos_order" @pagination-change-page="loadpos"></pagination>
                        </tfoot>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center mt-4 mb-4">No pos found.</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import searchfilter from '../../pos//includes/search.vue'
export default {
   data() {
       return {
           pos_order:{},
           search_data:{},
       }
   },

         components: {searchfilter},

    methods: {

          // Our method to GET results from a Laravel endpoint
        loadpos(page = 1) {
            axios.get('/api/pos?page=' + page)
                .then(response => {
                    this.pos_order = response.data;
                });
        },

        filter_data(event){
            this.pos_order = event
        },

        reset_filter(){
            this.loadpos()
        },


        Deletepos(pos){
         const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

              swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/pos/${pos.id}`)
                   let index = this.pos_order.data.indexOf(pos);
                   this.pos_order.data.splice(index, 1);
                    swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                    )
                }
            })
        }
    },

        mounted(){
        this.loadpos();
        },


}
</script>

