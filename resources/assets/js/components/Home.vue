<template>
<div>
    <nav-voting></nav-voting> 
    <div class="main-text">
        <h1 class="display-3">Voting App</h1>
        <p class="lead">Create Polls and share them with everyone!</p>
        <hr class="my-4">
        <p class="lead">
            <a class="btn btn-primary btn-lg" role="button" href="/register">Register Now</a>
        </p>
    </div>
    <custom-footer></custom-footer>
</div>    
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue';
 
    export default {
        mounted() {
            
        },
        computed: {

        },
        data() {
            return {
                
            }
        },
        computed: {

        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        }
    }
</script>
