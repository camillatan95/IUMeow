<?php
if(isset($_POST['submit'])) {
  include_once 'iu_dbc.inc.php';
  $rev_id = $_POST['rev_id'];
  $cs_id = $_POST['cs_id'];
  $e_sig = $_POST['e_signature'];
  $co_email = $_POST['co_email'];
  $cs_hr_rate = $_POST['cs_hr_rate'];
  $co_start_date = $_POST['co_start_date'];
  $co_end_date = $_POST['co_end_date'];
  $cs_first_name = $_POST['cs_first_name'];
  $cs_last_name = $_POST['cs_last_name'];

  if(empty($rev_id) || empty($cs_id) || empty($e_sig) || empty($co_email) || empty($cs_hr_rate) || empty($co_start_date) || empty($co_end_date)){
    header("Location: ../redplanet/notification.php?Contract_Fields=Empty");
    exit();
  } else {

    $start_date_ymd = date('Y-m-d', strtotime($co_start_date));
    $end_date_ymd = date('Y-m-d', strtotime($co_end_date));

$diff = ((strtotime($co_end_date))-strtotime($co_start_date));
$days_of_service = ($diff/86400);
$invoice_amount = ($days_of_service*$cs_hr_rate);
/*
echo "
<div id='paypal-button'></div>
<script src='https://www.paypalobjects.com/api/checkout.js'></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AbdJlcp9iZQ5Rlt2oNnCapBOz_4IoDaLgVNaUu4IkPegXAXe5tUPZ3oSHTUuAuCuRP7rOEuP708_Rs3d'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },
    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '$invoice_amount',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.location.href = 'http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php';
      });
    }
  }, '#paypal-button');

  </script>


";*/



/*
CREATE TABLE pending_agreements (
  agreement_id SERIAL not null primary key,
  cs_id integer REFERENCES cat_sitters(user_id),
  rev_id integer REFERENCES reservations(reservation_id),
  e_sig varchar(256) not null,
  co_email varchar(256) not null,
  co_owner_invoice_status varchar(256)
);
*/

$sql = "SELECT * FROM pending_agreements WHERE cs_id = '$cs_id' AND rev_id = '$rev_id';";
$result = pg_query($sql);
$resultcheck = pg_num_rows($result);
if($resultcheck > 0 ){
  header("Location: ../redplanet/notification.php?Reservation=Already_Pending");
  exit();
} else {


$sql = "INSERT INTO pending_agreements (cs_id, rev_id, e_sig, co_email) VALUES ('$cs_id', '$rev_id', '$e_sig','$co_email');";
$result = pg_query($sql) or die(pg_last_error());


    $to_email = "$co_email";
    $subject = "IUMeow Reservation Invoice Request";
    $headers = "From: ejmarin3425@gmail.com";
    $headers = "Content-Type: text/html; charset=UTF-8\r\n";
    $body = " The following cat-sitter, $cs_first_name $cs_last_name, has accepted your cat sitting reservation request. Please confirm the reservation invoice below to complete the cat-sitting reservation transaction.

    Invoice Amount Due: $$invoice_amount

    <form action='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/paypal_checkout.php' method='POST'>
    <input type='hidden' name='invoice' value='$invoice_amount'>
    <input type='hidden' name='rev_id' value='$rev_id'>
    <input type='hidden' name='cs_id' value='$cs_id'>
    <button type='submit' name='submit_invoice'>Submit Invoice</button>
    </form>
    <html>
<body>

</body>
</html>

    Best,
    IU Meow Team";
    mail($to_email, $subject, $body, $headers);

    header("Location: ../redplanet/index.php?Invoice=Sent");
    exit();
  }

}
}
