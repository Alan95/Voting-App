<template>
    <div>
        <nav-voting :user="user"></nav-voting>
        <br>
        <div class="jumbotron">
            <h5 class="text-center">Welcome back, {{ user.name }} !</h5>
        </div>
        <div class="text-center">
            <div class="btn-group text-center">
                <button @click="activeView !== 'new' ? changeView('new') : activeView = null" class="btn btn-primary">New Poll</button>
                <button @click="activeView !== 'my' ? changeView('my') : activeView = null" class="btn btn-success">My Polls</button>
                <button @click="activeView !== 'edit' ? changeView('edit') : activeView = null" class="btn btn-secondary">Edit User</button>
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
                                <input :key="ind" class="form-control" :placeholder="'option '+ ++ind" type="text" :name="'option'+ ++ind" />
                            </template>
                        </div>
                        <button @click="addMoreOptions" style="margin-bottom: 15px;" class="btn btn-secondary">More Options</button>
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
        mounted() {
            console.log(this.user);
        },
        data() {
            return {
                activeView: 'new',
                poll: {
                    name: null,
                    options: [{}, {}, {}]
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
                self.poll.options.push({});
            },
            createNewPoll() {
                var self = this;
                
            }
        },
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>