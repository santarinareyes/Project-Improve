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
        $pid = $posts["post_id"];
        $ptitle = $posts["post_title"];
        $pauthor = $posts["post_author"];
        $pdate = $posts["post_date"];
        $pimage = $posts["post_img"];
        $pcontent1 = $posts["post_content"];
        $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));

        echo "
        <h2>
        <a href='post.php?reading=$pid'>$ptitle</a>
        </h2>
        <p class='lead'>by <a href='index.php'>$pauthor</a></p>
        <p>
        <span class='glyphicon glyphicon-time'></span>Posted on $pdate
        </p>
        <hr />
        <img class='img-responsive' src='../images/$pimage' alt='$ptitle' />
        <hr />
        <p>
        $pcontent
        </p>
        <a class='btn btn-primary' href='post.php?reading=$pid'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
        
        <hr />
        ";
      }
    } else {
      echo "<h1>Couldn't find what you were looking for.</h1>";
    }
  }
}

// Functions to display the navs (Menu/Category) from database
function showCategories($link)
{
  global $abc;
  $getNav = $abc->query("SELECT * FROM menus");

  while ($menus = $getNav->fetch()) {
    $menu = $menus['menu_title'];
    $menu_id = $menus['menu_id'];
    echo "<li><a href='$link?category=$menu_id.php'>$menu</a></li>";
  }
}

// Show all posts
function landingPagePosts($readmore)
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

      if ($readmore == 1) {
        echo "    
        <h2>
        <a href='views/post.php?reading=$pid'>$ptitle</a>
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
      } else {
        echo "    
        <h2>
        <a href='#'>$ptitle</a>
        </h2>
        <p class='lead'>by <a href='#'>$pauthor</a></p>
        <p>
        <span class='glyphicon glyphicon-time'></span>Posted on $pdate
        </p>
        <hr />
        <img
        class='img-responsive'
        src='../images/$pimage'
        alt=''
        />
        <hr />
        <p>
        $pcontent
        </p>
        <hr />
        ";
      }
    }
  } else {

    $dbposts = $abc->query("SELECT * FROM posts");

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent1 = $posts["post_content"];
      $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));

      echo "      
      <h2>
      <a href='views/post.php?reading=$pid'>$ptitle</a>
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
      <a class='btn btn-primary' href='views/post.php?reading=$pid'
      >Read More <span class='glyphicon glyphicon-chevron-right'></span
      ></a>
      
      <hr />
      ";
    }
  }
}

// Show posts related to the category
function categoryPagePosts()
{
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
      $pcontent1 = $posts["post_content"];
      $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));

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
      src='../images/$pimage'
      alt=''
      />
      <hr />
      <p>
      $pcontent
      </p>
      <a class='btn btn-primary' href='post.php?reading=$pid'
      >Read More <span class='glyphicon glyphicon-chevron-right'></span
      ></a>
      
      <hr />
      ";
    }
  }
}

// Show admin nav
function showAdminNav($views)
{
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin' && $views === 0) {
      echo "
      <li>
      <a href='admin'>Admin</a>
      </li>
      ";
    } else if ($_SESSION['role'] == 'Admin' && $views === 1) {
      echo "
      <li>
      <a href='../admin'>Admin</a>
      </li>
      ";
    }
  }
}

// Sign in
function signIn()
{
  global $abc;
  if (isset($_POST["sign_in"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stm = $abc->prepare("SELECT * FROM users WHERE username = :name");
    $stm->bindParam(":name", $username);
    $stm->execute();

    while ($rows = $stm->fetch()) {
      $user_id = $rows['user_id'];
      $db_username = $rows['username'];
      $db_password = $rows['user_password'];
      $user_firstname = $rows['user_firstname'];
      $user_lastname = $rows['user_lastname'];
      $user_role = $rows['user_role'];
    }

    if (password_verify($password, $db_password)) {
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $user_firstname;
      $_SESSION['lastname'] = $user_lastname;
      $_SESSION['role'] = $user_role;

      header("location:../index.php");
    } else {
      header("location:../index.php");
    }
  }
}

// This will switch between signed in and sign in
function signedIn($link)
{
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "
    <div class='well'>
    <h4>Signed in as</h4>
    <form action='$link/signout.php' method='post'>
    <div class='input-group'>
    <input type='text' class='form-control' placeholder='$username' disabled/>
    <span class='input-group-btn'>
    <button class='btn btn-primary' type='submit' name='sign_out'>Sign out
    </button>
    </span>
    </div>
    </form> 
    </div>
    ";
  } else {
    echo "
    <div class='well'>
    <h4>Sign in</h4>
    <form action='$link/login.php' method='post'>
    <div class='form-group'>
    <input name='username' type='text' class='form-control' placeholder='Username'/>
    </div>
    <div class='input-group'>
    <input name='password' type='password' class='form-control' placeholder='Password'/>
    <span class='input-group-btn'>
    <button class='btn btn-primary' type='submit' name='sign_in'>Sign in
    </button>
    </span>";
    btnRegister($link);
    echo "
    </div>
    </form>
    </div>
    ";
  }
}

// Display register button
function btnRegister($link)
{
  if ($link === 'includes') {
    echo "
    <span class='input-group-btn'>
    <a class='btn' href='views/register.php'>Click here to register.</a>
    </span>
    ";
  } else {
    echo "
    <span class='input-group-btn'>
    <a class='btn' href='register.php'>Click here to register.</a>
    </span>
    ";
  }
}

// The register procedure
function registerAcc()
{
  if (isset($_SESSION['username'])) {
    echo "Please sign out if you want to register another account.";
  } else {
    echo "
  <form
  role='form'
  action='registration.php'
  method='post'
  id='login-form'
  autocomplete='off'
  >
  <div class='form-group'>
    <label for='username' class='sr-only'>Username</label>
    <input
      type='text'
      name='username'
      id='username'
      class='form-control'
      placeholder='Username'
    />
  </div>
  <div class='form-group'>
    <label for='email' class='sr-only'>Email</label>
    <input
      type='email'
      name='email'
      id='email'
      class='form-control'
      placeholder='example@example.com'
    />
  </div>
  <div class='form-group'>
    <label for='firstname' class='sr-only'>Firstname</label>
    <input
      type='text'
      name='firstname'
      id='firstname'
      class='form-control'
      placeholder='Firstname'
    />
  </div>
  <div class='form-group'>
    <label for='lastname' class='sr-only'>Lastname</label>
    <input
      type='text'
      name='lastname'
      id='lastname'
      class='form-control'
      placeholder='Lastname'
    />
  </div>
  <div class='form-group'>
    <label for='password' class='sr-only'>Password</label>
    <input
      type='password'
      name='password'
      id='key'
      class='form-control'
      placeholder='Password'
    />
  </div>
  <input
    type='submit'
    name='submit'
    id='btn-login'
    class='btn btn-primary btn-lg btn-block'
    value='Register'
  />
  </form>
    ";
  }
}
