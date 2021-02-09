<?php 
    define("TITLE", "Contact | Just For Fun");
    include("includes/header.php");
?>

<div class="contact-container">
    <h1 class="contact-h1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, harum.</h1>

    <?php

    //This is to check  for header injections
    function has_header_injection($string) {
        return preg_match("/[\r\n]/", $string);
    }

    if (isset($_POST['submit'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = $_POST['message'];

        //check to see if $name or $email have header injections
        if (has_header_injection($name) || has_header_injection($email)) {
            die();
        }
        if (!$name || !$email || !$message) {
            echo '
            <form class="contact-form" action="contact.php#submitted" method="post" id="submitted">
            <h4 class="error">All fields required.</h4><input type="submit" name="go-back" value="Go back">
            </form>
            ';
            exit;
        }
        // the recipient
        $to = "remember_richard@hotmail.se";
        $subject = "$name sent you a message. $dummyName.";
        //the message
        $sentMessage = "Name: $name\r\n";
        $sentMessage .= "Email: $email\r\n";
        $sentMessage .= "Message:\r\n$message";

        //if the subscribe was checked
        if (isset($_POST['subscribe']) && $_POST['subscribe'] == 'Subscribe') {
            $sentMessage .= "\r\n\r\nPlease add $email to your mailing list.\r\n";
        }
        // wrap it to 72 characters per line
        $sentMessage = wordwrap($sentMessage, 72);

        // set the mail headers into a varible
        $headers = "MIME-version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "From: $name <$email> \r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n\r\n";

        // send the email
        mail($to, $subject, $message, $headers);

    ?>

    <!-- Show success message after email sent -->

    <?php            
    echo '
    <form class="contact-form" action="contact.php#submitted" method="post" id="submitted">
    <h4>Thanks for contacting Just For Fun!</h4><input type="submit" name="write-again" value="Write again">
    </form>
    '; ?>
<!-- <h5>Thanks for contacting Just For Fun!</h5>
<p>Please allow 24 hours for a response</p>
<p><a href="index.php">&laquo; Go to Home Page</a></p> -->


    <?php } else { ?>

    <form class="contact-form" action="contact.php#submitted" method="post" id="submitted">
        <!-- Your name -->
    <label for="name" class="contact-titles">Your name:</label>
    <input type="text" name="name" id="name" class="left">
    <!-- Email -->
    <label for="email" class="contact-titles">Your name:</label>
    <input type="email" name="email" id="email" class="left">
    <!-- Message -->
    <label for="message" class="contact-titles">Message:</label>
    <textarea name="message" id="message" class="left"></textarea>
    <!-- If not already subscribed -->
    <div class="test">
        <input type="checkbox" name="subscribe" id="subscribe" value="Subscribe">
        <label for="subscribe">Subscribe to us.</label>
    </div>
    <input type="submit" name="submit" value="Send">
</form> <!-- contact-form -->
</div> <!-- contact-container -->

<?php } ?>

<?php include("includes/footer.php"); ?>