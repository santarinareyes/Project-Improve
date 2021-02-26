<?php include "../includes/function.php";?>
<!-- Header -->
<?php include "../includes/views_header.php"; ?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
<!-- Display blog posts -->
<?php categoryPagePosts(); ?>
<!-- Pager -->
<?php include "../includes/pagination.php";?>
<!-- Blog Sidebar Widgets Column -->
<?php include "../includes/views_sidebar.php";?>
</div> <!-- /.row -->
<hr/>
<?php include "../includes/footer.php";?>