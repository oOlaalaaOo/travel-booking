<template>
    <div class="row">
        
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="tour_package" v-model="tour_package" class="form-control" placeholder="Enter tour package name here.." @keyup.enter="searchTourPackage" />
            </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-3" v-for="(tour, index) in tours">
            <div class="card" v-animate-css.once="'bounceIn'">
                <a href="#" @click.prevent="view_tour(tour.id)">
                    <img class="card-img-top" :src="tour.main_image" style="height: 300px" :alt="tour.name">
                </a>
                <div class="card-body">
                    <h4 class="card-title">{{ tour.name }}</h4>
                    <h5 class="card-title">{{ formatDate(tour.from_date) }} - {{ formatDate(tour.to_date) }}</h5>
                    <p v-html="tour.description_quick"></p>
                    <div class="text-right">
                        <a href="#" class="btn btn-light" @click.prevent="view_tour(tour.id)"><i class="fa fa-search"></i> &nbsp;More Details</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        name: 'tour-packages',
        data() {
            return {
                tours: [],
                tour_package: ''
            }
        },
        created: function() {
            this.fetch()
        },
        methods: {
            fetch: function() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/tour/all')
                    .then((resp) => {
                        this.tours = resp.data.tours
                        console.log(resp.data)
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            view_tour: function(id) {
                window.location.href = 'https://travelbooking2018.000webhostapp.com/public/tour-packages/' + id
            },
            formatDate(date) {
                return moment(date).format('MMMM DD, YYYY')
            },
            searchTourPackage() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/tour/search', {
                    tour_package: this.tour_package
                })
                .then(resp => {
                    console.log(resp)
                    this.tours = resp.data.tours
                })
                .catch(err => {
                    console.log(err)
                })
            }

        }
    }
</script>
