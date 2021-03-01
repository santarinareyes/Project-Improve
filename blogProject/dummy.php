<?php 
$stm = $abc->query("SELECT * FROM posts");
$stm->fetch();
$count = ceil($stm->rowCount() / 3);

$stmt = $abc->query("SELECT * FROM posts LIMIT 0, $count");
if(isset($_GET["page"])) {
  $page = $_GET["page"];

}

echo "
<ul class='pager'>
<li>
<a href='#'>$count</a>
</li>
</ul>
";



?>