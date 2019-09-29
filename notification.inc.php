<?php

if(isset($_POST['submit_decline'])) {
  include_once 'iu_dbc.inc.php';
  $co_name = $_POST['co_name'];
  $cs_id = $_POST['cat_sitter_id'];
  $res_timestamp = $_POST['timestamp'];
  $res_time_id = $_POST['res_time_id'];
  $co_email = $_POST['co_email'];
  $rev_id = $_POST['rev_id'];
  //Email Notice to the cat_owner that their reservation was decline by the cat_sitter
  $to_email = "$co_email";
  $subject = "IUMeow Cat Sitter Reservation Decline Notice ";
  $body = "We apologize to inform you that the cat sitter that you requested on $res_timestamp has declined your reservation. While we apologize, there are many other qualified cat sitters to choose from on our platform. Please consider finding a better fit for your request: http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php

  Best,
  IU Meow Team";
  $headers = "From: ejmarin3425@gmail.com";
  mail($to_email, $subject, $body, $headers);
  $sql = "DELETE FROM pending_agreements WHERE rev_id = '$rev_id';";
  $result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
  $sql = "DELETE FROM reservations WHERE res_time_id = '$res_time_id';";
  $result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
  header("Location: ../redplanet/notification.php?Reservation=Declined");
  exit();



} else {
  if(isset($_POST['submit_confirm'])){
    include_once 'iu_dbc.inc.php';
    include_once 'header.php';
    $co_name = $_POST['co_name'];
    $cs_id = $_POST['cat_sitter_id'];
    $res_timestamp = $_POST['timestamp'];
    $res_time_id = $_POST['res_time_id'];
    $co_email = $_POST['co_email'];
    $rev_id = $_POST['rev_id'];
    $sql = "SELECT cs.first_name, cs.last_name, r.co_name, r.co_start_date, r.co_end_date, cs.phone, cs.email, cp.hr_rate
            FROM cat_sitters AS cs, cat_sitters_profiles AS cp, reservations AS r
            WHERE cs.user_id = cp.user_id AND cs.user_id = r.cat_sitter_id AND r.reservation_id = '$rev_id';";
    $result = pg_query($sql);
    $row = pg_fetch_array($result, 0 , PGSQL_ASSOC);
    //print_r($row);
    $cs_first_name = $row['first_name'];
    $cs_last_name = $row['last_name'];
    $co_name = $row['co_name'];
    $co_start_date = $row['co_start_date'];
    $co_end_date = $row['co_end_date'];
    $cs_phone = $row['phone'];
    $cs_email = $row['email'];
    $cs_hr_rate = $row['hr_rate'];

    echo "
    <html>
    <head>
      <meta charset='UTF-8'>
      <title>Terms of Agreement</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
      <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
      </head>
      <body>
      <div class='container' >
      <center>

    <br>
      <h2>Mutual Agreement Contract</h2>
        <h3 class='text-danger'>Between $cs_first_name $cs_last_name & $co_name</h3>
      </center>

      <h3>Cat-sitter agrees to the following:</h3>
      <p>I, <u><span class='text-danger font-weight-bold '>$cs_first_name $cs_last_name</span></u>, agree to the following terms and conditions for the purpose of this peer-to-peer service agreement:
    </p>
        <p>I will follow the specific instructions laid out by <u><span class='text-danger font-weight-bold '>$co_name</span></u> for the duration of
            <u><span class='text-danger font-weight-bold '>$co_start_date - $co_end_date</span></u>.
            I will be paid in full upon the e-signed return of this agreement via <u><span class='text-danger font-weight-bold '>$co_name</span></u>.
            My contact information is <u><span class='text-danger font-weight-bold '>$cs_phone or $cs_email</span></u> and I can be reached daily during the duration of my cat-sitting responsibilities.
            If a problem occurs during the length of my cat-sitting responsibilities, it is up to me to contact
            <u><span class='text-danger font-weight-bold '>$co_name</span></u> in a timely manner to notify of any incidents.
            It is my and <u><span class='text-danger font-weight-bold '>$cs_first_name $cs_last_name</span></u>’s responsibility to arrange and plan any meetings before the start date of my cat-sitting duties.
</p>
<h3>Cat-Sitter E-Signature:</h3>
<form action='terms_of_agreement.cs.php' method='POST'>
<input type='text' name='e_signature' id='e-signature' class='form-control' placeholder='Type Full Name Here'>
<input type='hidden' name='rev_id' value='$rev_id'>
<input type='hidden' name='cs_id' value='$cs_id'>
<input type='hidden' name='co_email' value='$co_email'>
<input type='hidden' name='co_email' value='$co_email'>
<input type='hidden' name='cs_hr_rate' value='$cs_hr_rate'>
<input type='hidden' name='co_start_date' value='$co_start_date'>
<input type='hidden' name='co_end_date' value='$co_end_date'>
<input type='hidden' name='cs_first_name' value='$cs_first_name'>
<input type='hidden' name='cs_last_name' value='$cs_last_name'>
<br>
<div class='row'>
  <div class='col-md-6 form-group'>
    <button type='submit'  name='submit' class='btn btn-success text-white font-weight-bold'>Submit</button>
    <div class='submitting'></div>
  </div>
</div>
</form>";
  }
}
