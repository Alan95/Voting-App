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
           console.log(this.pollid);
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
                axios.get('/api/poll/' + self.pollid).then(response => { self.poll = response.data }).catch(e => { self.errors.push(e)})
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
                    self.switchViewToResult();
                    self.poll = response.data;
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
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>