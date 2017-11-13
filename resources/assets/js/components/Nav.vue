<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/"><i class="fa fa-telegram" aria-hidden="true"></i> Voting</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>    
            <ul class="navbar-nav ml-auto">
                <template v-if="!user">
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Login</a>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">My Polls</a>
+                   </li>   
+                   <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>    
                </template>
                    <li class="nav-item">
                        <a class="nav-link" href="/polls">Polls</a>
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