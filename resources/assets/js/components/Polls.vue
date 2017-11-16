<template>
    <div>
        <nav-voting></nav-voting>
        <br>
        <div class="jumbotron">
            <h3 class="text-center">Polls</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Choices</th>
                    <th scope="col">Link</th>
                    <th scope="col">Participants</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="poll in polls">
                <th scope="row">{{ poll.id }}</th>
                    <td>{{ poll.title }}</td>
                    <td>{{ poll.choices }}</td>
                    <td><a target="_blank" :href="currentRoute(poll.url)">Click</a></td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
        <custom-footer></custom-footer>    
    </div>
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue';

    export default {
        props: ['polls'],
        mounted() {
            console.log(this.polls);
        },
        data() {
            return {
                
            }
        },
        methods:{
            currentRoute(url) {
                return '/poll/' + url;
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>