<table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Author</th>
                          <th>Title</th>
                          <th>Menu</th>
                          <th>Status</th>
                          <th>Image</th>
                          <th>Tags</th>
                          <th>Comments</th>
                          <th>Date</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $getPosts = $abc->query("SELECT * FROM posts");
                  
                  while ($postsrow = $getPosts->fetch()) {
                      $vp_id = $postsrow["post_id"];
                      $vp_author = $postsrow["post_author"];
                      $vp_title = $postsrow["post_title"];
                      //   $vp_menu = $postsrow["post_title"];
                      $vp_status = $postsrow["post_status"];
                      $vp_img = $postsrow["post_img"];
                      $vp_tags = $postsrow["post_tags"];
                      $vp_comments = $postsrow["post_comment_count"];
                      $vp_date = $postsrow["post_date"];
                      
                      echo "
                      <tr>
                        <td> $vp_id</td>
                        <td> $vp_author</td>
                        <td> $vp_title</td>
                        <td>Placeholder</td>
                        <td> $vp_status</td>
                        <td><img src='../images/$vp_img' class='img-responsive' alt='image' style='max-height: 100px'></td>
                        <td> $vp_tags</td>
                        <td> $vp_comments</td>
                        <td> $vp_date</td>
                        </tr>
                        ";
                  }
                  ?>
                  </tbody>
              </table>