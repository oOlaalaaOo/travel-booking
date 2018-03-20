<template>
    <div>
        <div class="row">
            
            <div class="col-sm-7">
                <div class="card">
                    <img class="card-img-top" :src="tour.main_image" alt="Card image cap" style="height: 400px">
                    <div class="card-body">
                        <button class="btn btn-danger btn-block" v-b-modal.booking><i class="fa fa-calendar"></i> Book this</button>
                        <br />
                        <div class="row">
                          
                            <vue-images :imgs="tour.photos"
                                        :modalclose="modalclose"
                                        :keyinput="keyinput"
                                        :mousescroll="mousescroll"
                                        :showclosebutton="showclosebutton"
                                        :showcaption="showcaption"
                                        :imagecountseparator="imagecountseparator"
                                        :showimagecount="showimagecount"
                                        :showthumbnails="showthumbnails">
                            </vue-images>
                        </div>
                        <hr>
                        <h4 class="card-title">{{ tour.name }}</h4>
                        <h5 class="card-title">{{ formatDate(tour.from_date) }} - {{ formatDate(tour.to_date) }}</h5>
                        <span class="card-text" v-html="tour.description"></span>
                        
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
              <div class="card mb-3">
                <div class="card-body">
                  <h4 class="card-title">Tour Package Details: </h4>
                  <hr>
                  <h5 class="card-title">Prices</h5>
                  <ul class="list-group">
                    <li class="list-group-item" v-for="(price, index) in prices" :key="price.id">
                      <strong>Price: {{ price.price }}</strong> <br />
                      Price Type: [{{ price.type }}] <br />
                      Capacity Type: [{{ price.capacity_type }}] <br />
                      Capacity: [{{ price.capacity }}] <br />
                    </li>
                  </ul>
                  <br />
                  <h5 class="card-title">Destinations</h5>
                  <ul>
                    <li v-for="(des, index) in destinations" :key="des.id">{{ des.address }}</li>
                  </ul>
                  <br />
                  <h5 class="card-title">Notes</h5>
                  <p class="card-text" v-html="tour.notes"></p>
                  <br />
                  <h5 class="card-title">Inclusions</h5>
                  <p class="card-text" v-html="tour.inclusions"></p>
                </div>
              </div>
            </div>
            
        </div>
        <br />

        <b-modal id="booking" ref="booking" hide-footer size="lg" centered :title="tour.name">
            <form @submit.prevent="submitBooking">
                <div class="form-group">
                    <div class="form-group">
                        <p><strong>Note:</strong> <small>Please be careful in entering your email address because that email where we will send the details on how to pay for your booking.</small></p>
                    </div>
                    <label>Travel Date</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <datepicker input-class="form-control" :disabled="disabled" v-model="selectedDate"></datepicker>
                        </div>
                        <!-- <div class="col-sm-2">
                            <select 
                            class="form-control" 
                            name="month" 
                            v-model="month" 
                            v-validate="'required'" 
                            :class="{'input': true, 'is-invalid': errors.has('month') }" :disabled="disabled">
                                <option value="">Month</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sept</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ errors.first('month') }}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <select
                            class="form-control" 
                            name="day" 
                            v-model="day" 
                            v-validate="'required'" 
                            :class="{'input': true, 'is-invalid': errors.has('day') }">
                                <option value="">Day</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ errors.first('day') }}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <select 
                            class="form-control" 
                            name="year" 
                            v-model="year" 
                            v-validate="'required'" 
                            :class="{'input': true, 'is-invalid': errors.has('year') }">
                                <option value="">Year</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ errors.first('year') }}
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="form-group">
                    <label>Travel Option</label>
                    <select 
                    class="form-control"
                    name="travel_options"
                    v-model="travel_options"
                    v-validate="'required'"
                    :class="{'input': true, 'is-invalid': errors.has('travel_options') }">
                        <option value="">Options</option>
                        <option v-for="price in prices" :value="price.id">
                            <span v-if="price.capacity_type == 'group'">
                            {{ price.price + ' good for ' + price.capacity + ' person' }}
                            </span>
                            <span v-else>
                            {{ price.price + ' per person' }}
                            </span>
                        </option>
                    </select>
                    <div class="invalid-feedback">
                                {{ errors.first('travel_options') }}
                            </div>
                </div>
                <hr>
                <h5>Personal Details</h5>
                <div class="form-group">
                    <label>Your Name:</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <input
                              type="text"
                              class="form-control"
                              id="firstname"
                              name="firstname"
                              v-model="firstname"
                              v-validate="'required'"
                              :class="{'input': true, 'is-invalid': errors.has('firstname') }" 
                              placeholder="First Name"
                              >
                              <div class="invalid-feedback">
                                {{ errors.first('firstname') }}
                              </div>
                        </div>
                        <div class="col-sm-4">
                            <input
                              type="text"
                              class="form-control"
                              id="middlename"
                              name="middlename"
                              v-model="middlename"
                              v-validate="'required'"
                              :class="{'input': true, 'is-invalid': errors.has('middlename') }"
                              placeholder="Middle Name"
                              >
                              <div class="invalid-feedback">
                                {{ errors.first('middlename') }}
                              </div>
                        </div>
                        <div class="col-sm-4">
                            <input
                              type="text"
                              class="form-control"
                              id="lastname"
                              name="lastname"
                              v-model="lastname"
                              v-validate="'required'"
                              :class="{'input': true, 'is-invalid': errors.has('lastname') }"
                              placeholder="Last Name"
                              >
                              <div class="invalid-feedback">
                                {{ errors.first('lastname') }}
                              </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    v-model="email"
                    v-validate="'required|email'"
                    :class="{'input': true, 'is-invalid': errors.has('email') }"
                    placeholder="Email Address"
                    >
                    <div class="invalid-feedback">
                        {{ errors.first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Contact #</label>
                    <input
                    type="text"
                    class="form-control"
                    id="contact_no"
                    name="contact_no"
                    v-model="contact_no"
                    v-validate="'required'"
                    :class="{'input': true, 'is-invalid': errors.has('contact_no') }"
                    placeholder="Mobile No., Telephone No., etc..."
                    >
                    <div class="invalid-feedback">
                        {{ errors.first('contact_no') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Nationality</label>
                    <select 
                    class="form-control" 
                    name="nationality"
                    id="nationality"
                    v-model="nationality"
                    v-validate="'required'"
                    :class="{'input': true, 'is-invalid': errors.has('nationality') }"
                    >
                        <option value="">Select</option>
                        <option value="Afghan">Afghan</option>
                        <option value="Argentine" >Argentine</option>
                        <option value="Spanish" >Spanish</option></option>
                        <option value="Australian" >Australian</option>
                        <option value="Belgian" >Belgian</option>
                        <option value="Bolivian">Bolivian</option>
                        <option value="Brazilian">Brazilian</option>
                        <option value="Cambodian"f>Cambodian</option>
                        <option value="Cameroonian">Cameroonian</option>
                        <option value="Canadian" >Canadian</option>
                        <option value="Chilean">Chilean</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Colombian">Colombian</option>
                        <option value="Costa Rican">Costa Rican</option>
                        <option value="Cuban">Cuban</option>
                        <option value="Danish">Danish</option>
                        <option value="Dominican">Dominican</option>
                        <option value="Ecuadorian">Ecuadorian</option>
                        <option value="Egyptian">Egyptian</option>
                        <option value="Salvadorian">Salvadorian </option>
                        <option value="English">English </option>
                        <option value="Estonian">Estonian   </option>
                        <option value="Ethiopian">Ethiopian </option>
                        <option value="Finnish">Finnish </option>
                        <option value="French">French   </option>
                        <option value="German">German   </option>
                        <option value="Ghanaian">Ghanaian   </option>
                        <option value="Greek">Greek </option>
                        <option value="Guatemalan">Guatemalan   </option>
                        <option value="Haitian">Haitian  </option>
                        <option value="Honduran">Honduran   </option>
                        <option value="Indonesian">Indonesian   </option>
                        <option value="Iranian" >Iranian </option>
                        <option value="Irish" >Irish </option>
                        <option value="Israeli">Israeli </option>
                        <option value="Italian">Italian </option>
                        <option value="Japanese">Japanese   </option>
                        <option value="Jordanian">Jordanian </option>
                        <option value="Kenyan" f>Kenyan   </option>
                        <option value="Laotian" >Laotian </option>
                        <option value="Latvian">Latvian </option>
                        <option value="Lebanese">Lebanese   </option>
                        <option value="Lithuanian">Lithuanian   </option>
                        <option value="Malaysian">Malaysian  </option>
                        <option value="Mexican">Mexican </option>
                        <option value="Moroccan">Moroccan   </option>
                        <option value="Dutch">Dutch </option>
                        <option value="New Zealander">  New Zealander   </option>
                        <option value="Nicaraguan">Nicaraguan   </option>
                        <option value="Norwegian">  Norwegian   </option>
                        <option value="Panamanian"> Panamanian  </option>
                        <option value="Paraguayan"> Paraguayan  </option>
                        <option value="Peruvian">Peruvian   </option>
                        <option value="Filipino" >Filipino   </option>
                        <option value="Polish" >Polish   </option>
                        <option value="Portuguese">Portuguese   </option>
                        <option value="Puerto Rican">Puerto Rican   </option>
                        <option value="Romanian">Romanian   </option>
                        <option value="Russian">Russian </option>
                        <option value="Saudi">Saudi </option>
                        <option value="Scottish">Scottish   </option>
                        <option value="Korean" >Korean   </option>
                        <option value="Spanish">Spanish </option>
                        <option value="Swedish">Swedish </option>
                        <option value="Swiss">Swiss  </option>
                        <option value="Taiwanese">Taiwanese </option>
                        <option value="Tajik">Tajik  </option>
                        <option value="Thai">Thai   </option>
                        <option value="Turkish" >Turkish </option>
                        <option value="Ukrainian" >Ukrainian </option>
                        <option value="British">British </option>
                        <option value="American">American   </option>
                        <option value="Uruguayan">Uruguayan </option>
                        <option value="Venezuelan">Venezuelan   </option>
                        <option value="Vietnamese">Vietnamese   </option>
                        <option value="Welsh">Welsh </option>
                    </select>
                    <div class="invalid-feedback">
                        {{ errors.first('nationality') }}
                    </div>
                </div>
                
                <div class="text-right">

                    <button type="submit" class="btn btn-danger mt-2" v-if="!submitProgress"><i class="fa fa-check"></i> Book Now!</button>
                    <button type="button" class="btn btn-danger mt-2" v-if="submitProgress">
                        <i class="fa fa-circle-o-notch fa-spin"></i> Processing...</button>
                </div>
            </form>
        </b-modal>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';
    import vueImages from 'vue-images'
    export default {
        name: 'tour-package-show',
        props: ['tour_id'],
        components: {
            Datepicker,
            vueImages: vueImages
        },
        data () {
            return {
                image: null,
                imageUrl: '',
                main_photo: '',
                tour: {
                    name: '',
                    description: '',
                    created_at: '',
                    updated_at: '',
                    main_image: '',
                    notes: '',
                    inclusions: '',
                    status: '',
                    from_date: '',
                    to_date: '',
                    photos: []
                },
                destinations: [],
                destination: {
                    name: '',
                    fee: 0.00
                },
                prices: [],
                price: {
                    id: '',
                    type: '',
                    capacity_type: '',
                    capacity: '',
                    price: ''
                },
                priceAddStatus: false,
                priceUpdateStatus: false,
                destinationAddStatus: false,
                tourUpdateStatus: false,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ],
                day: '',
                month: '',
                year: '',
                travel_options: '',
                firstname: '',
                middlename: '',
                lastname: '',
                email: '',
                contact_no: '',
                submitProgress: false,
                nationality: '',
                myDate: new Date(),
                selectedDate: '',
                disabled: {},
                modalclose: true,
                keyinput: true,
                mousescroll: true,
                showclosebutton: true,
                showcaption: false,
                imagecountseparator: 'of',
                showimagecount: true,
                showthumbnails: true
            }
        },
        methods: {
            imageChanged: function (event) {

                const files = event.target.files

                const fileReader = new FileReader()

                fileReader.addEventListener('load', () => {
                    this.imageUrl = fileReader.result
                    console.log(this.imageUrl)
                })

                fileReader.readAsDataURL(files[0])
                
                this.image = files[0] 
            },
            formatDate(date) {
                return moment(date).format('MMMM DD, YYYY')
            },
            fetch: function() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/tour/show/' + this.tour_id)
                    .then((resp) => {
                        console.log(resp.data)
                        this.tour.name = resp.data.tour.name
                        this.tour.description = resp.data.tour.description
                        this.tour.created_at = resp.data.tour.created_at
                        this.tour.updated_at = resp.data.tour.updated_at
                        this.tour.status = resp.data.tour.published
                        this.tour.main_image = resp.data.tour.main_image
                        this.destinations = resp.data.destinations
                        this.tour.notes = resp.data.tour.notes
                        this.tour.inclusions = resp.data.tour.inclusions
                        this.prices = resp.data.prices
                        this.tour.from_date = resp.data.tour.from_date
                        this.tour.to_date = resp.data.tour.to_date
                        this.disabled = {
                            from: new Date(moment(resp.data.tour.to_date).format('YYYY'), moment(resp.data.tour.to_date).subtract(1, 'months').format('MM'), moment(resp.data.tour.to_date).format('DD')),
                            to: new Date()
                        }
                        var p = resp.data.photos
                        p.forEach(d => {
                            this.tour.photos.push({'imageUrl': d.filepath, 'caption': 'Tour'})
                        })
                       
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            submitBooking () {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.submitProgress = true
                        axios.post('https://travelbooking2018.000webhostapp.com/public/booking/submit', {
                            selectedDate: moment(this.selectedDate).format('YYYY-MM-DD'),
                            travel_options: this.travel_options,
                            firstname: this.firstname,
                            middlename: this.middlename,
                            lastname: this.lastname,
                            email: this.email,
                            contact_no: this.contact_no,
                            nationality: this.nationality,
                            tour_id: this.tour_id
                        })
                        .then(resp => {
                            
                            if (resp.data.status == 'ok')
                            {
                                this.submitProgress = false
                                this.clearFields()
                                this.$notify({
                                    group: 'frontend',
                                    type: 'success',
                                    title: 'Booking sent successfully!',
                                    text: 'Please check your email to guide you on completing your booking.',
                                    duration: 60000,
                                    speed: 500
                                });

                                this.$refs.booking.hide()
                                console.log(resp)
                            }
                        })
                        .catch(err => {
                            console.log(err)
                        })
                    }
                })
                
            },
            clearFields() {
                this.selectedDate = ''
                this.travel_options = ''
                this.firstname = ''
                this.middlename = ''
                this.lastname = ''
                this.email = ''
                this.contact_no = ''
                this.nationality = ''
            }
        },
        created: function() {
            this.fetch()

        },
    }
</script>
<style scoped>
    .remove {
        cursor: pointer;
    }
    .remove:hover {
        opacity: 0.8;
        color: #666;
    }
</style>