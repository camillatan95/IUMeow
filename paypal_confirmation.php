<?php
$rev_id= $_GET['rev_id'];
if(isset($rev_id)){
  include_once 'iu_dbc.inc.php';
$rev_id_array = explode(".", $rev_id);
$reservation_id = $rev_id_array[0];
$sql = "UPDATE pending_agreements
        SET co_owner_invoice_status = $reservation_id
        WHERE rev_id = $reservation_id;";
$result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
$sql = "SELECT cs.email, cs.first_name, cs.last_name, r.co_name
        FROM pending_agreements AS pa, cat_sitters AS cs, reservations AS r
        WHERE cs.user_id = r.cat_sitter_id AND r.reservation_id = pa.rev_id AND pa.rev_id = '$reservation_id';";
$result = pg_query($sql);
$row = pg_fetch_array($result, 0 , PGSQL_ASSOC);
$cs_email = $row['email'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$co_name = $row['co_name'];
//Next step is to send an email to the cat_sitter that the invoice has been sent. We then need to write an sql query in the notification.php file that if the status in the pending data table is not null, then we
$to_email = "$cs_email";
$subject = "IUMeow Reservation Invoice Confirmation";
$headers = "From: ejmarin3425@gmail.com";
$headers = "Content-Type: text/html; charset=UTF-8\r\n";
$body = " Hello $first_name,
Congragulations! The following cat-owner, $co_name, has completed your invoice request! Your invoice will be trasnferred to your paypal account, minus IU Meow's 5% commission, at the conclusion of your cat-sitting assingment! Thank you for using IU Meow and thank you for making our community better!

Link: http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php

Best,
IU Meow Team";
mail($to_email, $subject, $body, $headers);
header("Location: ../redplanet/index.php?Paypal=Success");
exit();

/*
header("Location: ../redplanet/index.php?Paypal=Transaction_Complete");
exit(); */

} else {
  header("Location: ../redplanet/index.php?Paypal=error");
  exit();
}
