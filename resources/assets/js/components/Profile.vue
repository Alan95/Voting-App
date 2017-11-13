<template>
    <div>
        <nav-voting :user="user"></nav-voting>
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
                <p class="card-text">

                    No Polls created.
                </p>
             </div>   
        </div> 
        <div class="card col-6 offset-md-3" v-if="activeView !== null && activeView === 'edit'">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
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
                    <button class="btn btn-success">Save</button>
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
        props: ["user", "polls"],
        data() {
            return {
                activeView: 'new',
                poll: {
                    name: null,
                    options: [{"votes": 0, "name": null}, {"votes": 0, "name": null}, { "votes": 0, "name": null}]
                }
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
            createNewPoll() {
                var self = this;
                axios.post(`/createPoll`, {
                        name: self.poll.name,
                        options: self.poll.options
                    })
                    .then(response => {
                    window.alert("Saved");
                    self.poll.name =  null;
                    self.poll.options = [{"name": null, "votes": 0}, {"name": null, "votes": 0}, {"name": null, "votes": 0}]
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