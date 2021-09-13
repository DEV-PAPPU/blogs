<template>
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ALL Category</h3>
                    </div>
                    <!-- form start -->
                    <div class="card-body">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 100px"> Id </th>
                                        <th> Name </th>
                                        <th> Post Count </th>
                                        <th> Slug </th>
                                        <th style="width: 170px"> Action </th>
                                    </tr>
                                </thead>
                                <tbody v-if="categories.length">
                                    <tr v-for="category in categories" :key="category.id">
                                        <td style="width: 100px"> {{ category.id }} </td>
                                        <td> {{ category.name | strToUpper}} </td>
                                        <td> {{ category.post.length}} </td>
                                        <td> {{ category.slug }} </td>
                                        <td style="width: 170px">
                                            <router-link :to="{name: 'category-edit', params: {id: category.id}}"
                                                class="btn btn-primary btn-sm">Edit</router-link>
                                            <a @click.prevent="deleteCategory(category)" href="#"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4">
                                            <h5 class="text-center mt-4 mb-4">No categories found.</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: {},
        }
    },
    methods: {
        loadCategories(){
            axios.get('/api/category').then(response => {
                this.categories = response.data;
            });
        },
        deleteCategory(category){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                axios.delete(`/api/category/${category.id}`)
                let index = this.categories.indexOf(category);
                this.categories.splice(index, 1);

                   Swal.fire(
                    'Deleted!',
                    'Category Deleted.',
                    'success'
                    )
                }
                })
        }
    },

     mounted(){
        this.loadCategories();
        },
}
</script>

