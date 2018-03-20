<template>
    <div>
        <div class="row">
            
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <small>[Title]</small>
                        <h5 class="card-title">{{ post.title }}</h5>
                        <small>[Content]</small>
                        <span class="card-text" v-html="post.content"></span>
                        
                    </div>
                    
                    <div class="card-footer">
                        <small style="color: #777">Created: {{ post.created_at }} Updated: {{ post.updated_at }}</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Actions</h5>
                        <hr>
                        <p>Status: <span v-if="post.published">Active</span> <span v-else class="badge badge-danger">Inactive </span></p>
                        
                        <button class="btn btn-primary btn-sm mb-1" type="button" data-toggle="modal" data-target="#tourModalUpdate" @click="xDescription"><i class="fa fa-edit"></i> Update Post Contents</button>
                        <button class="btn btn-danger btn-sm mb-1" type="button" data-toggle="modal" data-target="#tourModalDelete"><i class="fa fa-edit"></i> Delete Post ?</button>
                       
                    </div>
                </div>
            </div>
        </div>
        <br />

        <!-- Modal -->
        <!-- <div class="modal fade" id="priceModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Action: Delete Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Do you sure?</p>
                <small>It's not recommended to delete a price since it will be used in booking details</small>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click.prevent="priceDelete">Go delete it!</button>
              </div>
            </div>
          </div>
        </div> -->

        <div class="modal fade" id="tourModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Action: Delete Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Do you sure?</p>
                <small>Once a tour package is deleted it will not be recover anymore so think twice</small>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click.prevent="postDelete">Go delete it!</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tourModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Action: Edit Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="postUpdate('post')" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div v-if="postUpdateStatus">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Successfully Updated!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" 
                        name="title" 
                        id="title" 
                        class="form-control" 
                        placeholder="Enter title here.."
                        v-model="post.title"
                        v-validate="'required'"
                        :class="{'input': true, 'is-invalid': errors.has('title') }">
                        <div class="invalid-feedback">
                            {{ errors.first('title') }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Content (optional)</label>
                        <tinymce 
                            id="d1" 
                            :plugins="tinymcePlugins" 
                            :value="post.content"
                            v-model="post.content" 
                        ></tinymce>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'post-show',
        props: ['post_id'],
        data () {
            return {
                post: {
                  title: '',
                  content: '',
                  created_at: '',
                  updated_at: '',
                  published: null
                },
                postUpdateStatus: false,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ]
            }
        },
        methods: {
            fetch: function() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/post/show/' + this.post_id)
                    .then((resp) => {
                        console.log(resp.data)
                        this.post.title = resp.data.post.title
                        this.post.content = resp.data.post.content
                        this.post.published = resp.data.post.published
                        this.post.created_at = resp.data.post.created_at
                        this.post.updated_at = resp.data.post.updated_at
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            postDelete: function () {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/post/delete', {
                    post_id: this.post_id
                })
                .then((resp) => {
                    window.location.href = 'https://travelbooking2018.000webhostapp.com/public/admin/post/all'
                })
                .catch((err) => {
                    console.log(err)
                })
            },
            postUpdate: function (scope) {
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        axios.post('https://travelbooking2018.000webhostapp.com/public/admin/post/update', {
                            post_id: this.post_id,
                            title: this.post.title,
                            content: this.post.content
                        })
                        .then((resp) => {
                            console.log(resp.data)
                            this.postUpdateStatus = true
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
                this.post.content = this.post.content + ' '
            }
        },
        mounted: function() {
            this.fetch()
        },
    }
</script>
<style>
    .remove {
        cursor: pointer;
    }
    .remove:hover {
        opacity: 0.8;
        color: #666;
    }
</style>