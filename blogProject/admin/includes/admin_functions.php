<?php

// Show all menus/categories from the database
// as well as the delete function from the admin page
function adminShowMenus()
{
    global $abc;
    $getNav = $abc->query("SELECT * FROM menus");

    while ($menus = $getNav->fetch()) {
        $m_title = $menus['menu_title'];
        $m_id = $menus['menu_id'];
        echo "<tr><td>$m_id</td>";
        echo "<td>$m_title</td>";
        echo "<td><a href=\"?edit=$m_id\">Edit</a></td>";
        echo "<td><a href=\"?delete=$m_id\">Delete</a></td></tr>";
    }

    if (isset($_GET["delete"])) {
        $d_id = $_GET["delete"];

        $delete_menu = $abc->query("DELETE FROM menus WHERE menu_id = $d_id");
        $delete_menu->fetch();
        header("location:categories.php?deleted=$d_id");
    }
}

// Edit a category title from the admin page
function editCategory()
{
    global $abc;


    if (isset($_GET["edit"])) {
        $e_id = $_GET["edit"];

        $edit_menu = $abc->query("SELECT * FROM menus WHERE menu_id = $e_id");
        while ($editMenu = $edit_menu->fetch()) {
            $menuTitle = $editMenu['menu_title'];
            echo "
            <div class=\"form-group\">
            <form action=\"\" method=\"post\">
            <label for=\"new_title_input\">You have currently selected: $menuTitle</label>
            <input class=\"form-control\" type=\"text\" name=\"new_title_input\" placeholder=\"Enter a new title\">
            <input type=\"hidden\" name=\"old_title\" value=\"$menuTitle\">
                                </div>
                                <div class=\"form-group\">
                        <input type=\"submit\" name=\"menu_update\" class=\"btn btn-primary\" value=\"Update\">
                        </div>
                </form>             
            ";
        }

        if (isset($_POST["menu_update"])) {
            if ($_POST["new_title_input"]) {
                $old_title = $_POST["old_title"];
                $newTitle = $_POST["new_title_input"];
                // Encrypting with a function for the URL
                $old_dec = encrypt($old_title);
                $new_dec = encrypt($newTitle);

                $updateTitle = $abc->query("UPDATE menus SET menu_title = '$newTitle' WHERE menu_id = $e_id");

                if ($updateTitle) {
                    header("location:?updated=$old_dec?to=$new_dec");
                }
            } else {
                header("location:?failed");
            }
        }
    }

    if (isset($_GET["updated"])) {
        // Get all the strings from updated=
        $old_new = $_GET["updated"];
        // Get the string lengt after the old title
        $oTitle_len = strlen(substr($old_new, strrpos($old_new, "?")));
        // Replace the whole string and remove letters equal to strlen
        $oTitle = substr_replace($old_new, "", -$oTitle_len);
        // Decrypting the old title from the URL with a function
        $olddec = decrypt($oTitle);
        // Show the strings after "="
        $nTitle = substr($old_new, strpos($old_new, "=") + 1);
        //  Decrypting the new title from the URL with a function
        $newdec = decrypt($nTitle);

        // Basically -> If it doesnt match with the database, then dont show anything.
        // For URL editors
        $donttry = $abc->query("SELECT * FROM menus WHERE menu_title = '$newdec'");

        while ($nope = $donttry->fetch()) {
            $dontdoit = $nope['menu_title'];
            if ($newdec == $dontdoit) {
                echo "
                    <strong>$olddec</strong> was successfully changed to <strong>$newdec</strong>       
                    ";
            }
        }
    } else if (isset($_GET["failed"])) {
        echo "
        <strong>Field cannot be empty. Updating failed.</strong>
        ";
    }
}

// Simple encrypting
function encrypt($input)
{
    return strtr(base64_encode($input), '+/=', '-_,');
}

// Simple decrypting
function decrypt($input)
{
    return base64_decode(strtr($input, '-_,', '+/='));
}

// Add a new menu/cateogry into the database and display in admin
function adminAddMenu()
{
    global $abc;
    if (isset($_POST["menu_add"])) {
        $newMenu = $_POST["menu_title"];
        $insertNav = $abc->prepare("INSERT INTO menus (menu_title) VALUES (:yaas)");
        $insertNav->bindParam(":yaas", $newMenu);

        if ($newMenu && $insertNav->execute()) {
            header("location:?success=$newMenu");
        } else {
            header("location:menus.php?empty_field");
        }
    }

    if (isset($_GET["empty_field"])) {
        echo "<strong>Field cannot be empty. If this continues, please contact Richard.</strong>";
    }

    if (isset($_GET["success"])) {
        $addedMenu = $_GET["success"];
        echo "<strong>$addedMenu added</strong>";
    }
}

// Add a new post from admin>posts
function newPost()
{
    global $abc;
    if (isset($_POST["add_post"])) {
        $new_title = $_POST["new_title"];
        $category = $_POST["update_category"];
        $new_author = $_POST["new_author"];
        $new_status = $_POST["new_status"];

        $new_image = $_FILES["new_image"]['name'];
        $new_image_temp = $_FILES["new_image"]['tmp_name'];

        $new_tags = $_POST["new_tags"];
        $new_content = $_POST["new_content"];
        $post_comment_count = 1;
        $post_view_count = 1;
        $post_user = 1;

        move_uploaded_file($new_image_temp, "../../images/$new_image");


        $new_post = $abc->prepare("INSERT INTO posts (post_menu_id, post_title, post_author, post_user, post_date, post_img, post_content, post_status, post_tags, post_comment_count, post_views_count) VALUES ($category, '$new_title', '$new_author', '$post_user', now(), '$new_image', '$new_content', '$new_status', '$new_tags', '$post_comment_count', '$post_view_count')");

        $new_title_encrypt = encrypt($new_title);

        if ($new_post->execute()) {
            header("location:posts.php?added=$new_title_encrypt");
        }
    }
}

// When posts has been successfully added
function newPostSuccess()
{
    if (isset($_GET["added"])) {
        $addedTitleCrypted = $_GET["added"];
        $titleDecrypt = decrypt($addedTitleCrypted);

        echo "<h2><strong>$titleDecrypt</strong> has been added.</h2>";
        header("refresh:3;url=posts.php");
    }
}

// To check if query failed
function checkQuery($checkthis)
{
    global $abc;
    if (!$checkthis) {
        die("Something went wrong in the Query ." . mysqli_error($abc));
    }
}

// Display all Posts and delete post function
function showAllPosts()
{
    global $abc;
    $getPosts = $abc->query("SELECT * FROM posts");

    while ($postsrow = $getPosts->fetch()) {
        $vp_id = $postsrow["post_id"];
        $vp_author = $postsrow["post_author"];
        $vp_title = $postsrow["post_title"];
        $vp_menu = $postsrow["post_menu_id"];
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
        ";
        categoryName($vp_menu);
        echo "
        
        <td> $vp_status</td>
        <td><img src='../../images/$vp_img' class='img-responsive' alt='image' style='max-height: 100px'></td>
        <td> $vp_tags</td>
        <td> $vp_comments</td>
        <td> $vp_date</td>
        <td><a href='?action=post_edit&editing=$vp_id'>Edit</a></td>
        <td><a href='?post_delete=$vp_id'>Delete</a></td>
        </tr>
        ";
    }

    if (isset($_GET["post_delete"])) {
        $post_delete = $_GET["post_delete"];

        $deleteThis = $abc->query("DELETE FROM posts WHERE post_id = $post_delete");

        if ($deleteThis->execute()) {
            header("location:posts.php");
        }
    }
}

// Fetch the data from the selected post
function editPost()
{
    global $abc;

    if (isset($_GET["editing"])) {
        $editThis = $_GET["editing"];

        $editThese = $abc->query("SELECT * FROM posts WHERE post_id = $editThis");

        while ($values = $editThese->fetch()) {
            $ep_id = $values["post_id"];
            $ep_category = $values["post_menu_id"];
            $ep_author = $values["post_author"];
            $ep_title = $values["post_title"];
            //   $ep_menu = $values["post_title"];
            $ep_status = $values["post_status"];
            $ep_img = $values["post_img"];
            $ep_content = $values["post_content"];
            $ep_tags = $values["post_tags"];
            $ep_comments = $values["post_comment_count"];
            $ep_date = $values["post_date"];

            echo
            "<div class='col-xs-6'>
            <form action='' method='post' enctype='multipart/form-data'>
            <div class='form-group'>
            <label for='update_title'>Title</label>
            <input type='text' name='update_title' class='form-control' value='$ep_title'>
            </div>
            
            <div class='form-group'>
            <label for='update_category'>Category</label>
            <select class='form-control' name='update_category'>";
            displayCategoriesOption();

            echo
            "</select>
            </div>
            
            <div class='form-group'>
            <label for='update_author'>Author</label>
            <input type='text' name='update_author' class='form-control' value='$ep_author'>
            </div>
            
            <div class='form-group'>
            <label for='update_status'>Post Status</label>
            <input type='text' name='update_status' class='form-control' value='$ep_status'>
            </div>
            
            <img src='../../images/$ep_img' alt='' width='100'>
            <div class='form-group'>
            <label for='update_image'>Select Image</label>
            <input type='file' name='update_image' class='form-control'>
            </div>
            
            <div class='form-group'>
            <label for='update_content'>Content</label>
            <textarea name='update_content' class='form-control' rows='10' cols='30' style='resize: none'>$ep_content</textarea>
            </div>
            
            <div class='form-group'>
            <label for='update_tags'>Tags</label>
            <input type='text' name='update_tags' class='form-control' value='$ep_tags'>
            </div>
            
            <div class='form-group'>
            <input class='btn btn-primary' type='submit' value='Update post' name='update_post'>
            </div>
            
            </form>
            </div>
            ";
        }
        if (isset($_POST["update_post"])) {
            $up_title = $_POST["update_title"];
            $up_category = $_POST["update_category"];
            $up_author = $_POST["update_author"];
            $up_status = $_POST["update_status"];
            $up_image = $_FILES["update_image"]['name'];
            $up_image_temp = $_FILES["update_image"]['tmp_name'];
            $up_content = $_POST["update_content"];
            $up_tags = $_POST["update_tags"];

            move_uploaded_file($up_image_temp, "../../images/$up_image");

            if (empty($up_image)) {

                $empty_img = $abc->query("SELECT post_img FROM posts WHERE post_id = $editThis");

                while ($get_img = $empty_img->fetch()) {
                    $up_image = $get_img['post_img'];
                }
            }

            $updatePost = "UPDATE posts SET ";
            $updatePost .= "post_menu_id = $up_category, ";
            $updatePost .= "post_title = '$up_title', ";
            $updatePost .= "post_author = '$up_author', ";
            $updatePost .= "post_status = '$up_status', ";
            $updatePost .= "post_date = now(), ";
            $updatePost .= "post_img = '$up_image', ";
            $updatePost .= "post_content = '$up_content', ";
            $updatePost .= "post_tags = '$up_tags' ";
            $updatePost .= "WHERE post_id = $editThis ";
            $updatePost2 = $abc->prepare($updatePost);

            if (!$updatePost2->execute()) {
                die("Something went wrong.");
            } else {
                header("location:../views/posts.php");
            }
        }
    }
}

// Display Category name instead of category id in <option> (menu id)
function displayCategoriesOption()
{
    global $abc;
    $getCat = $abc->query("SELECT * FROM menus");

    while ($allCat = $getCat->fetch()) {
        $cat_title = $allCat["menu_title"];
        $menu_id = $allCat["menu_id"];

        echo "<option value='$menu_id'>$cat_title</option>";
    }
}

// Another display category name instead of the id function
function categoryName($theId)
{
    global $abc;

    $getCat = $abc->query("SELECT * FROM menus WHERE menu_id = $theId");

    while ($allCat = $getCat->fetch()) {
        $cat_title = $allCat["menu_title"];
        $menu_id = $allCat["menu_id"];

        echo "<td>$cat_title</td>";
    }
}

// View all users from the database and delete users
function showAllUsers() {
    global $abc;
    
    $getUsers = $abc->query("SELECT * FROM users");

    while($row = $getUsers->fetch()) {
        $user_id = $row['user_id'];
        $user_user = $row['username'];
        $user_first = $row['user_firstname'];
        $user_last = $row['user_lastname'];
        $user_email = $row['user_email'];
        $created = $row['user_created'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        echo "
        <tr>
        <td>$user_id</td>
        <td><img src='../../images/user_images/$user_image' class='img-responsive' alt='profile-picture' style='max-height: 100px'></td>
        <td>$user_user</td>
        <td>$user_first</td>
        <td>$user_last</td>
        <td>$user_email</td>
        <td>$created</td>
        <td>$user_role</td>
        <td><a href='?action=edit_user&user_id=$user_id'>Edit</a></td>
        <td><a href='?user_delete=$user_id'>Delete</a></td>
        </tr>
        ";
    }

    if (isset($_GET["user_delete"])) {
        $user_id = $_GET["user_delete"];

        $deleteUser = $abc->query("DELETE FROM users WHERE user_id = $user_id");

        if($deleteUser->execute()) {
            header("location:users.php");
        }
    }
    
}

// Edit users
function editUser() {
    global $abc;

    if (isset($_GET["user_id"])) {
        $user_id = $_GET["user_id"];

        $getUser = $abc->query("SELECT * FROM users WHERE user_id = $user_id");

        while ($row = $getUser->fetch()) {
            $user_user = $row['username'];
            $user_first = $row['user_firstname'];
            $user_last = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo
            "<div class='col-xs-6'>
            <form role='form' action='' method='post' enctype='multipart/form-data'>
            <div class='form-group'>
            <label for='update_user'>Username</label>
            <input type='text' name='update_user' class='form-control' value='$user_user'>
            </div>

            <div class='form-group'>
            <label for='update_role'>Role</label>
            <select class='form-control' name='update_role'>;
            <option value='$user_role'></option>
            <option value='Admin'>Admin</option>
            <option value='User'>User</option>
            </select>
            </div>
            
            <div class='form-group'>
            <label for='update_first'>Firstname</label>
            <input type='text' name='update_first' class='form-control' value='$user_first'>
            </div>
            
            <div class='form-group'>
            <label for='update_last'>Lastname</label>
            <input type='text' name='update_last' class='form-control' value='$user_last'>
            </div>

            <div class='form-group'>
            <label for='update_email'>Email</label>
            <input type='email' name='update_email' class='form-control' value='$user_email'>
            </div>

            <div class='form-group'>
            <label for='update_password'>New password</label>
            <input type='password' name='update_password' class='form-control' value='' autocomplete='off'>
            </div>
            
            <img src='../../images/user_images/$user_image' alt='' width='100'>
            <div class='form-group'>
            <label for='update_image'>Select Image</label>
            <input type='file' name='update_image' class='form-control'>
            </div>
            
            <div class='form-group'>
            <input class='btn btn-primary' type='submit' value='Update user' name='u_user'>
            </div>
            
            </form>
            </div>
            ";
        }

        if(isset($_POST["u_user"])) {
            $u_user = $_POST["update_user"];
            $u_role = $_POST["update_role"];
            $u_first = $_POST["update_first"];
            $u_last = $_POST["update_last"];
            $u_email = $_POST["update_email"];
            $u_image = $_FILES["update_image"]["name"];
            $u_image_temp = $_FILES["update_image"]["tmp_name"];
            $u_password = $_POST["update_password"];
            
            move_uploaded_file($u_image_temp, "../../images/user_images/$u_image");
            
            if(empty($u_image)) {
                $get_old_img = $abc->query("SELECT user_image FROM users WHERE user_id = $user_id");
                
                while($rows = $get_old_img->fetch()) {
                    $u_image = $rows['user_image'];
                }
            }
            
            if(!empty($u_password)) {
                $u_password = password_hash($u_password, PASSWORD_BCRYPT, array('cost' => 10));
                $stm = $abc->prepare("UPDATE users SET user_password = '$u_password' WHERE user_id = $user_id");
                $stm->execute();
            }
            
            $updateUser = "UPDATE users SET ";
            $updateUser .= "username = '$u_user', ";
            $updateUser .= "user_role = '$u_role', ";
            $updateUser .= "user_firstname = '$u_first', ";
            $updateUser .= "user_lastname = '$u_last', ";
            $updateUser .= "user_email = '$u_email', ";
            $updateUser .= "user_image = '$u_image' ";
            $updateUser .= "WHERE user_id = $user_id";
            $stm = $abc->prepare("$updateUser");

            if (!$stm->execute()) {
                die("Something went wrong.");
            } else {
                header("location:users.php");
            }
        }
    } else {
        header("location:../index.php");
    }
}

// Create a user from CMS
function adminNewUser() {
    global $abc;

    if(isset($_POST["add_user"])) {
        $username = $_POST["new_user"];
        $role = $_POST["role"];
        $firstname = $_POST["new_first"];
        $lastname = $_POST["new_last"];
        $email = $_POST["new_email"];
        $password = $_POST["new_password"];
        $image = $_FILES['new_user_img']['name'];
        $temp_image = $_FILES['new_user_img']['tmp_name'];

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

        move_uploaded_file($temp_image, "../../images/user_images/$image");

        $addUser = "INSERT INTO users (username, user_role, user_firstname, user_lastname, user_email, user_password, user_created, user_image) ";
        $addUser .= "VALUES (:altUser, '$role', '$firstname', '$lastname', '$email', :altPass, now(), '$image')";
        $stm = $abc->prepare("$addUser");
        $stm->bindParam(':altPass', $password);
        $stm->bindParam(':altUser', $username);

        if($stm->execute()) {
            header("location:users.php");
        } else {
            die("Something went wrong");
        }
    }
}

// Display all comments, approve, unapprove and delete comments
function showAllComments()
{
    global $abc;
    $getComments = $abc->query("SELECT * FROM comments");

    while ($row = $getComments->fetch()) {
        $comment_id = $row["comment_id"];
        $post_id = $row["comment_post_id"];
        $user = $row["comment_author_id"];
        $content = $row["comment_content"];
        $status = $row["comment_status"];
        $date = $row["comment_date"];
        $anchor = $post_id - 1;

        echo "
        <tr>
        <td id='approved$comment_id'> $comment_id</td>";
        showUser($user);
        showArticle($post_id);
        echo "
        <td> $content</td>";
        echo "
        <td> $status</td>
        <td> $date</td>
        <td><a href='../../views/post.php?reading=$post_id'>Go to article</a></td>
        <td><a href='?comment_approve=$comment_id#approved$comment_id'>Approve</a></td>
        <td><a href='?comment_delete=$comment_id'>Delete</a></td>
        </tr>
        ";
    }

    if (isset($_GET["comment_delete"])) {
        $comment_id = $_GET["comment_delete"];

        $deleteThis = $abc->query("DELETE FROM comments WHERE comment_id = $comment_id");

        if ($deleteThis->execute()) {
            header("location:comments.php#");
        }
    }

    if (isset($_GET["comment_approve"])) {
        $comment_id = $_GET["comment_approve"];

        $stm = $abc->prepare("UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $comment_id");
        
        if (!$stm->execute()) {
            die("Something went wrong");
        } else {
            header("location:comments.php");
        }
    }
}

// Convert post_id into post_title
function showArticle($post) {
    global $abc;

    $getPosts = $abc->query("SELECT * FROM posts WHERE post_id = $post");
    
    while($row = $getPosts->fetch()) {
        $post_title = $row['post_title'];
    }

    echo "<td> $post_title</td>";
}

// Convert user_id into user_title
function showUser($user) {
    global $abc;

    $getUsers = $abc->query("SELECT * FROM users WHERE user_id = $user");

    while ($row = $getUsers->fetch()) {
        $username = $row['username'];
        
        echo "<td> $username</td>";
    }
}