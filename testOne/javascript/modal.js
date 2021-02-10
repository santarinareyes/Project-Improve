"use strict";

// Variables
const nimClicked = document.querySelector(".nim-game");
const nimOpen = document.querySelector(".nim");
const guessingClicked = document.querySelector(".guessing-game");
const guessingOpen = document.querySelector(".guessing");
const blur = document.querySelector(".blur");

// Listeners
nimClicked.addEventListener("click", showNim);
guessingClicked.addEventListener("click", showGuessing);
blur.addEventListener("click", closeGame);

// Functions
function showNim() {
  nimOpen.classList.remove("hidden");
  blur.classList.remove("hidden");
}

function showGuessing() {
  guessingOpen.classList.remove("hidden");
  blur.classList.remove("hidden");
}

function closeGame() {
  nimOpen.classList.add("hidden");
  guessingOpen.classList.add("hidden");
  blur.classList.add("hidden");
}

function escapeClose(key) {
  console.log(key);
}
