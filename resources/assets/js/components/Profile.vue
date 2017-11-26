<template>
    <div>
        <nav-voting></nav-voting>
        <br>
        <div class="jumbotron">
            <h5 class="text-center">Welcome, {{ user.name }} !</h5>
        </div>
        <div class="text-center">
            <div class="btn-group text-center">
                <button @click="activeView !== 'new' ? changeView('new') : activeView = null" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> New Poll</button>
                <button @click="activeView !== 'my' ? changeView('my') : activeView = null" class="btn btn-success"><i class="fa fa-th-large" aria-hidden="true"></i> My Polls</button>
                <button @click="activeView !== 'edit' ? changeView('edit') : activeView = null" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i> Edit User</button>
            </div>
        </div>
        <br>
        <transition name="fade">
        <div class="card col-6 offset-md-3" v-if="activeView !== null && activeView === 'new'">
            <div class="card-body">
                <h4 class="card-title">New Poll</h4>
                <div v-if="showSuccessMessage" class="alert alert-success" role="alert">
                    Poll was created! <br> <span v-if="newUrl">Link: <a target="_blank" :href="routeToPoll(newUrl)">{{ showCurrentPath(newUrl) }}</a></span>
                </div>
                <div v-if="showErrorMessage" class="alert alert-danger" role="alert">
                    Error! Please try again later.
                </div>
                <p class="card-text">
                    <div class="form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="poll.name" name="name" />
                            <small class="form-text text-muted">The name of your poll.</small>
                        </div>
                        <div class="form-group">
                            <label>Options</label>
                            <template v-for="(option, ind) in poll.options">
                                <input :key="ind" class="form-control" type="text" v-model="poll.options[ind].name" :name="'option'+ ind" />
                                <br>
                            </template>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <button @click="addMoreOptions"  class="btn btn-secondary">More Options</button>
                            <button @click="reduceOptions" class="btn btn-danger">Less Options</button>
                        </div>
                        <br>
                        <button @click="createNewPoll" type="submit" class="btn btn-block btn-primary">Create Poll</button>
                    </div>
                </p>
             </div>   
        </div>    
        <div class="card col-6 offset-md-3" v-if="activeView !== null && activeView === 'my'">
            <div class="card-body">
                <h4 class="card-title">My Polls</h4>
                <p class="card-text" v-if="polls === null">
                    No Polls created.
                </p>
                <ul class="list-group" v-else>
                    <li class="list-group-item list-group-item-action list-group-item border-item" v-for="poll in polls">
                        <strong>{{ poll.title }}</strong> <br> <a target="_blank" :href="routeToPoll(poll.url)">{{ showCurrentPath(poll.url) }}</a> 
                        <button @click="deletePoll(poll)" class="btn btn-danger btn-xs pull-right trash">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>   
             </div>   
        </div> 
        <div class="card col-6 offset-md-3" v-if="activeView !== null && activeView === 'edit'">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <div v-if="showUserMessage" class="alert alert-success" role="alert">
                    User edited!
                </div>
                <div v-if="showUserFailMessage" class="alert alert-danger" role="alert">
                    Error! Please try again later.
                </div>
                <p class="card-text">
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" v-model="user.name" name="name" />
                     </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" v-model="user.email" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Set your new password" class="form-control" v-model="user.password" name="password" />
                    </div>
                    <br>
                    <button class="btn btn-success" @click="saveUserChanges()">Save</button>
                </p>
             </div>   
        </div> 
        </transition>
        <custom-footer></custom-footer>
    </div>
</template>

<script>
    import Nav from './Nav.vue';
    import Footer from './Footer.vue'
    export default {
        data() {
            return {
                activeView: 'new',
                polls: null,
                user: {
                    name: null,
                    email: null,
                    password: null
                },
                poll: {
                    name: null,
                    options: [{"votes": 0, "name": null}, {"votes": 0, "name": null}, { "votes": 0, "name": null}]
                },
                showSuccessMessage: false,
                showErrorMessage: false,
                showUserMessage: false,
                showUserFailMessage: false,
                newUrl: null
            }
            
        },
        methods: {
            changeView(view){
                var self = this;
                self.activeView = view;
            },
            addMoreOptions(){
                var self = this;
                self.poll.options.push({"votes": 0});
            },
            reduceOptions(){
                var self = this;
                self.poll.options.length > 1 ? self.poll.options.pop() : '';
            },
            showCurrentPath(url){
                return 'http://' + window.location.hostname + "/" + url;
            },
            createNewPoll() {
                var self = this;
                self.showSuccessMessage = false;
                self.showErrorMessage = false;
                self.newUrl = null;
                axios.post(`/createPoll`, {
                        name: self.poll.name,
                        options: self.poll.options
                    })
                    .then(response => {
                    self.newUrl = response.data; 
                    self.showSuccessMessage = true;
                    self.poll.name =  null;
                    self.poll.options = [{"name": null, "votes": 0}, {"name": null, "votes": 0}, {"name": null, "votes": 0}]
                    self.getPolls();
                    })
                    .catch(e => {
                    self.showErrorMessage = true;    
                    self.errors.push(e);
                    })
            },
            saveUserChanges() {
                var self = this;
                self.showUserMessage = false;
                self.showUserFailMessage = false;
                axios.post('/api/save', {
                        user: self.user
                    })
                    .then(response => {
                        self.getUser();
                        self.showUserMessage = true;
                    })
                    .catch(e => {
                        self.errors.push(e);
                        self.showUserFailMessage = true;
                    })
            },
            routeToPoll(url) {
                return '/poll/' + url;
            },
            getPolls() {
                var self = this;
                axios.get('/api/polls').then(response => { self.polls = response.data }).catch(e => { self.errors.push(e) });
            },
            getUser(){
                var self = this;
                axios.get('/api/user').then(response => { self.user = response.data }).catch(e => { self.errors.push(e) });
            },
            deletePoll(poll){
                var self = this;
                var confirmed = confirm("Delete this poll?");
                if(confirmed){
                    axios.delete('/api/delete/post/' + poll.id)
                    .then(response => {
                        self.getPolls();
                    })
                    .catch(e => {
                        self.errors.push(e)
                    });
                }
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
        mounted() {
            this.getPolls();
            this.getUser();
        },
    }
</script>