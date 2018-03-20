<template>
    <div class="row">
        <div class="col-sm-12 col-md-4 offset-md-4 mt-5">
            <div class="card" v-animate-css.once="'fadeIn'">
                <div class="card-body">
                    <form @submit.prevent="login">
                        <div class="row mb-4">
                            <div class="col-sm-12 col-sm-4">
                                <img :src="appLogo" class="img-responsive" alt="travel-booking-logo" width="100" />
                            </div>
                            <div class="col-sm-12 col-sm-8">
                                <h3 class="mt-4">Travel Booking</h3>
                                <small class="">
                                    Magallanes St, Cebu City, Philippines
                                </small>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">

                            <div class="alert alert-warning" role="alert" v-if="loginResponse == 'fail'">
                              <strong>Login Failed!</strong> <br />Username and Password did not matched.
                            </div>

                            <label for="title">Username</label>
                            <input type="text" 
                                name="username" 
                                id="username" 
                                class="form-control text-center"
                                style="font-weight: 600" 
                                placeholder="Enter username here.."
                                v-model="username"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('username') }">
                            <div class="invalid-feedback">
                                {{ errors.first('username') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" 
                                name="password" 
                                id="password" 
                                class="form-control text-center" 
                                style="font-weight: 600"
                                placeholder="Enter password here.."
                                v-model="password"
                                v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('password') }">
                            <div class="invalid-feedback">
                                {{ errors.first('password') }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" :disabled="disableSignin"><span v-if="disableSignin">Processing..</span><span v-else>Sign-in</span></button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>

    export default {
        name: 'auth-login',
        props: ['app_url'],
        data() {
            return {
                username: '',
                password: '',
                appLogo: '',
                loginResponse: '',
                disableSignin: null
            }
        },
        created: function() {
            this.setAppLogo()
        },
        methods: {

            login() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.disableSignin = true
                        this.loginResponse = ''
                        axios.post('https://travelbooking2018.000webhostapp.com/public/admin/login', {
                            username: this.username,
                            password: this.password
                        })
                        .then((resp) => {
                            console.log(resp)
                            if (resp.data.status == 'ok') {
                                this.$notify({
                                  group: 'backend',
                                  type: 'success',
                                  title: 'Login Success!',
                                  text: 'Action processed successfully<br />Redirecting...',
                                  duration: 5000,
                                  speed: 500
                                });
                                setTimeout(function () {
                                    window.location.href = 'https://travelbooking2018.000webhostapp.com/public/admin/dashboard'
                                }, 3000)

                            } else {
                                this.loginResponse = 'fail'
                                this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Login Fail!',
                                  text: 'Username and Password did not matched',
                                  duration: 5000,
                                  speed: 500
                                });
                                this.disableSignin = false
                            }
                        })
                        .catch((err) => {
                            console.log('errors: ' + err)
                            if (err.response) {
                              this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Error!',
                                  text: 'Something went wrong!',
                                  duration: 5000,
                                  speed: 500
                                });
                            }
                            
                        })
                    }
                })
            },

            setAppLogo() {
                this.appLogo = 'https://travelbooking2018.000webhostapp.com/public/img/icon.png'
            }
        }
    }
</script>
