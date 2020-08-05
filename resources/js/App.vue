<style>
    .title {
      text-align: center;
    }
</style>

<template>
  <div id="app">
    <div>
      <h1 class="title">Memory</h1>
    </div>

    <register-component
      v-if="!user.username && !user.id && !endGame"
      v-bind:username="user.username"
      @register="register"
    >
    </register-component>

    <board-game-component
      v-if="user.username && user.id && !endGame"
      @updateScore="updateScore"
    >
    </board-game-component>

    <user-ranking-component
      v-if="endGame"
      v-bind:users="users"
      @replay="replay"
    >
    </user-ranking-component>
  </div>
</template>

<script>
  function User({ id, username, score}) {
    this.id = id;
    this.username = username;
    this.score = score;
  }

  function getDefaultData() {
    return {
        user: {
          id: null,
          username: null,
          score: null,
          lastScore: null
        },
        users: [],
        endGame: false
    }
}

  import BoardGameComponent from './components/BoardGameComponent.vue';
  import RegisterComponent from './components/RegisterComponent.vue';
  import UserRankingComponent from './components/UserRankingComponent.vue';

  export default {
    data: function() {
      return getDefaultData();
    },
    methods: {
      resetData: function () {
        Object.assign(this.$data, getDefaultData());
      },
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

            if(response.data.score !== null) {
              vm.user.lastScore = response.data.score;
            }
          })
          .catch(function (response) {
              console.log(response);
          });
      },
      async updateScore(score) {
        var vm = this;

        if (vm.user.lastScore === null || vm.user.lastScore > score) {
          let response = await window.axios.put(`/api/user/${vm.user.id}`, { 'score': score });
          vm.user.id = response.data.id;
          vm.user.username = response.data.username;
          vm.user.score = response.data.score;

          if(response.data.score !== null) {
            vm.user.lastScore = response.data.score;
          }
        } else {
          
        }

        vm.showUserRanking();
      },
      async showUserRanking() {
        var vm = this;

        let response = await window.axios.get(`/api/users`);

        vm.users = response.data;
        vm.endGame = true;
      },
      replay() {
        this.resetData()
      }
    },
    components: {
      BoardGameComponent,
      RegisterComponent,
      UserRankingComponent
    }
  }
</script>