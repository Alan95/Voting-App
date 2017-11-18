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
                </tr>
            </thead>
            <tbody>
                <tr v-for="poll in polls">
                <th scope="row">{{ poll.id }}</th>
                    <td class="poll-header">{{ poll.title }}</td>
                    <td ><li class="list-group-item d-flex justify-content-between align-items-center" v-for="choice in poll.choices">{{ choice.name }}<span class="badge badge-primary badge-pill">{{ choice.votes }}</span></li></td>
                    <td><a class="btn btn-primary" target="_blank" :href="currentRoute(poll.url)">Click</a></td>
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