<template>
    <div class="row">
        <div class="col-sm-12">
            <form @submit.prevent="profileUpdate" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <img :src="photo" class="img-responsive" width="200" />
                                <hr>
                                <input type="file" class="form-control" @change="photo_file">
                            </div>
                        </div>          
                    </div>
                    <div class="col-sm-9">
                        
                        <div class="form-group">
                            <small>Created at: {{ created_at }} - Updated at: {{ updated_at }}</small>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input
                            type="text"
                            class="form-control"
                            style="width: 50%"
                            v-model="name">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">About Me ?</label>
                            <textarea
                                rows="5"
                                name="description"
                                id="description"
                                class="form-control"
                                v-model="description">
                                
                            </textarea>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-light" v-if="progressUpdateProfile">  
                                    <i class="fa fa-circle-o-notch fa-spin"></i> Processing..
                            </button>
                            <button type="submit" class="btn btn-primary" v-else>  
                                    <i class="fa fa-edit"></i> Update
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'account-profile',
        data() {
            return {
                username: '',
                password: '',
                name: '',
                description: '',
                photo: '',
                photo_url: '',
                created_at: '',
                updated_at: '',
                result: false,
                progressUpdateProfile: null,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ]
            }
        },
        created: function() {
            this.profile()
        },
        methods: {

            profile() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/account/profile', {})
                    .then((resp) => {
                        console.log(resp)
                        this.name = resp.data.profile.name
                        this.username = resp.data.profile.email
                        this.description = resp.data.profile.description
                        this.created_at = resp.data.profile.created_at
                        this.updated_at = resp.data.profile.updated_at
                        if (resp.data.profile.photo == '') {
                            this.photo = 'https://travelbooking2018.000webhostapp.com/public/img/default-img-user.png'
                        } else {
                            this.photo = resp.data.profile.photo
                        }
                    })
                    .catch((err) => {
                        console.log('errors: ' + err)
                    })
            },

            photo_file() {
                const files = event.target.files

                const fileReader = new FileReader()

                fileReader.addEventListener('load', () => {
                    this.photo_url = fileReader.result
                    this.photo = fileReader.result
                })

                fileReader.readAsDataURL(files[0])
                
                // this.photo_url = files[0] 
            },

            profileUpdate() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.progressUpdateProfile = true
                        axios.post('https://travelbooking2018.000webhostapp.com/public/admin/account/profile/update', {
                            name: this.name,
                            description: this.description,
                            photo: this.photo_url
                        })
                        .then(resp => {
                            console.log(resp)
                            if (resp.data.status == 'ok') {
                                this.$notify({
                                  group: 'backend',
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Action processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                            } else if (resp.data.status == 'fail') {
                                this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Fail!',
                                  text: 'Action did not processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                            }
                            this.progressUpdateProfile = false
                        })
                        .catch(err => {
                            if (err.response) {
                              this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Fail!',
                                  text: 'Something went wrong!',
                                  duration: 5000,
                                  speed: 500
                                });
                            }
                            this.progressUpdateProfile = true
                            
                        })
                    }
                })
            }
        }
    }
</script>
<style scoped>
    .notify {
        margin-top: 50px;
    }
</style>