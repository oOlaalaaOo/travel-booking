<template>
    <div class="row">
        <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <form @submit.prevent="usernameUpdate(user)" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="username"
                                            placeholder="Enter username here.."
                                            v-model="user.username"
                                            data-vv-as="Username"
                                            v-validate="'required'"
                                            :class="{'input': true, 'is-invalid': errors.has('username') }">
                                        <div class="invalid-feedback">
                                            {{ errors.first('username') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" v-if="!progressUsernameUpdate"><i class="fa fa-edit"></i> Update Username</button>

                                        <button type="button" class="btn btn-light" v-else><i class="fa fa-circle-o-notch fa-spin"></i> Processing..</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <form @submit.prevent="passwordUpdate(pass)" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="wrongPassword">
                                        <strong>Wrong Password!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <label for="current_password">Your Current Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="current_password"
                                        placeholder="Enter current password here.."
                                        v-model="pass.current_password"
                                        v-validate="'required'"
                                        data-vv-as="Current Password"
                                        :class="{'input': true, 'is-invalid': errors.has('current_password') }">
                                    <div class="invalid-feedback">
                                        {{ errors.first('current_password') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="Enter new password here.."
                                        v-model="pass.password"
                                        v-validate="'required|confirmed:confirm_password'"
                                        data-vv-as="New Password"
                                        :class="{'input': true, 'is-invalid': errors.has('password') }">
                                    <div class="invalid-feedback">
                                        {{ errors.first('password') }}
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="confirm_password"
                                        placeholder="Enter confirm new password here.."
                                        v-model="pass.confirm_password"
                                        v-validate="'required'"
                                        data-vv-as="Confirm New Password"
                                        :class="{'input': true, 'is-invalid': errors.has('confirm_password') }">
                                    <div class="invalid-feedback">
                                        {{ errors.first('confirm_password') }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" v-if="!progressPasswordUpdate"><i class="fa fa-edit"></i> Update Password</button>

                                    <button type="button" class="btn btn-light" v-else><i class="fa fa-circle-o-notch fa-spin"></i> Processing..</button>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
           
        </div>
        
    </div>
</template>

<script>
    export default {
        name: 'account-credentials',
        data() {
            return {
                wrongPassword: false,
                user: {
                    username: ''
                },
                pass: {
                    password: '',
                    confirm_password: '',
                    current_password: ''
                },
                result: false,
                progressUsernameUpdate: null,
                progressPasswordUpdate: null
            }
        },
        created: function() {
            this.credentials()
        },
        methods: {

            credentials() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/account/credentials', {})
                    .then((resp) => {
                        console.log(resp)
                        this.user.username = resp.data.credentials.email
                    })
                    .catch((err) => {
                        console.log('errors: ' + err)
                    })
            },

            usernameUpdate(scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        
                        this.progressUsernameUpdate = true
                        axios.post('https://travelbooking2018.000webhostapp.com/public/admin/account/credentials/username/update', {
                            email: this.user.username,
                        })
                        .then((resp) => {
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
                            this.progressUsernameUpdate = false
                        })
                        .catch((err) => {
                            if (err.response) {
                              tthis.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Error!',
                                  text: 'Something went wrong',
                                  duration: 5000,
                                  speed: 500
                                });
                            }
                            this.progressUsernameUpdate = false
                        })
                        
                    }
                })
            },

            passwordUpdate(scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        this.progressPasswordUpdate = true
                        axios.post('https://travelbooking2018.000webhostapp.com/public/admin/account/credentials/password/update', {
                            password: this.pass.password,
                            current_password: this.pass.current_password
                        })
                        .then((resp) => {
                            console.log(resp)
                            if (resp.data.status == 'wrong') {
                                this.wrongPassword = true
                                this.progressPasswordUpdate = false
                                this.$notify({
                                  group: 'backend',
                                  type: 'error',
                                  title: 'Success!',
                                  text: 'Wrong Password!',
                                  duration: 5000,
                                  speed: 500
                                });;
                            } else if (resp.data.status == 'ok') {
                                this.wrongPassword = false
                                this.pass.current_password = ''
                                this.pass.password = ''
                                this.pass.confirm_password = ''
                                this.progressPasswordUpdate = false
                                this.$notify({
                                  group: 'backend',
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Action processed successfully',
                                  duration: 5000,
                                  speed: 500
                                });
                            } else if (resp.data.status == 'fail') {
                                this.pass.current_password = ''
                                this.pass.password = ''
                                this.pass.confirm_password = ''
                                this.progressPasswordUpdate = false
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
                            this.progressUsernameUpdate = false
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