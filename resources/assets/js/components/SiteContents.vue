<template>
    <div class="row" v-on:mouseover.once="fillContents">
        <div class="col-sm-12" v-on:mouseover.once="fillContents">
            <div class="card" v-on:mouseover.once="fillContents">
                <div class="card-body">
                    
                    <form @submit.prevent="saveContents" enctype="multipart/form-data">
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Site Name</h5>
                            <input type="text" 
                                name="site_name" 
                                id="site_name" 
                                class="form-control"
                                placeholder="Enter site name here.."
                                v-model="site_name"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('site_name') }">
                            <div class="invalid-feedback">
                                {{ errors.first('site_name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Site Email</h5>
                            <input type="text" 
                                name="site_email" 
                                id="site_email" 
                                class="form-control"
                                placeholder="Enter site email here.."
                                v-model="site_email"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('site_email') }">
                            <div class="invalid-feedback">
                                {{ errors.first('site_email') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Site Address</h5>
                            <input type="text" 
                                name="site_address" 
                                id="site_address" 
                                class="form-control"
                                placeholder="Enter site address here.."
                                v-model="site_address"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('site_address') }">
                            <div class="invalid-feedback">
                                {{ errors.first('site_address') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Site Telephone No.</h5>
                            <input type="text" 
                                name="site_telephone" 
                                id="site_telephone" 
                                class="form-control"
                                placeholder="Enter site_telephone here.."
                                v-model="site_telephone"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('site_telephone') }">
                            <div class="invalid-feedback">
                                {{ errors.first('site_telephone') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Site Mobile No.</h5>
                            <input type="text" 
                                name="site_mobile" 
                                id="site_mobile" 
                                class="form-control"
                                placeholder="Enter site_mobile here.."
                                v-model="site_mobile"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('site_mobile') }">
                            <div class="invalid-feedback">
                                {{ errors.first('site_mobile') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">About the Site</h5>
                            <tinymce id="d1"
                            v-model="company"
                            :plugins="tinymcePlugins"
                            v-on:mouseover.once="fillContents"
                            ></tinymce>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Mission</h5>
                            <tinymce id="d2"
                            v-model="mission"
                            :plugins="tinymcePlugins"
                            v-on:mouseover.once="fillContents"
                            ></tinymce>
                        </div>
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Vision</h5>
                            <tinymce id="d3"
                            v-model="vision"
                            :plugins="tinymcePlugins"
                            v-on:mouseover.once="fillContents"
                            ></tinymce>
                        </div>
                        
                        <div class="form-group">
                            <h5 v-on:mouseover.once="fillContents">Book Guide</h5>
                            <tinymce id="d4"
                            v-model="book_guide"
                            :plugins="tinymcePlugins"
                            v-on:mouseover.once="fillContents"
                            ></tinymce>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-circle-o-notch fa-spin" v-if="result"></i> <i class="fa fa-check" v-if="!result"></i> <span v-if="result">Saved!</span> <span v-else>Save Contents</span></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'site-contents',
        data() {
            return {
                title: '',
                company: '',
                mission: '',
                vision: '',
                site_name: '',
                site_address: '',
                site_mobile: '',
                site_telephone: '',
                site_email: '',
                book_guide: '',
                result: null,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ]
            }
        },
        created: function() {
            this.fetch()
        },
        methods: {
            saveContents() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                   this.result = true
                   axios.post('https://travelbooking2018.000webhostapp.com/public/admin/site-contents/update', {
                    mission: this.mission,
                    company: this.company,
                    vision: this.vision,
                    site_name: this.site_name,
                    site_email: this.site_email,
                    site_address: this.site_address,
                    site_mobile: this.site_mobile,
                    site_telephone: this.site_telephone,
                    book_guide: this.book_guide
                   })
                   .then((resp) => {
                        if (resp.data.status == 'ok')
                        {
                            this.result = false
                            this.$notify({
                                  group: 'backend',
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Action processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                        }
                        else
                        {

                            this.result = false
                            this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Fail!',
                                  text: 'Action did not processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                        }
                   })
                   .catch((err) => {
                        console.log(err)
                   })
                  return;
                }

                // alert('Correct them errors!');
              });
            },

            fillContents () {
                this.company = this.company + ' '
                this.mission = this.mission + ' '
                this.vision = this.vision + ' '
                this.book_guide = this.book_guide + ' '
            },

            fetch () {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/site-contents', {

                })
                .then(resp => {
                    console.log(resp)
                    this.company = resp.data.company.content
                    this.mission = resp.data.mission.content
                    this.vision = resp.data.vision.content
                    this.site_name = resp.data.site_name.content
                    this.site_email = resp.data.site_email.content
                    this.site_address = resp.data.site_address.content
                    this.site_telephone = resp.data.site_telephone.content
                    this.site_mobile = resp.data.site_mobile.content
                    this.book_guide = resp.data.book_guide.content
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>