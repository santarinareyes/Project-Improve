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
      echo "
      <h1 class='page-header'>
      <small>Search complete</small>
      </h1>
      ";

      while ($posts = $aftersearch->fetch()) {
        $post_status = $posts['post_status'];
        $pid = $posts["post_id"];
        $ptitle = $posts["post_title"];
        $pauthor = $posts["post_author"];
        $pdate = $posts["post_date"];
        $pimage = $posts["post_img"];
        $pcontent1 = $posts["post_content"];
        $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));

        if (strlen($pcontent1) > 150) {
          $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));
        } else {
          $pcontent = $pcontent1;
        }

        if ($post_status !== 'Draft') {
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
          <a class='btn btn-primary' href='post.php?reading=$pid'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";

          if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
            if($post_status === 'Featured') {
              echo "
              <span>
              <a href='../index.php?landing_unfeature_post=$pid' class='btn btn-info' type='submit' name='unfeature_article'>Unfeature article</a>
              </span>
              <span>
              <a href='../includes/admin_buttons.php?landing_draft_post=$pid' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
              </span>
              <span>
              <a href='../includes/admin_buttons.php?landing_delete_post=$pid' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
              </span>
              ";
            } else {
              echo "
              <span>
              <a href='../includes/admin_buttons.php?landing_feature_post=$pid' class='btn btn-success' type='submit' name='feature_article'>Feature article</a>
              </span>
              <span>
              <a href='../includes/admin_buttons.php?landing_draft_post=$pid' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
              </span>
              <span>
              <a href='../includes/admin_buttons.php?landing_delete_post=$pid' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
              </span>
              ";
            }
          }
        echo "
        <hr />
        ";
      }
    }
    } else {
      echo "<h1>Couldn't find what you were looking for.</h1>";
    }
  }
}

// Display the username instead of post_comment_id (author)
function showUser($user) {
  global $abc;

  $stm = $abc->query("SELECT * FROM users WHERE user_id = $user");

  while ($row = $stm->fetch()) {
      $username = $row['username'];
      
      echo "<p class='lead'>by <a href='index.php'>$username</a></p>";
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
    echo "<li><a href='$link?category=$menu_id'>$menu</a></li>";
  }
}

// Show all posts and selected post
function landingPagePosts($readmore)
{
  global $abc;
  if (isset($_SESSION['role'])) {
    if ((isset($_GET["article_removed"]))) {
      echo "
      <h3 class='page-header form-group'>
      The article you are trying to find has been drafted or removed.
      </h3>
      <a class='btn'>Back to start</a>
      ";
    } else if (isset($_GET["reading"])) {
      $readingid = $_GET["reading"];
      
      $dbposts = $abc->query("SELECT * FROM posts WHERE post_id = $readingid AND (post_status = 'Published' OR post_status = 'Featured')");
      
    if ($dbposts->rowCount() < 1) {
      header("location:../index.php?article_removed");
    }

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent = $posts["post_content"];
      $pstatus = $posts["post_status"];
      $p_user_id = $posts["post_user_id"];

      if ($readmore === 1) {
        echo "    
        <h2>
        <a href='views/post.php?reading=$pid'>$ptitle</a>
        </h2>";
        showUser($p_user_id);
        echo"
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
        </h2>";
        showUser($p_user_id);
        echo
        "
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
        if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
          if($pstatus === 'Featured') {
            echo "
            <span>
            <a href='?reading=$pid&post_unfeature_post=$pid' class='btn btn-info' type='submit' name='unfeature_article'>Unfeature article</a>
            </span>
            <span>
            <a href='../includes/admin_buttons.php?landing_draft_post=$pid' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
            </span>
            <span>
            <a href='../includes/admin_buttons.php?landing_delete_post=$pid' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
            </span>
            <hr>
            </hr>
            ";
          } else {
            echo "
            <span>
            <a href='?reading=$pid&post_feature_post=$pid' class='btn btn-success' type='submit' name='feature_article'>Feature article</a>
            </span>
            <span>
            <a href='../includes/admin_buttons.php?landing_draft_post=$pid' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
            </span>
            <span>
            <a href='../includes/admin_buttons.php?landing_delete_post=$pid' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
            </span>
            <hr>
            </hr>
            ";
          }

          if (isset($_GET["post_unfeature_post"])) {
            $post_id = $_GET["post_unfeature_post"];

            $stm = $abc->query("UPDATE posts SET post_status = 'Published' WHERE post_id = $post_id");

            if ($stm->execute()) {
              header("location:post.php?reading=$post_id");
            }
          }

          if (isset($_GET["post_feature_post"])) {
            $post_id = $_GET["post_feature_post"];

            $stm = $abc->query("UPDATE posts SET post_status = 'Featured' WHERE post_id = $post_id");

            if ($stm->execute()) {
              header("location:post.php?reading=$post_id");
            }
        }
        }
      }
    }
  } else {
    echo "
    <h1 class='page-header'>
    <small>Featured articles</small>
    </h1>
    ";
    $dbposts = $abc->query("SELECT * FROM posts WHERE post_status = 'Published' OR post_status = 'Featured'");

    while ($posts = $dbposts->fetch()) {
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pstatus = $posts["post_status"];
      $pcontent1 = $posts["post_content"];
      $p_user_id = $posts["post_user_id"];

      if (strlen($pcontent1) > 150) {
        $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));
      } else {
        $pcontent = $pcontent1;
      }
      if ($pstatus === 'Featured') {
        echo "      
        <h2>
        <a href='views/post.php?reading=$pid'>$ptitle</a>
        </h2>";
        showUser($p_user_id);
        echo "
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
        ></a>";
        adminArticleBtn($pstatus, $pid);
        echo "
        <hr />
        ";
      }
    }
  }
} else {
  echo "
  <h3 class='page-header form-group'>
  Please sign in to see the content.
  </h3>
  ";
}
}

// Show posts related to the category
function categoryPagePosts()
{
  global $abc;
  if (isset($_SESSION['role'])) {
  if (isset($_GET["category"])) {
    $category_id = $_GET["category"];

    $dbposts = $abc->query("SELECT * FROM posts WHERE post_menu_id = $category_id AND (post_status = 'Published' OR post_status = 'Featured')");

    while ($posts = $dbposts->fetch()) {
      $pstatus = $posts["post_status"];
      $ptitle = $posts["post_title"];
      $pid = $posts["post_id"];
      $pauthor = $posts["post_author"];
      $pdate = $posts["post_date"];
      $pimage = $posts["post_img"];
      $pcontent1 = $posts["post_content"];
      $p_user_id = $posts["post_user_id"];

      if (strlen($pcontent1 > 150)) {
        $pcontent = substr($pcontent1, 0, strpos($pcontent1, " ", 150));
      } else {
        $pcontent = $pcontent1;
      }

      echo "
      <h2>
      <a href='post.php?reading=$pid'>$ptitle</a>
      </h2>";
      showUser($p_user_id);
      echo "
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
      ></a>";
      adminArticleBtn($pstatus, $pid);
      echo "
      <hr />
      ";
    }
  }
} else {
  echo "
  <h3 class='page-header form-group'>
  Please sign in to see the content.
  </h3>
  ";
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
      $_SESSION['user_id'] = $user_id;
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $user_firstname;
      $_SESSION['lastname'] = $user_lastname;
      $_SESSION['role'] = $user_role;

      header("location:../index.php");
    } else {
      header("location:../index.php?login=failed");
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
    </form>";
    if (isset($_GET["login"])) {
      echo "
      <hr/>
      <p class='text-danger'>Username or password is incorrect.</p>
      ";
    }
    echo "
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
  global $abc;
  if (isset($_SESSION['username'])) {
    echo "Please sign out if you want to register another account.";
  } else {
    echo "
    <form role='form' action='register.php' method='post' id='login-form' autocomplete='off'>
    <div class='form-group'>
        <label for='username' class='sr-only'>Username</label>
        <input type='text' name='username' id='username' class='form-control' placeholder='Username' />
    </div>
    <div class='form-group'>
        <label for='email' class='sr-only'>Email</label>
        <input type='email' name='email' id='email' class='form-control' placeholder='example@example.com' />
    </div>
    <div class='form-group'>
        <label for='firstname' class='sr-only'>Firstname</label>
        <input type='text' name='firstname' id='firstname' class='form-control' placeholder='Firstname' />
    </div>
    <div class='form-group'>
        <label for='lastname' class='sr-only'>Lastname</label>
        <input type='text' name='lastname' id='lastname' class='form-control' placeholder='Lastname' />
    </div>
    <div class='form-group'>
        <label for='password' class='sr-only'>Password</label>
        <input type='password' name='password' id='key' class='form-control' placeholder='Password' />
    </div>

    <input type='submit' name='register' id='btn-login' class='btn btn-primary btn-lg btn-block' value='Register' />
    </form>
    ";
  }

  if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_BCRYPT, array('code' => 12));
    $role = 'User';
    $created = date('y-m-d');

    $check = $abc->query("SELECT username, user_email FROM users WHERE username = '$username' OR user_email = '$email'");

    while ($row = $check->fetch()) {
      $existing_username = $row['username'];
      $existing_email = $row['user_email'];
      if ($existing_username == $username && $existing_email == $email) {
        echo "<br/><p class='text-danger'>Both Username and Email already exist.</p>";
      } else if ($existing_email == $email) {
        echo "<br/><p class='text-danger'>Email already exist.</p>";
      } else if ($existing_username == $username) {
        echo "<br/><p class='text-danger'>Username already exsist.</p>";
      } else {
        $stm = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_role, user_created, user_password) ";
        $stm .= "VALUES (:user, :first, :last, :email, :role, :user_created, :pass)";
        $stm = $abc->prepare($stm);
        $stm->bindParam(":user", $username);
        $stm->bindParam(":first", $firstname);
        $stm->bindParam(":last", $lastname);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":role", $role);
        $stm->bindParam(":user_created", $created);
        $stm->bindParam(":pass", $password);

        if ($stm->execute()) {
          header("location:../index.php");
        } else {
          die("Something went wrong");
        }
      }
    }
  }
}

// Display Category title when in a specific category
function displayCat()
{
  global $abc;
  if (isset($_SESSION['role'])) {
  if (isset($_GET["category"])) {
    $category = $_GET["category"];

    $stm = $abc->query("SELECT menu_title FROM menus WHERE menu_id = $category");

    while ($row = $stm->fetch()) {
      $cat_title = $row['menu_title'];

      echo "
      <h1 class='page-header'>
      <small>$cat_title</small>
      </h1>
      ";
    }
  }
}
}

// Write a comment section
function writeComment()
{
  global $abc;
  if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];

    echo "
    <div class='well'>
    <h4>Leave a Comment:</h4>
    <form role='form' method='post' action='#comment_submitted'>
    <div class='form-group'>
    <textarea class='form-control' name='comment_content' rows='5' style='resize: none'></textarea>
    </div>
    <button type='submit' name='comment_submit' class='btn btn-primary'>Submit</button>
    </form>
    </div>
    <hr />
    ";

    if (isset($_POST["comment_submit"])) {
      $comment_status = 'Draft';
      $comment_date = date('y-m-d');
      $post_id = $_GET["reading"];
      $comment_content = $_POST["comment_content"];

      $stm = "INSERT INTO comments (comment_status, comment_post_id, comment_author_id, comment_content, comment_date) ";
      $stm .= "VALUES (:status, :post_id, :author, :content, :date)";
      $stm = $abc->prepare($stm);
      $stm->bindParam(":status", $comment_status);
      $stm->bindParam(":post_id", $post_id);
      $stm->bindParam(":author", $user_id);
      $stm->bindParam(":content", $comment_content);
      $stm->bindParam(":date", $comment_date);

      if (!$stm->execute()) {
        die("Something went wrong.");
      } else {
        echo "<p id='comment_submitted'>Thank you for your comment! Comment will be shown after an admin has approved.</p>";
      }
    }
  }
}

// Display comments
function displayComments()
{
  global $abc;

  if (isset($_GET["reading"])) {
    $post_id = $_GET["reading"];

    $stm = $abc->query("SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved'");

    while ($row = $stm->fetch()) {
      $comment_author_id = $row['comment_author_id'];
      $comment_content = $row['comment_content'];
      $comment_date =  $row['comment_date'];
      $comment_id =  $row['comment_id'];

      echo "
      <div class='media'>
      <a class='pull-left' href='#'>
      <img
      class='media-object'
      src='http://placehold.it/64x64'
      alt='profile-picture'
      />
      </a>
      <div class='media-body'>
      <h4 class='media-heading'>
      $comment_author_id
      <small>$comment_date</small>
      </h4>
      <p>
      $comment_content";
      adminDeleteComment($comment_id, $post_id);
      echo "
      </p>
      </div>
      </div>
      ";
    }
  }
}

// Display delete button on articles for fast delete if logged in as admin
function adminArticleBtn($unfeature, $post_id)
{
  global $abc;
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'Admin') {
      if ($unfeature === 'Featured') {
        if (isset($_GET["category"])) {
          $cat_id = $_GET["category"];
          echo "
          <span>
          <a href='?category=$cat_id&unfeature_post=$post_id' class='btn btn-info' type='submit' name='unfeature_article'>Unfeature article</a>
          </span>
          <span>
          <a href='../includes/admin_buttons.php?draft_post=$post_id&cat_id=$cat_id' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
          </span>
          <a href='../includes/admin_buttons.php?delete_post=$post_id&cat_id=$cat_id' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
          </span>
          ";

          if (isset($_GET["unfeature_post"])) {
            $post_id = $_GET["unfeature_post"];
            $stm = $abc->prepare("UPDATE posts SET post_status = 'Published' WHERE post_id = $post_id");
    
            if($stm->execute()) {
              header("location:category.php?category=$cat_id");
            } else {
              die("Something went wrong!");
            }
          }
          
        } else {
          echo "
          <span>
          <a href='?landing_unfeature_post=$post_id' class='btn btn-info' type='submit' name='unfeature_article'>Unfeature article</a>
          </span>
          <span>
          <a href='includes/admin_buttons.php?landing_draft_post=$post_id' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
          </span>
          <span>
          <a href='includes/admin_buttons.php?landing_delete_post=$post_id' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
          </span>
          ";
        }
      } else {
        if (isset($_GET["category"])) {
          $cat_id = $_GET["category"];
          echo "
          <span>
          <a href='../includes/admin_buttons.php?feature_post=$post_id' class='btn btn-success' type='submit' name='feature_article'>Feature article</a>
          </span>
          <span>
          <a href='../includes/admin_buttons.php?draft_post=$post_id&cat_id=$cat_id' class='btn btn-warning' type='submit' name='draft_article'>Draft article</a>
          </span>
          <span>
          <a href='../includes/admin_buttons.php?delete_post=$post_id&cat_id=$cat_id' class='btn btn-danger' type='submit' name='delete_article'>Delete article</a>
          </span>
          ";
        }
      }

      if (isset($_GET["landing_unfeature_post"])) {
        $post_id = $_GET["landing_unfeature_post"];
        $stm = $abc->prepare("UPDATE posts SET post_status = 'Published' WHERE post_id = $post_id");

        if($stm->execute()) {
          header("location:index.php");
        } else {
          die("Something went wrong!");
        }
      }
    }
  }
}

// Display delete button on commens if logged in as admin
function adminDeleteComment($comment_id, $post_id)
{
  global $abc;

  if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
    echo "<a href='?reading=$post_id&delete_comment=$comment_id'>Delete comment</a>";
  }
  
  if(isset($_GET["delete_comment"])) {
    $delete_comment = $_GET["delete_comment"];

    $stm = $abc->query("DELETE FROM comments WHERE comment_id = $delete_comment");
    
    if($stm->execute()) {
      header("location:../views/post.php?reading=$post_id");
    } else {
      die("Something went wrong!");
    }
  }
}
