<style>
    .title {
    text-align: center;
    }
</style>

<template>
  <div id="app" class="container">
    <div>
      <h1 class="title">Memory</h1>
    </div>

    <register-component
      v-bind:username="user.username"
      @register="register"
    ></register-component>
  </div>
</template>

<script>
  function User({ id, username, score}) {
    this.id = id;
    this.username = username;
    this.score = score;
  }

  import RegisterComponent from './components/RegisterComponent.vue';

  export default {
    data() {
      return {
        user: {
          id: null,
          username: null,
          score: null
        }
      }
    },
    methods: {
      async register(username) {
        var bodyFormData = new FormData();
        bodyFormData.set('username', username);

        var vm = this;

        axios({
          method: 'post',
          url: '/api/user',
          data: bodyFormData,
          headers: {'Content-Type': 'multipart/form-data' }
          })
          .then(function (response) {
              vm.user.id = response.data.id;
              vm.user.username = response.data.username;
              vm.user.score = response.data.score;
          })
          .catch(function (response) {
              console.log(response);
          });
      },
    },
    components: {
      RegisterComponent
    }
  }
</script>