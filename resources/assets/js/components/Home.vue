<template>
<div>
    <template v-if="user !== null">
        <nav-voting :user="user"></nav-voting>
    </template>
    <template v-else>
        <nav-voting></nav-voting>
    </template>      
    <div class="main-text">
        <h1 class="display-3">Voting App</h1>
        <p class="lead">Create Polls and share your Polls with everyone!</p>
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
        props: ["user"],
        mounted() {
            
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
