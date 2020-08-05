<template>
    <div class="container">
        <b-alert show variant="danger" v-if="message !== ''">{{ message }}</b-alert>

        <b-card
            title="Veuillez renseigner votre nom de joueur avant de pouvoir jouer."
            tag="username"
            class="mb-2"
        >
            <b-form-input
                v-bind:value="usernameInput"
                v-on:change="usernameInput = $event"
                placeholder="Entrez votre nom de joueur"
            >
            </b-form-input>

            <div class="text-center">
                <b-button href="#" variant="primary" class="mt-2" @click="register(usernameInput)">Jouer !</b-button>
            </div>
        </b-card>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                usernameInput: null
            }
        },
        methods: {
            register(usernameInput) {
                this.$emit('register', usernameInput);
            }
        },
        props: ['username', 'message']
    };
</script>
