<template>
    <div>
        <vue-chart
            :columns="columns"
            :rows="rows"
            :options="options"
        ></vue-chart>
    </div>
</template>

<script>
    export default {
        name: 'report',
        data() {
            return {
                columns: [{
                    'type': 'string',
                    'label': 'Date'
                }, {
                    'type': 'number',
                    'label': 'All'
                }, {
                    'type': 'number',
                    'label': 'Confirmed'
                }, {
                    'type': 'number',
                    'label': 'Payed'
                }, {
                    'type': 'number',
                    'label': 'Pending'
                }],
                rows: [],
                options: {
                    title: 'Bookings Report',
                    hAxis: {
                        title: 'Year',
                    },
                    vAxis: {
                        title: 'Bookings Count',
                    },
                    width: 700,
                    height: 400,
                    curveType: 'function'
                }
            }
        },
        created: function() {
            this.bookings()
        },
        methods: {
            bookings() {
                axios.get('https://travelbooking2018.000webhostapp.com/public/admin/report/bookings')
                .then(resp => {
                    console.log(resp)
                    var dates = resp.data.dates
                   
                    dates.forEach((d) => {
                        this.rows.push([d.days, resp.data.all[d.days], resp.data.confirmed[d.days], resp.data.payed[d.days], resp.data.pending[d.days]])
                        
                    })
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>