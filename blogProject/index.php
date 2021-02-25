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
<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
          <!-- Blog Search Well -->
          <div class="well">
            <h4>Blog Search</h4>
            <form action="views/search.php" method="post">
            <div class="input-group">
              <input name="search" type="text" class="form-control" />
              <span class="input-group-btn">
                <button name="searchsubmit" class="btn btn-default" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
            </form> <!-- search form -->
            <!-- /.input-group -->
          </div>

          <!-- Blog Categories Well -->
          <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php 
                  showMenus('views/category.php');
                ?>
                </ul>
              </div>
            </div>
            <!-- /.row -->
          </div> 
          <!-- /. well -->

          <!-- Side Widget Well -->
          <?php include "includes/widget.php";?>
        </div>
</div> <!-- /.row -->
<hr/>
<?php include "includes/footer.php";?>