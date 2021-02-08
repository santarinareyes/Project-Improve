<?php 
define('TITLE', 'Games | Just For Fun');
include('includes/header.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['take_sticks'])) {
            $sticks_taken = intval($_POST['sticks_taken']);
           $take = $_POST['stickstaken'];
           $sticks_taken = $sticks_taken - $take;
           $sticks_left = $sticks_taken;
           if ($sticks_left < 1) {
               echo 'lost';
               $sticks_left = "";
           }
        } 
    } else {
    $sticks_left = 21;
 }

?>

<div class="games-column">
  <?php foreach ($gamesMenu as $game => $which) { ?>
    <button class="btn <?php echo $game;?>"><img class="game-img" src="img/<?php echo $game;?>.png" alt="<?php echo $which["title"]; ?>"><p class="game-name"><?php echo $which["title"];?></p></button>
    <?php }; ?>
</div>
  <div class="blur hidden"></div>

<div class="modal nim hidden">
      <div class="close-modal">
        <form action="" method="POST">
          <input type="number" name="stickstaken" min="0" max="3" value="3">
          <input type="submit" id="take_sticks" name="take_sticks" value="Take sticks" />
          <input type="hidden" id="sticks_taken" name="sticks_taken" value="<?php echo $sticks_left;?>" />   
        </form>
      </form>
    </div> <!-- close-modal -->
</div> <!-- modal hidden -->

<div class="modal guessing hidden">
<div class="first">
    <h1>Guess The Number</h1>
    <p>(1 - 10)</p>
    <h2 class="random">?</h2>
    <input type="number" min="0" max="10" class="number" />
    <button class="guess">Guess</button>
  </div>
  <div class="second">
    <p class="texts">Good luck!</p>
    <p>Current Score: <span class="score">10</span></p>
    <p>Highscore: <span class="highscore">0</span></p>
    <button class="reset">Start Over</button>
  </div>
</div> <!-- modal hidden -->

<?php include("includes/footer.php") ?>