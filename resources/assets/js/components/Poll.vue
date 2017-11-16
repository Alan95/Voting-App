<template>
    <div>
        <nav-voting></nav-voting>
        <br>
        <div class="jumbotron">
            <h3 class="text-center">{{ poll.title }}</h3>
        </div>
        <div class="card text-center">
            <div class="card-body">
                <ul v-for="choice in poll.choices">
                    <li>{{ choice.name}} {{ choice.votes }}</li>
                    <button class="btn btn-primary">Vote</button>
                </ul>    
            </div>
        </div>
        <custom-footer></custom-footer>    
    </div>
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue';

    export default {
        props: ['poll'],
        mounted() {
            console.log(this.poll);
        },
        data() {
            return {
                
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>