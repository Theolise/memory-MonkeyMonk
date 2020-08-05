<template>
    <div class="container">
        <b-alert show>{{ message }}</b-alert>
        <b-table striped bordered :items="users"></b-table>

        <div class="text-center">
            <b-button @click="replay()">Rejouer</b-button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {}
        },
        methods: {
            replay() {
                this.$emit('replay');
            }
        },
        props: ['users', 'message']
    };
</script>