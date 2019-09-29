<?php

if($_POST['submit']) {
    $recipient="camitan@iu.edu";
    $subject="Message from IUMeow";
    $sender=$_POST['name'];
    $senderEmail=$_POST['email'];
    $phoneNumber =$_POST['phone'];
    $message=$_POST['message'];

    $mailBody="Name: $sender\nPhone: $phoneNumber\nEmail: $senderEmail\n\n$message";

    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    $thankYou="<p>Thank you! Your message has been sent.</p>";
}
?>
