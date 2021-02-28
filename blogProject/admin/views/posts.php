<?php
include "../includes/admin_header.php";
?>
<div id="wrapper">
      <!-- Navigation -->
      <?php include "../includes/admin_nav.php";?>

      <div id="page-wrapper">
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">
                Posts
              </h1>
          <?php newPostSuccess();?>
              <!-- Table to show all posts -->
              <?php 
              if (isset($_GET["action"])) {
                $viewing_post_id = $_GET["action"];
              } else {
                  $viewing_post_id = '';
              }
                switch($viewing_post_id) {
                    case 'post_edit';
                    include "../includes/post_edit.php";
                    break;

                    case 'new_post';
                    include "../includes/new_post.php";
                    break;
                    
                    default:
                    include "../includes/view_posts.php";
                    break;
                }
                  ?>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
      <?php include "../includes/admin_footer.php";?>
