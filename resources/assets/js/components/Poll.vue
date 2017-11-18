<template>
    <div>
        <nav-voting></nav-voting>
        <br>
        <div class="jumbotron">
            <h3 class="text-center">{{ poll.title }}</h3>
        </div>
        <template v-if="view == 'vote'">
        <ul class="list-group" v-for="(choice, ind) in poll.choices">
            <li class="list-group-item col-4 offset-4 d-flex justify-content-between align-items-center">{{ choice.name}} <button @click="vote(choice.name, ind)"class="btn btn-primary">Vote</button></li>
        </ul>  
        </template>
        <template v-if="view == 'result'">
            <h1>Results</h1>
        </template>
       <custom-footer></custom-footer>    
    </div>
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue';
    
    export default {
        props: ['poll'],
        mounted() {
           console.log(this.poll)
        },
        components: {
            
        },
        data() {
            return {
                view: 'vote'
            }
        },
        methods: {
            vote(choice, index) {
                var self = this;
                console.log(choice, index);
                 axios.post(`/poll/vote`, {
                        poll: self.poll,
                        choice: choice,
                        index: index
                    })
                    .then(response => {
                    this.view = 'result'
                    })
                    .catch(e => {
                    self.errors.push(e)
                    })
            }   
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>