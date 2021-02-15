<?php 
    define('TITLE', 'Account | Just For Fun');
    include('includes/header.php');
?>

Are you ready to join us ? Sign up!
<form method="POST" action="handleSignup.php">
<input type="text" placeholder="Insert username" name="usernamesign" /><br />
<input type="password" placeholder="Insert password" name="passwordsign" /><br />
<input type="password" placeholder="Confirm password" name="confirm"><br/>
<input type="submit" value="Sign up!" />
</form>
<p>Already have an account? Login here</p>
<form action="konto.php" method="POST">
<input type="text" placeholder="Insert username" name="username" /><br />
<input type="password" placeholder="Insert password" name="password" /><br />
<input type="submit" name="submit" value="Login">
</form>


<?php include('includes/footer.php'); ?>