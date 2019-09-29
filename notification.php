
<!doctype html>
<html>
<head>
  <meta charset='UTF-8'>
  <title>Cards</title>
</head>

  <body style = "background-image: url(https://imgnooz.com/sites/default/files/wallpaper/animals/55701/american-wirehair-cat-wallpapers-55701-5988361.jpg); background-size: cover;">
<link rel='stylesheet' type='text/css' href='cards.css'>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/main.js"></script>

<br><br><br><br><br><br><br>
    <div class='container'>
      <h2 style="color: #ea7777"> Your Reservation List</h2><br>
      <p >Please carefully review the information, and choose to confirm or decline your reservations in a timely manner.</p>
      <p>We also highly recommend you to contact the cat owner to dicuss details and build relationship with them before confirming the reservation.</p>
      <br>
      <div class='row'>


<?php
include_once 'header.php';
include_once 'iu_dbc.inc.php';
$cs_user_id = $_SESSION['u_id'];
$sql = "SELECT *
        FROM reservations
        WHERE cat_sitter_id = '$cs_user_id' ORDER BY reservation_id DESC;";
$result = pg_query($sql);
$resultcheck = pg_num_rows($result);
//echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";

while($row = pg_fetch_array($result, $row_counter, PGSQL_ASSOC)) {
  $co_name = $row['co_name'];
  $co_phone = $row['co_phone'];
  $co_email = $row['co_email'];
  $co_address = $row['co_address'];
  $co_reason = $row['co_reason'];
  $co_needs = $row['co_specific_needs'];
  $cs_id = $row['cat_sitter_id'];
  $co_start_date = $row['co_start_date'];
  $co_end_date = $row['co_end_date'];
  $timestamp = $row['res_timestamp'];
  $res_time_id = $row['res_time_id'];
  $rev_id = $row['reservation_id'];

/*echo "
  <div class='row'>
  <form action='cs_agreement.php' method='POST'>

  <input type='text' name='co_name' value='$co_name'>
  <input type='text' name='co_name' value='$co_phone'>
  <input type='text' name='co_name' value='$co_email'>
  <input type='text' name='co_name' value='$co_address'>
  <input type='text' name='co_name' value='$co_reason'>
  <input type='text' name='co_name' value='$co_needs'>
  <button type='submit' name='submit_confirm' class='btn btn-primary text-white font-weight-bold'>Confirm</button>
  <button type='submit' name='submit_decline' class='btn btn-primary text-white font-weight-bold'>Decline</button>

  </form>
    </div>

";*/

echo"
<div class='container'>
<div class='card' style='width:70rem;' data-aos='fade-up' data-aos-delay='100'>
<div class='card-body'>
<form action='notification.inc.php' method='POST'>
<div class='form-group row'>
<div class='col-3'>
  Name<input type='text' class='form-control' name='co_name' value='$co_name' readonly>
</div>
<div class='col-3'>
  Telephone <input type='text' class='form-control' name='co_phone' value='$co_phone' readonly>
</div>
  <div class='col-3'>
  Email <input type='text' class='form-control' name='co_email' value='$co_email' readonly>
</div>
</div>

  <div class='form-group row'>
  <div class='col-3'>
  Address <input type='text' class='form-control' name='co_address' value='$co_address' readonly>
</div>
  <div class='col-7'>
  Reason for Reservation <textarea class='form-control' name='co_reason' readonly>$co_reason</textarea>
</div>
  <div class='col-10'>
  Specific Cat needs <textarea class='form-control' name='co_needs' readonly>$co_needs</textarea>
  </div>

  </div>
  <div class='form-group row'>
  <div class='col-3'>
  Start Date <input type='date' class='form-control' name='co_start_date' value='$co_start_date' readonly>
</div>
<div class='col-3'>
End Date <input type='date' class='form-control' name='co_end_date' value='$co_end_date' readonly>
</div>
</div>
  <br>
  <input type='hidden' name='cat_sitter_id' value='$cs_id'>
  <input type='hidden' name='res_time_id' value='$res_time_id'>
  <input type='hidden' name='timestamp' value='$timestamp'>
  <input type='hidden' name='rev_id' value='$rev_id'>

  <button type='submit' name='submit_confirm' class='btn btn-primary text-white font-weight-bold'>Confirm</button>
  <button type='submit' name='submit_decline' class='btn btn-primary text-white font-weight-bold'>Decline</button>
</form>
</div>
</div>
</div>
<br>
";


$row_counter++;
}
?>

</div>
</div>
</body>
</html>
