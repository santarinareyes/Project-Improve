<div class="col-xs-6">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="new_title">Title</label>
            <input type="text" name="new_title" class="form-control">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class='form-control' name='update_category'>";
                <?php
                displayCategoriesOption();
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="new_status">Post Status</label>
            <select name="new_status" class="form-control">
                <option value="Draft">Draft</option>
                <option value="Published">Publish</option>
                <option value="Featured">Feature</option>
            </select>
        </div>


        <div class="form-group">
            <label for="new_image">Select Image</label>
            <input type="file" name="new_image" class="form-control">
        </div>
            <?php 
                        if (isset($_GET["not_an_image"])) {
                            if ($_GET["not_an_image"]) {
            
                                echo "
                                <div class='form-group'>
                                <strong class='text-danger'>The file is not an image!</strong>
                                </div>
                                ";
                            }
                        }
            ?>

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