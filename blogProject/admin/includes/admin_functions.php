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
        header("location:menus.php?deleted=$d_id");
    }
}

// Edit a menu title from the admin page
function adminEdit()
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
function newPost() {
    global $abc;
    if (isset($_POST["add_post"])) {
        $new_title = $_POST["new_title"];
        $category = $_POST["category"];
        $new_author = $_POST["new_author"];
        $new_status = $_POST["new_status"];
        
        $new_image = $_FILES["new_image"]['name'];
        $new_image_temp = $_FILES["new_image"]['tmp_name'];
        
        $new_tags = $_POST["new_tags"];
        $new_content = $_POST["new_content"];
        $new_date = date('d-m-y');
        $post_comment_count = 1;
        $post_view_count = 1;
        $post_user = 1;
        
        move_uploaded_file($new_image_temp, "../images/$new_image");
        
        $new_post = $abc->prepare("INSERT INTO posts (post_menu_id, post_title, post_author, post_user, post_date, post_img, post_content, post_status, post_tags, post_comment_count, post_views_count) VALUES ($category, '$new_title', '$new_author', '$post_user', now(), '$new_image', '$new_content', '$new_status', '$new_tags', '$post_comment_count', '$post_view_count')");
        
        $new_title_encrypt = encrypt($new_title);

        if ($new_post->execute()) {
            header("location:view_posts.php?added=$new_title_encrypt");
        }
    }
}

// When posts has been successfully added
function newPostSuccess() {
    if (isset($_GET["added"])) {
        $addedTitleCrypted = $_GET["added"];
        $titleDecrypt = decrypt($addedTitleCrypted);

        echo "<h2><strong>$titleDecrypt</strong> has been added.</h2>";
        header("refresh:3;url=view_posts.php");
    }
}

// To check if query failed
function checkQuery($checkthis) {
    global $abc;
    if(!$checkthis) {
        die("Something went wrong in the Query ." . mysqli_error($abc));
    }
}

// Display all Posts and delete post function
function showAllPosts() {
    global $abc;
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
          <td><a href='?action=post_edit&editing=$vp_id'>Edit</a></td>
          <td><a href='?post_delete=$vp_id'>Delete</a></td>
          </tr>
          ";
    }

    if (isset($_GET["post_delete"])) {
        $post_delete = $_GET["post_delete"];

        $deleteThis = $abc->query("DELETE FROM posts WHERE post_id = $post_delete");

        if ($deleteThis->execute()) {
            header("location:view_posts.php");
        }
    }
}

// Fetch the data from the selected post
function editPost() {
    global $abc;
    if(isset($_GET["editing"])) {
        $editThis = $_GET["editing"];

        $editThese = $abc->query("SELECT * FROM posts WHERE post_id = $editThis");

        while($values = $editThese->fetch()) {
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
            <label for='new_title'>Title</label>
            <input type='text' name='new_title' class='form-control' value='$ep_title'>
            </div>
            
            <div class='form-group'>
            <label for='category'>Category
            </label>
            <input type='number' name='category' class='form-control' value='$ep_category'>
            </div>
            
            <div class='form-group'>
            <label for='new_author'>Author</label>
            <input type='text' name='new_author' class='form-control' value='$ep_author'>
            </div>
            
            <div class='form-group'>
            <label for='new_status'>Post Status</label>
            <input type='text' name='new_status' class='form-control' value='$ep_status'>
            </div>
            
            
            <div class='form-group'>
            <label for='new_image'>Select Image</label>
            <input type='file' name='new_image' class='form-control' value='$ep_img'>
            </div>
            
            <div class='form-group'>
            <label for='new_content'>Content</label>
            <textarea name='new_content' class='form-control' rows='10' cols='30' style='resize: none'>$ep_content</textarea>
            </div>
            
            <div class='form-group'>
            <label for='new_tags'>Tags</label>
            <input type='text' name='new_tags' class='form-control' value='$ep_tags'>
            </div>
            
            <div class='form-group'>
            <input class='btn btn-primary' type='submit' value='Publish Post' name='add_post'>
            </div>
            
            </form>
            </div>
            ";
        }
    }
}