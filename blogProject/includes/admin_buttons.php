<?php 
include "db.php";

        if (isset($_GET["feature_post"])) {
            $post_id = $_GET["feature_post"];
            $stm = $abc->prepare("UPDATE posts SET post_status = 'Featured' WHERE post_id = $post_id");
    
            if($stm->execute()) {
              header("location:../index.php");
            } else {
              die("Something went wrong!");
            }
          }
        
          if (isset($_GET["draft_post"])) {
            $cat_id = $_GET["cat_id"];
            $post_id = $_GET["draft_post"];
            $stm = $abc->prepare("UPDATE posts SET post_status = 'Draft' WHERE post_id = $post_id");
    
            if($stm->execute()) {
              header("location:../views/category.php?category=$cat_id");
            } else {
              die("Something went wrong!");
            }
          }

          if (isset($_GET["landing_draft_post"])) {
            $post_id = $_GET["landing_draft_post"];
            $stm = $abc->prepare("UPDATE posts SET post_status = 'Draft' WHERE post_id = $post_id");
    
            if($stm->execute()) {
              header("location:../index.php");
            } else {
              die("Something went wrong!");
            }
          }

          if (isset($_GET["delete_post"])) {
            $cat_id = $_GET["cat_id"];
            $post_id = $_GET["delete_post"];
            $stm = $abc->prepare("DELETE FROM posts WHERE post_id = $post_id");
            $stm2 = $abc->prepare("DELETE FROM comments WHERE comment_post_id = $post_id");
    
            if($stm->execute() && $stm2->execute()) {
              header("location:../views/category.php?category=$cat_id");
            } else {
              die("Something went wrong!");
            }
          }

          if (isset($_GET["landing_delete_post"])) {
            $post_id = $_GET["landing_delete_post"];
            $stm = $abc->prepare("DELETE FROM posts WHERE post_id = $post_id");
            $stm2 = $abc->prepare("DELETE FROM comments WHERE comment_post_id = $post_id");
    
            if($stm->execute() && $stm2->execute()) {
              header("location:../index.php");
            } else {
              die("Something went wrong!");
            }
          }

          if (isset($_GET["landing_feature_post"])) {
            $post_id = $_GET["landing_feature_post"];
            $stm = $abc->prepare("UPDATE posts SET post_status = 'Featured' WHERE post_id = $post_id");
    
            if($stm->execute()) {
              header("location:../index.php");
            } else {
              die("Something went wrong!");
            }
          }
?>