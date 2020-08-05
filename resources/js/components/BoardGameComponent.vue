<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .board {
        height: 100vh;
        display: flex;
    }

    .memory-game {
        width: 640px;
        height: 640px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        perspective: 1000px;
    }

    .memory-card {
        width: calc(25% - 10px);
        height: calc(33.333% - 10px);
        margin: 5px;
        position: relative;
        transform: scale(1);
        transform-style: preserve-3d;
        transition: transform .5s;
        box-shadow: 1px 1px 1px rgba(0,0,0,.3);
    }

    .memory-card:active {
        transform: scale(0.97);
        transition: transform .2s;
    }

    .memory-card.flip {
        transform: rotateY(180deg);
    }

    .front-face,
    .back-face {
        width: 100%;
        height: 100%;
        padding: 20px;
        position: absolute;
        border-radius: 5px;
        background: #1C7CCC;
        backface-visibility: hidden;
    }

    .front-face {
        transform: rotateY(180deg);
    }
</style>

<template>
<div>
    <p class="ml-3">Votre score : {{ score }}</p>
    <p class="ml-3 mt-2" v-if="lastScore !== null">Votre meilleur score : {{ lastScore }}</p>

    <div class="board">
        <section class="memory-game">
            <div
                v-for="card in cards"
                :key="card.key"
                :class="getClassMemoryCard(card)"
                v-bind:data-framework="card.name"
                v-on:click="flipCard(card)"
            >
                <img class="front-face" :src="getImageUrl(card.path)" v-bind:alt="card.name"/>
                <img class="back-face" src="../../../public/images/Logo-Monkey-Monk.png" alt="logoMM"/>
            </div>
        </section>
    </div>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                cards: [
                    { "key": "sylvain1", "name": "sylvain", "path": "sylvain.jpg", "click": true, "class": "" },
                    { "key": "sylvain2", "name": "sylvain", "path": "sylvain.jpg", "click": true, "class": "" },
                    { "key": "tony1", "name": "tony", "path": "tony.jpg", "click": true, "class": "" },
                    { "key": "tony2", "name": "tony", "path": "tony.jpg", "click": true, "class": "" },
                    { "key": "fred1", "name": "fred", "path": "fred.jpg", "click": true, "class": "" },
                    { "key": "fred2", "name": "fred", "path": "fred.jpg", "click": true, "class": "" },
                    { "key": "juliette1", "name": "juliette", "path": "juliette.jpg", "click": true, "class": "" },
                    { "key": "juliette2", "name": "juliette", "path": "juliette.jpg", "click": true, "class": "" },
                    { "key": "kevin1", "name": "kevin", "path": "kevin.jpg", "click": true, "class": ""},
                    { "key": "kevin2", "name": "kevin", "path": "kevin.jpg", "click": true, "class": "" },
                    { "key": "killian1", "name": "killian", "path": "killian.jpg", "click": true, "class": "" },
                    { "key": "killian2", "name": "killian", "path": "killian.jpg", "click": true, "class": "" },
                    { "key": "laurent1", "name": "laurent", "path": "laurent.jpg", "click": true, "class": "" },
                    { "key": "laurent2", "name": "laurent", "path": "laurent.jpg", "click": true, "class": "" },
                    { "key": "paul1", "name": "paul", "path": "paul.jpg", "click": true, "class": "" },
                    { "key": "paul2", "name": "paul", "path": "paul.jpg", "click": true, "class": "" }
                ],
                hasFlippedCard: false,
                lockBoard: false,
                firstCard: {},
                secondCard: {},
                score: 0,
                numberPairsFound: 0,
                endGame: false
            }
        },
        created: function () {
            this.shuffle(this.cards);
        },
        methods: {
            shuffle(array) {
                var currentIndex = array.length, temporaryValue, randomIndex;

                while (0 !== currentIndex) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;

                    temporaryValue = array[currentIndex];
                    array[currentIndex] = array[randomIndex];
                    array[randomIndex] = temporaryValue;
                }

                return array;
            },
            getClassMemoryCard(card) {
                return ('memory-card ' + card.class);
            },
            getImageUrl(path) {
                return require('../../../public/images/' + path);
            },
            flipCard(card) {
                var vm = this;

                if (vm.lockBoard) return;
                if (card === vm.firstCard) return;

                card.class = "flip";

                if (!vm.hasFlippedCard) {
                    vm.hasFlippedCard = true;
                    vm.firstCard = card;

                    return;
                }

                vm.secondCard = card;

                vm.checkForMatch();
            },
            checkForMatch() {
                var vm = this;

                let isMatch = vm.firstCard.name === vm.secondCard.name;

                vm.score = vm.score + 1;

                isMatch ? vm.disableCards() : vm.unflipCards();
            },
            disableCards() {
                var vm = this;

                vm.numberPairsFound = vm.numberPairsFound + 1;

                let firstCardToDisabled = vm.cards.find(x => x.key === vm.firstCard.key);
                let firstCardIndex = vm.cards.indexOf(firstCardToDisabled);

                let secondCardToDisabled = vm.cards.find(x => x.key === vm.secondCard.key);
                let secondCardIndex = vm.cards.indexOf(secondCardToDisabled);

                vm.cards[firstCardIndex].click = false;
                vm.cards[secondCardIndex].click = false;

                vm.resetBoard();
            },
            unflipCards() {
                var vm = this;

                vm.lockBoard = true;

                setTimeout(() => {
                    let firstCardToUnflip = vm.cards.find(x => x.key === vm.firstCard.key);
                    let firstCardIndex = vm.cards.indexOf(firstCardToUnflip);

                    let secondCardToUnflip = vm.cards.find(x => x.key === vm.secondCard.key);
                    let secondCardIndex = vm.cards.indexOf(secondCardToUnflip);

                    vm.cards[firstCardIndex].class = "";
                    vm.cards[secondCardIndex].class = "";

                    vm.resetBoard();
                }, 1500);
            },
            resetBoard() {
                var vm = this;

                [vm.hasFlippedCard, vm.lockBoard] = [false, false];
                [vm.firstCard, vm.secondCard] = [null, null];

                if (vm.numberPairsFound === 8) {
                    vm.endGame = true;
                    this.$emit('updateScore', vm.score);
                }
            }
        },
        props: ['lastScore']
    };
</script>