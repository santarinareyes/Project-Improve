//Variables
let random = document.querySelector(".random").value;
random = Math.trunc(Math.random() * 10 + 1);

let score = document.querySelector(".score");
score.textContent = 10;

const highscore = document.querySelector(".highscore");
highscore.textContent = 0;

const background = document.querySelector(".guessing");
const btnReset = document.querySelector(".reset");
const btnGuess = document.querySelector(".guess");
const texts = document.querySelector(".texts");
const onoff = document.querySelector(".number");

//Listeners
btnGuess.addEventListener("click", guessClicked);
btnReset.addEventListener("click", resetClicked);

//Functions
function guessClicked() {
  let newGuess = Number(document.querySelector(".number").value);
  if (!newGuess) {
    newText("Please write a numbers");
  } else if (newGuess === random) {
    newText("Good job");
    newHighscore();
    newBody();
    document.querySelector(".random").textContent = random;
    onoff.disabled = true;
  } else if (score.textContent > 1) {
    newText(newGuess > random ? "Guess is too high" : "Guess is too low");
    newScore();
  } else {
    score.textContent = 0;
    newText("You lost!");
    newBody();
    onoff.disabled = true;
  }
}

function newText(text) {
  texts.textContent = text;
}

function newScore() {
  score.textContent--;
}

function newHighscore() {
  highscore.textContent = score.textContent;
}

function newBody() {
  if (score.textContent > 1) {
    background.style.backgroundColor = "#008000";
  } else {
    background.style.backgroundColor = "#FF0000";
  }
}

function resetClicked() {
  random = Math.trunc(Math.random() * 10 + 1);
  score.textContent = 10;
  document.querySelector(".number").value = "";
  background.style.backgroundColor = "#FFFFFF";
  document.querySelector(".random").textContent = "?";
  newText("Good luck!");
  onoff.disabled = false;
}

document.addEventListener("keydown", function (button) {
  let auto = document.querySelector(".number");
  if (button.key === "Escape") {
    closeGame();
  } else if (auto.value > 0 && button.key === "Enter") {
    guessClicked();
    auto.value = "";
  } else if (!auto.value) {
    guessClicked();
  }
});
