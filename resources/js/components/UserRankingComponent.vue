<template>
    <div class="container">
        <b-table striped bordered :items="users"></b-table>

        <b-button @click="replay()">Rejouer</b-button>
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
        props: ['users']
    };
</script>