<?php include "includes/function.php";?>
<!-- Header -->
<?php include "includes/header.php"; ?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
<!-- Display blog posts -->
<?php landingPagePosts(); ?>
<!-- Display comments -->
<?php include "includes/comments.php";?>
<!-- Pager -->
<?php include "includes/pagination.php";?>
<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php";?>
</div> <!-- /.row -->
<hr/>
<?php include "includes/footer.php";?>