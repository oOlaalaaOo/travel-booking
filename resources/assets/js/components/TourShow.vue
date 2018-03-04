<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
              <div class="card">
                    <div class="card-body">
                        <p>Status: <span v-if="tour.status">Active</span> <span v-else>Inactive </span></p>
                        
                        <button class="btn btn-danger btn-sm mb-1" type="button" v-b-modal.tourModalDelete><i class="fa fa-edit"></i> Delete Tour?</button>

                        <button class="btn btn-dark btn-sm mb-1" type="button" v-b-modal.priceModalAdd><i class="fa fa-edit"></i> Set Tour Price</button>
                        
                        <button class="btn btn-primary btn-sm mb-1" type="button" @click="xDescription"><i class="fa fa-edit"></i> Update Tour Contents</button>

                        <button class="btn btn-success btn-sm mb-1" type="button" v-b-modal.destinationModalAdd><i class="fa fa-plus"></i> New Destination</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 mt-2">
                <div class="card">
                    <img class="card-img-top" :src="tour.main_image" alt="Card image cap">
                    <div class="card-body">
                        <small>[Title]</small>
                        <h5 class="card-title">{{ tour.name }}</h5>
                        <small>[Description]</small>
                        <span class="card-text" v-html="tour.description"></span>
                        <br />
                        <small>[Notes]</small>
                        <span class="card-text" v-html="tour.notes"></span>
                        <br />
                        <small>[Inclusions]</small>
                        <span class="card-text" v-html="tour.inclusions"></span>
                        
                    </div>
                    
                    <div class="card-footer">
                        <small style="color: #777">Created: {{ tour.created_at }} Updated: {{ tour.updated_at }}</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 mt-2">

                <div class="card">
                    <div class="card-body">
                        <h5>Destinations</h5>
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(des, index) in destinations" :key="des.id">{{ des.address }}<span class="badge badge-danger badge-pill remove" @click.prevent="destinationDelete(des.id)">X</span></li>
                        </ul>
                    </div>
                </div>
                
                <br />

                <div class="card">
                    <div class="card-body">
                        <h5>Prices</h5>
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(price, index) in prices" :key="price.id">
                                <strong>Price: {{ price.price }}</strong> <br />
                                Price Type: [{{ price.type }}] <br />
                                Capacity Type: [{{ price.capacity_type }}] <br />
                                Capacity: [{{ price.capacity }}] <br />
                                <div class="text-right">
                                    <button class="btn btn-sm btn-primary" @click="setPriceDetailUpdate(price.id)">Update</button>
                                    <button class="btn btn-sm btn-danger" @click="setPriceIdDelete(price.id)">Remove</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <br />
        
        <b-modal ref="priceModalDelete" hide-footer centered title="Action: Delete Price">
          <p>Do you sure?</p>
          <small>It's not recommended to delete a price since it will be used in booking details</small>
          <button type="button" class="btn btn-danger mt-2" @click.prevent="priceDelete">Go delete it!</button>
        </b-modal>

        <b-modal ref="priceModalUpdate" hide-footer centered title="Action: Update Price Details">
          <form @submit.prevent="priceUpdate(price)">
            
            <div class="form-group">
              
              <label for="price_type" class="col-form-label">Price Type:</label>
              <select
                id="price_type"
                name="price_type"
                class="form-control"
                :class="{'input': true, 'is-invalid': errors.has('price_type') }"
                v-model="price.type"
                v-validate="'required'"
                >
                <option value="">Select One</option>
                <option value="joiner">Joiner</option>
                <option value="exclusive">Exclusive</option>
              </select>
              <div class="invalid-feedback">
                {{ errors.first('price_type') }}
              </div>
            </div>
            <div class="form-group">
              <label for="capacity_type" class="col-form-label">Capacity Type:</label>
              <select
                id="capacity_type"
                name="capacity_type"
                class="form-control"
                :class="{'input': true, 'is-invalid': errors.has('capacity_type') }"
                v-model="price.capacity_type"
                v-validate="'required'"
                >
                <option value="">Select One</option>
                <option value="group">Group</option>
                <option value="person">Person</option>
              </select>
              <div class="invalid-feedback">
                {{ errors.first('capacity_type') }}
              </div>
            </div>
            <div class="form-group">
              <label for="capacity" class="col-form-label">Capacity Length:</label>
              <input
              id="capacity"
              name="capacity"
              class="form-control"
              :class="{'input': true, 'is-invalid': errors.has('capacity') }"
              v-model="price.capacity"
              v-validate="'required'"
              />
              <div class="invalid-feedback">
                {{ errors.first('capacity') }}
              </div>
            </div>
            <div class="form-group">
              <label for="price" class="col-form-label">Price:</label>
              <input
              id="price"
              name="price"
              class="form-control"
              :class="{'input': true, 'is-invalid': errors.has('price') }"
              v-model="price.price"
              v-validate="'required|decimal:2'"
              />
              <div class="invalid-feedback">
                {{ errors.first('price') }}
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
            
          </form>
        </b-modal>
        
        <b-modal id="priceModalAdd" hide-footer centered title="Action: Set Price">
          <form @submit.prevent="priceAdd(price)">
            
            <div class="form-group">
              
              <label for="price_type" class="col-form-label">Price Type:</label>
              <select
                id="price_type"
                name="price_type"
                class="form-control"
                :class="{'input': true, 'is-invalid': errors.has('price_type') }"
                v-model="price.type"
                v-validate="'required'"
                >
                <option value="">Select One</option>
                <option value="joiner">Joiner</option>
                <option value="exclusive">Exclusive</option>
              </select>
              <div class="invalid-feedback">
                {{ errors.first('price_type') }}
              </div>
            </div>
            <div class="form-group">
              <label for="capacity_type" class="col-form-label">Capacity Type:</label>
              <select
                id="capacity_type"
                name="capacity_type"
                class="form-control"
                :class="{'input': true, 'is-invalid': errors.has('capacity_type') }"
                v-model="price.capacity_type"
                v-validate="'required'"
                >
                <option value="">Select One</option>
                <option value="group">Group</option>
                <option value="person">Person</option>
              </select>
              <div class="invalid-feedback">
                {{ errors.first('capacity_type') }}
              </div>
            </div>
            <div class="form-group">
              <label for="capacity" class="col-form-label">Capacity Length:</label>
              <input
              id="capacity"
              name="capacity"
              class="form-control"
              :class="{'input': true, 'is-invalid': errors.has('capacity') }"
              v-model="price.capacity"
              v-validate="'required'"
              />
              <div class="invalid-feedback">
                {{ errors.first('capacity') }}
              </div>
            </div>
            <div class="form-group">
              <label for="price" class="col-form-label">Price:</label>
              <input
              id="price"
              name="price"
              class="form-control"
              :class="{'input': true, 'is-invalid': errors.has('price') }"
              v-model="price.price"
              v-validate="'required|decimal:2'"
              />
              <div class="invalid-feedback">
                {{ errors.first('price') }}
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
          </form>
        </b-modal>

        <b-modal id="tourModalDelete" hide-footer centered title="Action: Delete Tour">
            <p>Do you sure?</p>
            <small>Once a tour package is deleted it will not be recover anymore so think twice</small>
        
            <button type="button" class="btn btn-danger mt-2" @click.prevent="tourDelete">Go delete it!</button>

        </b-modal>
        
        <b-modal id="destinationModalAdd" hide-footer centered title="Action: Add Destination">
          <form @submit.prevent="destinationAdd(destination)">
            
            <div class="form-group">
              
              <label for="destination_name" class="col-form-label">Destination Name:</label>
              <input
              type="text"
              class="form-control"
              id="destination_name"
              name="destination_name"
              v-model="destination.name"
              v-validate="'required'"
              :class="{'input': true, 'is-invalid': errors.has('destination_name') }"
              >
              <div class="invalid-feedback">
                {{ errors.first('destination_name') }}
              </div>
            </div>
            <div class="form-group">
              <label for="destination_fee" class="col-form-label">Destination Fee(optional):</label>
              <input
              type="text"
              class="form-control"
              id="destination_fee"
              name="destination_fee"
              v-model="destination.fee"
              v-validate="'decimal:2'"
              :class="{'input': true, 'is-invalid': errors.has('destination_fee') }"
              >
              <div class="invalid-feedback">
                {{ errors.first('destination_fee') }}
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </b-modal>


        <b-modal ref=tourModalUpdate hide-footer size="lg" centered title="Action: Update Tour Details">
          <form @submit.prevent="tourUpdate('tour')" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-group">
                <label for="main_photo">Main Photo</label><br />
                <img class="img-thumbnail" style="width: 100%; height: 450px" :src="tour.main_image" v-if="imageUrl == ''" />
                <img class="img-thumbnail" style="width: 100%; height: 450px" :src="imageUrl" v-else="imageUrl != ''" />
                <br />
                <br />
                <input
                type="file"
                class="form-control"
                accept="image/*"
                id="main_photo"
                name="main_photo"
                v-validate="'required|image'"
                :class="{'input': true, 'is-invalid': errors.has('main_photo') }"
                @change="imageChanged"
                />
                <div class="invalid-feedback">
                  {{ errors.first('main_photo') }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Tour Name/Title</label>
              <input type="text"
              name="name"
              id="name"
              class="form-control"
              placeholder="Enter name/title here.."
              v-model="tour.name"
              v-validate="'required'"
              :class="{'input': true, 'is-invalid': errors.has('name') }">
              <div class="invalid-feedback">
                {{ errors.first('name') }}
              </div>
            </div>
            
            <div class="form-group">
              <label>Description (optional)</label>
              <tinymce
              id="d1"
              :plugins="tinymcePlugins"
              :value="tour.description"
              v-model="tour.description"
              ></tinymce>
            </div>
            
            <br />
            <div class="form-group">
              <label>Notes (optional)</label>
              <tinymce
              id="d2"
              :plugins="tinymcePlugins"
              :value="tour.notes"
              v-model="tour.notes"
              ></tinymce>
            </div>
            
            <br />
            <div class="form-group">
              <label>Inclusions (optional)</label>
              <tinymce
              id="d3"
              :plugins="tinymcePlugins"
              :value="tour.inclusions"
              v-model="tour.inclusions"
              ></tinymce>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </b-modal>


    </div>
</template>

<script>
    export default {
        name: 'tour-show',
        props: ['tour_id'],
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
                    status: ''
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
                price_id: '',
                priceAddStatus: false,
                priceUpdateStatus: false,
                destinationAddStatus: false,
                tourUpdateStatus: false,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ]
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
            fetch: function() {
                axios.post('/admin/tour/show/' + this.tour_id)
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
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            tourDelete: function () {
                axios.post('/admin/tour/delete', {
                    tour_id: this.tour_id
                })
                .then((resp) => {
                    window.location.href = '/admin/tour/all'
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            setPriceIdDelete: function (price_id) {
                this.$refs.priceModalDelete.show()
                this.price_id = price_id
                
            },
            priceDelete: function () {
              axios.post('/admin/tour/price/delete', {
                    price_id: this.price_id
                })
                .then((resp) => {
                    this.$refs.priceModalDelete.hide()
                    this.fetch()
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            setPriceDetailUpdate: function (id) {
                this.$refs.priceModalUpdate.show()
                axios.get('/admin/tour/price/show/' + id)
                .then((resp) => {
                    this.price.id = resp.data.price.id
                    this.price.type = resp.data.price.type
                    this.price.capacity_type = resp.data.price.capacity_type
                    this.price.capacity = resp.data.price.capacity
                    this.price.price = resp.data.price.price
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            priceUpdate: function (scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        axios.post('/admin/tour/price/update/', {
                            price_id: this.price.id,
                            type : this.price.type,
                            capacity_type : this.price.capacity_type,
                            capacity : this.price.capacity,
                            price : this.price.price,
                        })
                        .then((resp) => {
                            this.$notify({
                              group: 'backend',
                              type: 'success',
                              title: 'Success!',
                              text: 'Action processed successfully',
                              duration: 5000,
                              speed: 500
                            });
                            this.$refs.priceModalUpdate.hide()
                            this.fetch()
                            this.priceUpdateStatus = true
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                    }
                })
                
            },
            tourUpdate: function (scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        axios.post('/admin/tour/update', {
                            tour_id: this.tour_id,
                            image: this.imageUrl,
                            name: this.tour.name,
                            description: this.tour.description,
                            notes: this.tour.notes,
                            inclusions: this.tour.inclusions,
                        })
                        .then((resp) => {
                            this.$refs.tourModalUpdate.hide()
                            this.$notify({
                              group: 'backend',
                              type: 'success',
                              title: 'Success!',
                              text: 'Action processed successfully',
                              duration: 5000,
                              speed: 500
                            });
                            this.fetch()
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                    }
                })
            },
            getStatus: function (status) {
                return status
            },
            xDescription: function() {
                this.tour.description = this.tour.description + ' '
                this.tour.notes = this.tour.notes + ' '
                this.tour.inclusions = this.tour.inclusions + ' '
                this.$refs.tourModalUpdate.show()
            },
            destinationAdd: function (scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        axios.post('/admin/tour/destination/add', {
                            tour_id: this.tour_id,
                            name: this.destination.name,
                            fee: this.destination.fee
                        })
                        .then((resp) => {
                           
                            if(resp.data.status == 'ok')
                            {
                              this.$notify({
                                group: 'backend',
                                type: 'success',
                                title: 'Success!',
                                text: 'Action processed successfully',
                                duration: 5000,
                                speed: 500
                              });
                                this.fetch()
                                this.destination.name = ''
                                this.destination.fee = 0.00
                                this.destinationAddStatus = true
                            }
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                    }
                })
            },
            destinationDelete: function (id) {
                axios.post('/admin/tour/destination/delete', {
                    destination_id: id,
                })
                .then((resp) => {
                    this.$notify({
                      group: 'backend',
                      type: 'success',
                      title: 'Success!',
                      text: 'Action processed successfully',
                      duration: 5000,
                      speed: 500
                    });
                    this.fetch()
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            priceAdd: function (scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        axios.post('/admin/tour/price/add', {
                            tour_id: this.tour_id,
                            type: this.price.type,
                            capacity_type: this.price.capacity_type,
                            capacity: this.price.capacity,
                            price: this.price.price,
                        })
                        .then((resp) => {
                            console.log(resp)
                            if(resp.data.status == 'ok')
                            {
                                this.$notify({
                                  group: 'backend',
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Action processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                                this.fetch()
                                this.price.type = ''
                                this.price.capacity_type = ''
                                this.price.capacity = 0
                                this.price.price = 0.00
                                this.priceAddStatus = true
                            }
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                    }
                })
            },
            
        },
        mounted: function() {
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