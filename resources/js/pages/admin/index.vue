<template>
<div class="admin-home">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{post}}</h3>
                    <p>Total Posts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

                <router-link :to="{name: 'all-post'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <router-link :to="{name: 'all-post'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{user}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <router-link :to="{name: 'all-users'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{comment}}</h3>

                    <p>Post Comments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <router-link :to="{name: 'post-comments'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
</template>

<script>
import axios from 'axios'

    export default {
       data() {
           return {
               post: {},
               comment: {},
               user: {}
           }
       },


       mounted() {
           axios.get('/api/admin/home').then(response =>{
           this.post = response.data[0];
           this.comment = response.data[1];
           this.user = response.data[2];
        });
        },

    }
</script>
