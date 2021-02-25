<?php include "../includes/function.php";?>
<!-- Header -->
<?php include "../includes/views_header.php"; ?> 
<!-- Navigation -->
<?php include "../includes/nav.php";?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
<?php search();?>

<!-- Pager -->
<?php include "../includes/pagination.php";?>
<!-- Blog Sidebar Widgets Column -->
<?php include "../includes/sidebar.php";?>
</div> <!-- /.row -->
<hr/>
<?php include "../includes/footer.php";?>