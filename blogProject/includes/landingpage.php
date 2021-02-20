<?php 
$dbposts = $abc->query("SELECT * FROM posts");

while ($posts = $dbposts->fetch()) {
  $ptitle = $posts["post_title"];
  $pauthor = $posts["post_author"];
  $pdate = $posts["post_date"];
  $pimage = $posts["post_img"];
  $pcontent = $posts["post_content"];
?>
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
          </h1>

          <!-- First Blog Post -->
          <h2>
            <a href="#"><?php echo $ptitle;?></a>
          </h2>
          <p class="lead">by <a href="index.php"><?php echo $pauthor?></a></p>
          <p>
            <span class="glyphicon glyphicon-time"></span>Posted on <?php echo $pdate;?>
          </p>
          <hr />
          <img
            class="img-responsive"
            src="http://placehold.it/900x300"
            alt=""
          />
          <hr />
          <p>
            <?php echo $pcontent;?>
          </p>
          <a class="btn btn-primary" href="#"
            >Read More <span class="glyphicon glyphicon-chevron-right"></span
          ></a>

          <hr />
<?php } ?>
<!--
            Second Blog Post
          <h2>
            <a href="#">Blog Post Title</a>
          </h2>
          <p class="lead">by <a href="index.php">Start Bootstrap</a></p>
          <p>
            <span class="glyphicon glyphicon-time"></span> Posted on August 28,
            2013 at 10:45 PM
          </p>
          <hr />
          <img
            class="img-responsive"
            src="http://placehold.it/900x300"
            alt=""
          />
          <hr />
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam,
            quasi, fugiat, asperiores harum voluptatum tenetur a possimus
            nesciunt quod accusamus saepe tempora ipsam distinctio minima
            dolorum perferendis labore impedit voluptates!
          </p>
          <a class="btn btn-primary" href="#"
            >Read More <span class="glyphicon glyphicon-chevron-right"></span
          ></a>

          <hr />

          Third Blog Post
          <h2>
            <a href="#">Blog Post Title</a>
          </h2>
          <p class="lead">by <a href="index.php">Start Bootstrap</a></p>
          <p>
            <span class="glyphicon glyphicon-time"></span> Posted on August 28,
            2013 at 10:45 PM
          </p>
          <hr />
          <img
            class="img-responsive"
            src="http://placehold.it/900x300"
            alt=""
          />
          <hr />
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam
            accusantium laudantium adipisci architecto itaque dicta aperiam
            maiores provident id incidunt autem. Magni, ratione.
          </p>
          <a class="btn btn-primary" href="#"
            >Read More <span class="glyphicon glyphicon-chevron-right"></span
          ></a>

          <hr />
-->