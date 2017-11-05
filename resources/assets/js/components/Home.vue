<template>
<div>
    <nav-voting></nav-voting>
    <div class="main-text">
        <h1 class="display-3">Voting App</h1>
        <p class="lead">Create Polls and share your Polls with everyone!</p>
        <hr class="my-4">
        <p class="lead">
            <a class="btn btn-primary btn-lg" role="button" href="/register">Register Now</a>
        </p>
    </div>
    <footer class="text-center rounded bg-dark">
        <div class="row">
            <div class="col margin-top-footer">
                <span class="text-white">Copyright © 2017</span>
            </div>
            <div class="col margin-top-footer">
                <span class="text-white">Made by Alan</span>
            </div>
            <div class="col">
                <button class="btn btn-secondary"><i class="fa fa-github text-white" aria-hidden="true"></i></button>
                <button class="btn btn-success"><i class="fa fa-free-code-camp" aria-hidden="true"></i></button>
                <button class="btn btn-primary"><i class="fa fa-linkedin-square" aria-hidden="true"></i></button>
            </div>
        </div>        
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
