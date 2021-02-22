<?php include "includes/admin_header.php";?>
<div id="wrapper">
      <!-- Navigation -->
      <?php include "includes/admin_nav.php";?>

      <div id="page-wrapper">
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">
              Add or edit a menu/category
                <small>Author</small>
              </h1>
              <!-- Menu add form -->
              <div class="col-xs-6">
                  <div class="form-group">
                      <form action="" method="post">
                          <label for="menu_title">Add a new menu/category</label>
                          <input class="form-control" type="text" name="menu_title">
                        </div>
                        <div class="form-group">
                            <input name="menu_add" class="btn btn-primary" type="submit" value="Add Menu">
                        </div>
                        <?php adminAddMenu();?>
                        <?php adminEdit();?>
                  </form>
              </div>                    
              <!-- /.Menu add form -->
              <!-- The table for Id/Menu -->
              <div class="col-xs-6">
                  <table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Menu Title</th>
                          </tr>
                      </thead>
                      <tbody>
                              <?php adminShowMenus();?>                            
                      </tbody>
                  </table>
              </div>
              <!-- End of id/menu -->                
              <!-- /.Menu add form -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
      <?php include "includes/admin_footer.php";?>
