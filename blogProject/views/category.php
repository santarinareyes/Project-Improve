<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die( header( 'location:../index.php' ) );
    }
?>
<?php include "../includes/function.php";?>
<!-- Header -->
<?php include "../includes/views_header.php"; ?> 
<!-- Page Content -->
<div class="container">
      <div class="row">
              <!-- Blog Entries Column -->
              <div class="col-md-8">
<!-- Display blog posts -->
      <?php displayCat();?>
<?php categoryPagePosts(); ?>
<!-- Pager -->
<?php include "../includes/pagination.php";?>
<!-- Blog Sidebar Widgets Column -->
<?php include "../includes/views_sidebar.php";?>
</div> <!-- /.row -->
<hr/>
<?php include "../includes/footer.php";?>