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
            <div class=\"col-xs-6\">
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
                </div>                
            ";
        }
 
        if (isset($_POST["menu_update"])) {
            $old_title = $_POST["old_title"];
            $newTitle = $_POST["new_title_input"];
            
            $updateTitle = $abc->query("UPDATE menus SET menu_title = '$newTitle' WHERE menu_id = $e_id");
            
            if ($updateTitle) {
                header("location:?updated=$old_title?to=$newTitle");
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
        // Show the strings after "="
        $nTitle = substr($old_new, strpos($old_new, "=") +1);
        
        $newTitle = $abc->query("SELECT * FROM menus");
        
        echo "
        <div class=\"col-xs-6\">
        <div class=\"form-group\">
        <strong>$oTitle</strong> was successfully changed to <strong>$nTitle</strong>
        </div>
        </div>         
        ";
    }

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
            echo "<strong>$newMenu added</strong>";
        } else {
            echo "<strong>Field cannot be empty. If this continues, please contact Richard.</strong>";
        }
    }
}
