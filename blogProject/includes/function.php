<?php 
function search() {
    global $abc;
    if(isset($_POST["searchsubmit"])) {
        $search = $_POST["search"];
        $aftersearch = $abc->query("SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_content LIKE '%$search%'");
        $aftersearch2 = $abc->query("SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_content LIKE '%$search%'");
        $stm = $aftersearch2->fetch();
        
        if(!$aftersearch) {
            die("QUERY FAILED");
        }
        
        if ($search && $stm != 0) {
            while ($posts = $aftersearch->fetch()) {
              $ptitle = $posts["post_title"];
              $pauthor = $posts["post_author"];
              $pdate = $posts["post_date"];
              $pimage = $posts["post_img"];
              $pcontent = $posts["post_content"];
            ?>
                      <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                      </h1>
            
                      <!-- First Blog Post -->
                      <h2>
                        <a href="#"><?php echo $ptitle;?></a>
                      </h2>
                      <p class="lead">by <a href="index.php"><?php echo $pauthor?></a></p>
                      <p>
                        <span class="glyphicon glyphicon-time"></span>Posted on <?php echo $pdate;?>
                      </p>
                      <hr />
                      <img
                        class="img-responsive"
                        src="images/<?php echo $pimage; ?>"
                        alt=""
                      />
                      <hr />
                      <p>
                        <?php echo $pcontent;?>
                      </p>
                      <a class="btn btn-primary" href="#"
                        >Read More <span class="glyphicon glyphicon-chevron-right"></span
                      ></a>
            
                      <hr />
                      
            <?php }
        } else {
            echo "<h1>NO RESULTS!</h1>";
        }
    }
}
?>