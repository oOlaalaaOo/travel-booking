<template>
    <div class="row" v-if="posts.length > 0">
        <div class="col-sm-4 mb-3" v-for="(post, index) in posts">
            <div class="card" v-animate-css.once="'bounceIn'">
                <div class="card-header text-right">
                    <a href="#" class="btn btn-info btn-sm" @click.prevent="view_post(post.id)"><i class="fa fa-wrench"></i></a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text" v-html="post.content"></p>
                </div>
            </div>
        </div> 
    </div>

    <div class="row" v-else>
        <div class="col-sm-12">
            <div class="card" v-animate-css.once="'bounceIn'">
                <div class="card-body">
                    <h5 class="card-title text-center">No posts yet..</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'post-all',
        data() {
            return {
                posts: []
            }
        },
        created: function() {
            this.fetch()
        },
        methods: {
            fetch: function() {
                axios.post('https://travelbooking2018.000webhostapp.com/public/admin/post/all')
                    .then((resp) => {
                        this.posts = resp.data.posts
                        console.log(resp.data)
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            view_post: function(id) {
                window.location.href = 'https://travelbooking2018.000webhostapp.com/public/admin/post/show/' + id
            }
        }
    }
</script>
