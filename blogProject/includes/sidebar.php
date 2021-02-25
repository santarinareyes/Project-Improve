        <div class="col-md-4">
          <!-- Login Form -->
          <div class="well">
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
              <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Username"/>
              </div>
              <!-- /.input-group -->
              <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Password"/>
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit" name="login">Login
                  </button>
                </span>
              </div>
              <!-- /.input-group -->              
            </form> 
            <!-- login form -->
          </div>
          <!-- /. well -->

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
              <!-- /.input-group -->
            </form> 
            <!-- search form -->
          </div>
          <!-- /. well -->

          <!-- Blog Categories Well -->
          <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                  showCategories('views/category.php');
                  ?>
                </ul>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /. well -->
