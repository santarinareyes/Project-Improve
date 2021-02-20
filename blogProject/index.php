<!-- Header -->
<?php include "includes/header.php"; ?> 
<!-- Navigation -->
<?php include "includes/nav.php";?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
              <?php 
$dbposts = $abc->query("SELECT * FROM posts");

while ($posts = $dbposts->fetch()) {
  $ptitle = $posts["post_title"];
  $pauthor = $posts["post_author"];
  $pdate = $posts["post_date"];
  $pimage = $posts["post_img"];
  $pcontent = $posts["post_content"];
?>
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
            src="images/<?php echo $pimage; ?>"
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
<!-- Pager -->
<?php include "includes/pagination.php";?>
<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php";?>
</div> <!-- /.row -->
<hr/>
<?php include "includes/footer.php";?>