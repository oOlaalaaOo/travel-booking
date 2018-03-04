<template>
    <div></div>
</template>

<script>
    export default {
        name: 'tour-photo',
        props: ['tour_id'],
        data() {
            return {
                image: '',
                image_file: '',
                imgPrev: ''
            }
        },
        created: function() {
            this.displayImages()
        },
        methods: {
        }
    }
</script>
