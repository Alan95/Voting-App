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
                    <th scope="col">Test</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                    <td>Test</td>
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
        components: {
            'nav-voting': Nav,
            'custom-footer': Footer
        },
    }
</script>