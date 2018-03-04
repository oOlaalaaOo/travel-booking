<template>
    <div>
        <div class="row" v-if="pageLoading">
            <div class="col-sm-12 text-center">
                <h4 class="mt-5"><i class="fa fa-spinner fa-spin fa-2x"></i> &nbsp;&nbsp;&nbsp;Loading contents....</h4>
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm-4 mb-3" v-for="(tour, index) in tours">
                <div class="card" v-animate-css.once="'bounceIn'">
                    <div class="card-header text-right">
                        <a href="#" class="btn btn-info btn-sm" @click.prevent="view_tour(tour.id)"><i class="fa fa-wrench"></i></a>
                    </div>
                    <img class="card-img-top" :src="tour.main_image" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ tour.name }}</h5>
                        <p class="card-text" v-html="tour.description"></p>
                        <div class="text-right">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'tour-all',
        data() {
            return {
                tours: [],
                pageLoading: true
            }
        },
        created: function() {
            this.fetch()
        },
        methods: {
            fetch: function() {
                this.pageLoading = true
                axios.post('/admin/tour/all')
                    .then((resp) => {
                        this.tours = resp.data.tours
                        this.pageLoading = false
                    })
                    .catch((e) => {
                        this.pageLoading = false
                    })
            },
            view_tour: function(id) {
                window.location.href = '/admin/tour/show/' + id
            }
        }
    }
</script>
