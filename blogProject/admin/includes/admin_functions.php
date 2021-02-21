<?php

// Show all menus/categories from the database
function adminShowMenus()
{
    global $abc;
    $getNav = $abc->query("SELECT * FROM menus");

    while ($menus = $getNav->fetch()) {
        $m_title = strtoupper($menus['menu_title']);
        $m_id = $menus['menu_id'];
        echo "<tr><td>$m_id</td>";
        echo "<td>$m_title</td></tr>";
    }
}

function adminAddMenu()
{
    global $abc;
    if (isset($_POST["menu_add"])) {
        $newMenu = $_POST["menu_title"];
        $insertNav = $abc->prepare("INSERT INTO menus (menu_title) VALUES (:yaas)");
        $insertNav->bindParam(":yaas", $newMenu);

        if ($newMenu && $insertNav->execute()) {
            echo "$newMenu added";
        } else {
            echo "Something went wrong.";
        }
    }
}
