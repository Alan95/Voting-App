<template>
    <div>
        <nav-voting></nav-voting>
        <br>
        <template v-if="view == 'vote'">
            <div class="jumbotron">
                <h3 class="text-center">{{ poll.title }}</h3>
            </div>
            <button @click="switchViewToEdit" v-if="user == user_id" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>  
            <ul class="list-group" v-for="(choice, ind) in poll.choices">
                <li class="list-group-item col-4 offset-4 d-flex justify-content-between align-items-center">{{ choice.name}} 
                    <button @click="vote(choice.name, ind)"class="btn btn-primary">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </button>
                </li>
            </ul>  
        </template>
        <template v-if="view == 'result'">
            <div class="jumbotron">
                <h3 class="text-center">{{ poll.title }} - Results</h3>
            </div>
            <div class="row">
                <div class="col-5">
                    <ul class="list-group resultlist">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="choice in poll.choices">
                            {{ choice.name }} <span class="badge badge-secondary badge-pill">{{ choice.votes }}</span>
                        </li>    
                     </ul>   
                     <br>
                     <div class="text-center">
                        <button class="btn btn-secondary" @click="switchViewToVote">Back</button>
                     </div>
                </div>
                <div class="col-7">
                    <vue-chart type="pie" :data="chartData"></vue-chart>
                </div>        
            </div>

        </template>
        <template v-if="view == 'edit'">
            <div class="jumbotron">
                <h3 class="text-center">{{ poll.title }} - Edit</h3>
            </div>
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="form-group title-input">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="poll.title"/>
                    </div>
                    <div class="form-group">
                        <ul class="list-group resultlist">
                            <template v-for="(choice, ind) in poll.choices">
                                <label>Option - {{ ind }}</label>
                                <input v-model="choice.name" class="list-group-item d-flex justify-content-between align-items-center" >
                            </template>
                        </ul> 
                    </div>  
                    <div class="text-center"> 
                        <button @click="switchViewToVote" class="btn btn-danger">Back</button>
                        <button class="btn btn-primary" @click="updatePoll">Save</button>   
                    </div>  
                </div>        
            </div>
        </template>     
       <custom-footer></custom-footer>    
    </div>
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue';
    import VueChart from 'vue-chart-js'
    
    export default {
        props: ['pollid'],
        mounted() {
           this.$store.dispatch('fetchUser')
           this.getPoll();
        },
        components: {
           VueChart
        },
        data() {
            return {
                view: 'vote',
                poll: {
                    id: null,
                    name: null,
                    choices: {},
                },
                user_id: null,
                chartData: {
                    labels: [],
                    datasets: [
                        {
                            label: 'Component 1',
                            data: [],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ]
                        },
                    ]
                },
                errors: []
            }
        },
        methods: {
            getPoll() {
                var self = this;
                axios.get('/api/poll/' + self.pollid)
                    .then(response => { 
                        self.poll = response.data;
                        self.user_id = response.data.user_id;
                    })
                    .catch(e => { 
                        self.errors.push(e)
                    })
            },
            vote(choice, index) {
                var self = this;
                console.log(choice, index);
                 axios.post(`/poll/vote`, {
                        poll: self.poll,
                        choice: choice,
                        index: index
                    })
                    .then(response => {
                        self.poll = response.data;    
                        self.switchViewToResult();
                    })
                    .catch(e => {
                        self.errors.push(e)
                    })
            },
            visualizePoll(){
                this.chartData.labels = [];
                this.chartData.datasets[0].data = [];
                this.poll.choices.forEach((item) => {
                    this.chartData.labels.push(item.name);
                    if(item.votes !== null){
                       this.chartData.datasets[0].data.push(item.votes);
                    }
                });


            },
            switchViewToResult(){
                this.visualizePoll();
                this.view = 'result';
            },
            switchViewToVote(){
                this.view = 'vote';
            },
            switchViewToEdit(){
                this.view = 'edit';
            },
            updatePoll(){
                var self = this;
                axios.patch('/api/poll/' + self.user_id, {
                        poll: self.poll
                    })
                    .then(response => {
                        console.log(response.data)
                        alert("Updated");
                        self.view = 'vote';
                    })
                    .catch(e => {
                        self.errors.push(e)
                    })
            },
        },
        computed: {
            user() {
                return this.$store.getters.user.id
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>