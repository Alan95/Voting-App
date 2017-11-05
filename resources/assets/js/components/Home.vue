<template>
<div>
    <nav-voting></nav-voting>
    <div class="main-text">
        <h1 class="display-3">Voting App</h1>
        <p class="lead">Create Polls and share your Polls with everyone!</p>
        <hr class="my-4">
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Register Now</a>
        </p>
    </div>
    <footer class="text-center">
        Copyright
        Made by Alan
    </footer>
</div>    
</template>

<script>
    import Nav from './Nav.vue'

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: {

        },
        computed: {

        },
        components: {
            'nav-voting': Nav 
        }
    }
</script>
