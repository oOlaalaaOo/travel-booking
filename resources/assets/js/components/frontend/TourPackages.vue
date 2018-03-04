<template>
    <div class="row">

        <div class="col-sm-4 mb-3" v-for="(tour, index) in tours">
            <div class="card" v-animate-css.once="'bounceIn'">
                <img class="card-img-top" :src="tour.main_image" style="height: 300px" :alt="tour.name">
                <div class="card-body">
                    <h5 class="card-title">{{ tour.name }}</h5>
                    <p v-html="tour.description"></p>
                    <div class="text-right">
                        <a href="#" class="btn btn-light" @click.prevent="view_tour(tour.id)"><i class="fa fa-search"></i> &nbsp;More Details</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'tour-packages',
        data() {
            return {
                tours: []
            }
        },
        created: function() {
            this.fetch()
        },
        methods: {
            fetch: function() {
                axios.post('/admin/tour/all')
                    .then((resp) => {
                        this.tours = resp.data.tours
                        console.log(resp.data)
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            view_tour: function(id) {
                window.location.href = '/tour-packages/' + id
            }
        }
    }
</script>
