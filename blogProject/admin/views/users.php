<?php
include "../includes/admin_header.php";
include "../../includes/db.php";
adminNewUser();
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
                <small>Author</small>
              </h1>
              <!-- Table to show all users -->
              <?php 
              if (isset($_GET["action"])) {
                $viewing_user_id = $_GET["action"];
              } else {
                  $viewing_user_id = '';
              }
                switch($viewing_user_id) {
                    case 'edit_user';
                    include "../includes/user_edit.php";
                    break;

                    case 'new_user';
                    include "../includes/new_user.php";
                    break;
                    
                    default:
                    include "../includes/view_users.php";
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
