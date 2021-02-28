<div class="col-xs-6">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="new_user">Username</label>
            <input type="text" name="new_user" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class='form-control' name='role'>";
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="new_first">Firstname</label>
            <input type="text" name="new_first" class="form-control">
        </div>

        <div class="form-group">
            <label for="new_last">Lastname</label>
            <input type="text" name="new_last" class="form-control">
        </div>

        <div class="form-group">
            <label for="new_email">E-mail</label>
            <input type="email" name="new_email" class="form-control">
        </div>

        <div class="form-group">
            <label for="new_password">Password</label>
            <input type="password" name="new_password" class="form-control">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Add User" name="add_user">
        </div>

    </form>
</div>