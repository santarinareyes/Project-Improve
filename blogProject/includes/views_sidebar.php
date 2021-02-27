<div class="col-md-4">
          <!-- Login Form -->
          <?php signedIn('../includes');?>
          
          <!-- Blog Search Well -->
          <div class="well">
            <h4>Blog Search</h4>
            <form action="search.php" method="post">
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

          <!-- Side Widget Well -->
          <?php include "../includes/widget.php"; ?>
        </div>