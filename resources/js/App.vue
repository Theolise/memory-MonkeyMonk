<template>
  <div id="app">
    <div class="heading">
      <h1>Memory</h1>
    </div>

    <register-component></register-component>
  </div>
</template>

<script>

  import RegisterComponent from './components/RegisterComponent.vue';

  export default {
    data() {
      return {
      }
    },
    methods: {
    },
    components: {
      RegisterComponent
    }
  }
</script>