<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/"><i class="fa fa-telegram" aria-hidden="true"></i> Voting</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active" v-if="user">
                    <a class="nav-link" href="/profile">My Profile<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/polls">Polls</a>
                </li>
                 
            </ul>    
            <ul v-if="!user" class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Login</a>
                </li>
            </ul>    
            <ul v-if="user" class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
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
    }
</script>