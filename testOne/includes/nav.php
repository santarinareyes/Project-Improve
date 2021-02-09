<li>
    <!-- <a href="index.php" class="nav-item">Home</a>
    <a href="games.php" class="nav-item">Games</a>
    <a href="contact.php" class="nav-item">Contact</a> -->

    <?php
    foreach ($navItems as $item) {
        echo "<a class=\"nav-item\" href=\"$item[redirect]\">$item[title]</a>";
    }
    ?>

</li>