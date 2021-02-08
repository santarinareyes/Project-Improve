<?php
    define("TITLE", "About Us | Just For Fun");    
    include('includes/header.php');
?>
<div class="about-us">
  <div class="team-members">
    <h1>Who are we?</h1>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque
      possimus excepturi sint, dicta veritatis dolore? Ut facere vel provident
      corrupti veritatis iure placeat est reprehenderit quidem illo autem
      blanditiis, fuga aliquam sequi, alias architecto aut pariatur quibusdam
      amet harum eum similique ullam. Veniam vitae earum voluptatibus illo dolor
      consequuntur voluptates.
    </p>
  </div>
  <!-- team-teambers -->

  <div class="members-column">
    <?php
              foreach ($teamMembers as $member) {
          ?>

    <div class="member">
      <img class="member-img-size" src="img/<?php echo $member["img"]?>.png"
      alt="<?php echo $member["name"];?>">
      <h2><?php echo $member["name"];?></h2>
      <p class="team-bio"><?php echo $member["bio"];?></p>
    </div>
    <!-- member -->
    <?php
              }
              ?>
  </div>
  <!-- members-column -->
</div>
<!-- about-us -->


<?php
    include('includes/footer.php');
?>