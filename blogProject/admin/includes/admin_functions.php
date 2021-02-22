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
        echo "<td><a href=\"?delete=$m_id\">Delete</a></td>";
        echo "<td><a href=\"?edit=$m_id\">Edit</a></td></tr>";
    }

    if (isset($_GET["delete"])) {
        $d_id = $_GET["delete"];

        $delete_menu = $abc->query("DELETE FROM menus WHERE menu_id = $d_id");
        $delete_menu->fetch();
        header("location:menus.php");
    }
}

// Edit from the admin page
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
                    <div class=\"col-xs-6\">
                    <div class=\"form-group\">
                    <strong>$olddec</strong> was successfully changed to <strong>$newdec</strong>
                    </div>
                    </div>         
                    ";
            }
        }
    } else if (isset($_GET["failed"])) {
        echo "
        <div class=\"col-xs-6\">
        <div class=\"form-group\">
        <strong>Field cannot be empty. Updating failed.</strong>
        </div>
        </div>         
        ";
    }
}

// functions for simple encrypting
function encrypt($input)
{
    return strtr(base64_encode($input), '+/=', '-_,');
}

// functions for simple decrypting
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
