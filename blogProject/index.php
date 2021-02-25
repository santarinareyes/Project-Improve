<?php include "includes/function.php";?>
<!-- Header -->
<?php include "includes/header.php"; ?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
<!-- Display blog posts -->
<h1 class='page-header'>
      Page Heading
      <small>Secondary Text</small>
      </h1>
<?php landingPagePosts(1); ?>
<!-- Pager -->
<?php include "includes/pagination.php";?>
<!-- Sidebar Widgets Column -->
<?php include "includes/sidebar.php";?>

          <!-- Side Widget Well -->
          <?php include "includes/widget.php";?>
        </div>
</div> <!-- /.row -->
<hr/>
<?php include "includes/footer.php";?>