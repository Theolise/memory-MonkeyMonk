<style scoped>
    .title {
    text-align: center;
    }
</style>

<template>
    <div class="container">
       <h1 class="title my-4">Bienvenue</h1>

       <b-card
            title="Veuillez renseigner votre nom de joueur avant de pouvoir jouer"
            tag="username"
            class="mb-2"
        >
            <b-form-input v-model="text" placeholder="Entrez votre nom de joueur"></b-form-input>

            <div class="text-center">
                <b-button href="#" variant="primary" class="mt-2">Jouer !</b-button>
            </div>
        </b-card>
    </div>
</template>

<script>
    export default {};
</script>
