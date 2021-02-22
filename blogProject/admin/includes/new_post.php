<?php
include "../includes/db.php";

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
        
        if ($new_post->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    }
?>
<div class="col-xs-6">
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="new_title">Title</label>
<input type="text" name="new_title" class="form-control">
</div>

<div class="form-group">
<label for="category">Category
</label>
<input type="number" name="category" class="form-control">
</div>

<div class="form-group">
<label for="new_author">Author</label>
<input type="text" name="new_author" class="form-control">
</div>

<div class="form-group">
<label for="new_status">Post Status</label>
<input type="text" name="new_status" class="form-control">
</div>


<div class="form-group">
<label for="new_image">Select Image</label>
<input type="file" name="new_image" class="form-control">
</div>

<div class="form-group">
<label for="new_content">Content</label>
<textarea name="new_content" class="form-control" rows="10" cols="30" style="resize: none"></textarea>
</div>

<div class="form-group">
<label for="new_tags">Tags</label>
<input type="text" name="new_tags" class="form-control">
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" value="Publish Post" name="add_post">
</div>

</form>
</div>