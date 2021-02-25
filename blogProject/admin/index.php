<?php include "includes/index_header.php";?>
<div id="wrapper">
      <!-- Navigation -->
      <?php include "includes/index_nav.php";?>

      <div id="page-wrapper">
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">
                Welcome
                <small><?php echo $_SESSION['firstname'];?></small>
              </h1>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
      <?php include "includes/admin_footer.php";?>
