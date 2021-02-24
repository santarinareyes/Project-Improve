<?php

// Search in the database and display from the searchbar
function search()
{
  global $abc;
  if (isset($_POST["searchsubmit"])) {
    $search = $_POST["search"];
    $aftersearch = $abc->query("SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_content LIKE '%$search%'");
    $aftersearch2 = $abc->query("SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_content LIKE '%$search%'");
    $stm = $aftersearch2->fetch();

    if (!$aftersearch) {
      die("QUERY FAILED");
    }

    if ($search && $stm != 0) {
      while ($posts = $aftersearch->fetch()) {
        $ptitle = $posts["post_title"];
        $pauthor = $posts["post_author"];
        $pdate = $posts["post_date"];
        $pimage = $posts["post_img"];
        $pcontent = $posts["post_content"];

        echo "
        <h1 class='page-header'>
        Page Heading
        <small>Secondary Text</small>
        </h1>
        
        <h2>
        <a href='#'>$ptitle;?></a>
        </h2>
        <p class='lead'>by <a href='index.php'>$pauthor?></a></p>
        <p>
        <span class='glyphicon glyphicon-time'></span>Posted on $pdate;?>
        </p>
        <hr />
        <img class='img-responsive' src='images/$pimage' alt='$ptitle' />
        <hr />
        <p>
        $pcontent;?>
        </p>
        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
        
        <hr />
        ";
      }
    } else {
      echo '<h1>NO RESULTS!</h1>';
    }
  }
}

// Functions to display the navs (Menu/Category) from database
function showMenus()
{
  global $abc;
  $getNav = $abc->query("SELECT * FROM menus");

  while ($menus = $getNav->fetch()) {
    $menu = $menus['menu_title'];
    $menu_id = $menus['menu_id'];
    echo "<li><a href='category.php?category=$menu_id.php'>$menu</a></li>";
  }
}

// Show all posts
function landingPagePosts()
{
  global $abc;

  if (isset($_GET["reading"])) {
    $readingid = $_GET["reading"];

    $dbposts = $abc->query("SELECT * FROM posts WHERE post_id = $readingid");

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent = $posts["post_content"];

      echo "
      <h1 class='page-header'>
      Page Heading
      <small>Secondary Text</small>
      </h1>
      
      <h2>
      <a href='post.php?reading=$pid'>$ptitle</a>
      </h2>
      <p class='lead'>by <a href='index.php'>$pauthor</a></p>
      <p>
      <span class='glyphicon glyphicon-time'></span>Posted on $pdate
      </p>
      <hr />
      <img
      class='img-responsive'
      src='images/$pimage'
      alt=''
      />
      <hr />
      <p>
      $pcontent
      </p>
      <a class='btn btn-primary' href='#'
      >Read More <span class='glyphicon glyphicon-chevron-right'></span
      ></a>
      
      <hr />
      ";
    }
  } else {

    $dbposts = $abc->query("SELECT * FROM posts");

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent = $posts["post_content"];

      echo "      
      <h2>
      <a href='post.php?reading=$pid'>$ptitle</a>
      </h2>
      <p class='lead'>by <a href='index.php'>$pauthor</a></p>
      <p>
      <span class='glyphicon glyphicon-time'></span>Posted on $pdate
      </p>
      <hr />
      <img
      class='img-responsive'
      src='images/$pimage'
      alt=''
      />
      <hr />
      <p>
      $pcontent
      </p>
      <a class='btn btn-primary' href='#'
      >Read More <span class='glyphicon glyphicon-chevron-right'></span
      ></a>
      
      <hr />
      ";
    }
  }
}

// Show posts related to the category
function categoryPagePosts() {
  global $abc;
  if (isset($_GET["category"])) {
  $category_id = $_GET["category"];

    $dbposts = $abc->query("SELECT * FROM posts WHERE post_menu_id = '$category_id'");

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent = $posts["post_content"];

      echo "
      <h1 class='page-header'>
      Page Heading
      <small>Secondary Text</small>
      </h1>
      
      <h2>
      <a href='post.php?reading=$pid'>$ptitle</a>
      </h2>
      <p class='lead'>by <a href='index.php'>$pauthor</a></p>
      <p>
      <span class='glyphicon glyphicon-time'></span>Posted on $pdate
      </p>
      <hr />
      <img
      class='img-responsive'
      src='images/$pimage'
      alt=''
      />
      <hr />
      <p>
      $pcontent
      </p>
      <a class='btn btn-primary' href='#'
      >Read More <span class='glyphicon glyphicon-chevron-right'></span
      ></a>
      
      <hr />
      ";
    }
  }
}