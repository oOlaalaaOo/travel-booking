<template>

    <div class="card">
        <div class="card-body">
            
            <form @submit.prevent="postAdd" enctype="multipart/form-data">

                <h5>Post</h5>
                <hr>
                
                <div class="form-group">
                     <select 
                        name="type"
                        id="type"
                        class="form-control"
                        v-model="type"
                        v-validate="'required'"
                        :class="{'input': true, 'is-invalid': errors.has('type') }">
                        <option value="">Select</option>
                        <option value="news">News</option>
                        <option value="updates">Updates</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ errors.first('type') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    placeholder="Enter name/title here.."
                    v-model="title"
                    v-validate="'required'"
                    :class="{'input': true, 'is-invalid': errors.has('title') }">
                    <div class="invalid-feedback">
                        {{ errors.first('title') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="content">Content (optional)</label>
                    <tinymce id="d1" 
                    v-model="content"
                    :plugins="tinymcePlugins"
                    ></tinymce>
                </div>

                <div class="form-group text-right">

                    <button type="submit" class="btn btn-success"><i class="fa fa-spin fa-spinner" v-if="result"></i> <i class="fa fa-check" v-if="!result"></i> <span v-if="result">Saved!</span> <span v-else>Save New Post</span></button>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'post-add',
        data() {
            return {
                title: '',
                content: '',
                type: '',
                result: false,
                tinymcePlugins: [
                    'advlist autolink lists link charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality','template'
                ]
            }
        },
        created: function() {
            
        },
        methods: {
            postAdd() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                   this.result = true
                   axios.post('https://travelbooking2018.000webhostapp.com/public/admin/post/add', {
                    title: this.title,
                    content: this.content,
                    type: this.type
                   })
                   .then((resp) => {
                        if (resp.data.status == 'ok')
                        {
                            setTimeout(() => {
                                this.result = false
                                this.title = ''
                                this.content = ''
                                this.type = ''
                                
                            }, 1000)
                        }
                        else
                        {
                            this.result = false
                        }
                   })
                   .catch((err) => {
                        console.log(err)
                   })
                  return;
                }

                // alert('Correct them errors!');
              });
            }
        }
    }
</script>