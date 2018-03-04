<template>

    <div class="card">
        <div class="card-body">
            
            <form @submit.prevent="tourAdd" enctype="multipart/form-data">

                <h5>Tour Package Details</h5>
                <hr>
                <div class="form-group">
                    <label for="main_photo">Main Photo</label><br />
                    <img class="img-thumbnail" style="width: auto; height: 300px;" src="http://localhost:8000/img/default-img.png" v-if="imageUrl == ''" />
                    <img class="img-thumbnail" style="width: auto; height: 300px;" :src="imageUrl" v-else="imageUrl != ''" />

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
                <div class="form-group">
                    <label for="name">Tour Name/Title</label>
                    <input type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    placeholder="Enter name/title here.."
                    v-model="name"
                    v-validate="'required'"
                    :class="{'input': true, 'is-invalid': errors.has('name') }">
                    <div class="invalid-feedback">
                        {{ errors.first('name') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description (optional)</label>
                    <tinymce id="d1" 
                    v-model="description"
                    :plugins="tinymcePlugins"
                    ></tinymce>
                </div>
                
                <br />

                    <div class="form-group">
                        <label>Notes (optional)</label>
                        <tinymce 
                            id="d2" 
                            :plugins="tinymcePlugins" 
                            v-model="notes" 
                        ></tinymce>
                    </div>
                    
                    <br />

                    <div class="form-group">
                        <label>Inclusions (optional)</label>
                        <tinymce 
                            id="d3" 
                            :plugins="tinymcePlugins" 
                            v-model="inclusions" 
                        ></tinymce>
                    </div>

                <div class="form-group text-right">

                    <button type="submit" class="btn btn-success"><i class="fa fa-spin fa-spinner" v-if="result"></i> <i class="fa fa-check" v-if="!result"></i> <span v-if="result">Saved!</span> <span v-else>Save New Tour Package</span></button>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'tour-add',
        data() {
            return {
                main_photo: '',
                name: '',
                description: '',
                image: null,
                imageUrl: '',
                notes: '',
                inclusions: '',
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
            tourAdd() {
              this.$validator.validateAll().then((result) => {
                if (result) {
                   this.result = true
                   axios.post('/admin/tour/add', {
                    image: this.imageUrl,
                    name: this.name,
                    description: this.description,
                    notes: this.notes,
                    inclusions: this.inclusions,
                   })
                   .then((resp) => {
                        if (resp.data.status == true)
                        {
                            setTimeout(() => {
                                this.result = false
                                this.name = ''
                                this.description = ''
                                this.imageUrl = ''
                                this.notes = ''
                                this.inclusions = ''
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