<?php

if(isset($_POST['submit'])) {
  include_once 'iu_dbc.inc.php';
  $full_name = $_POST['full_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $reason = $_POST['reason'];
  $needs = $_POST['needs'];
  $cs_user_id = $_POST['cs_user_id'];
  $term_approval = $_POST['term_approval'];
  $co_start_date = $_POST['co_start_date'];
  $co_end_date = $_POST['co_end_date'];


if(empty($full_name) || empty($phone) || empty($email) || empty($address) || empty($reason) || empty($cs_user_id) || empty($term_approval) || empty($co_start_date) || empty($co_end_date)) {
  header("Location: ../redplanet/index.php?signup=empty");
  exit();
} else {
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header("Location: ../redplanet/reservations.php?signup=invalid_email");
    exit();

} else {

   if($co_start_date > $co_end_date) {
     header("Location: ../redplanet/index.php?date=error");
     exit();
   } else {
/*
CREATE TABLE reservations (
    reservation_id SERIAL not null primary key,
    cat_sitter_id integer REFERENCES cat_sitters(user_id),
    co_name varchar(256) not null,
    co_phone varchar(256) not null,
    co_email varchar(256) not null,
    co_address varchar(256) not null,
    co_reason varchar(1000) not null,
    co_specific_needs varchar(1000),
    co_start_date varchar(256) not null,
    co_end_date varchar(256) not null,
    term_approval_status varchar(256) not null,
    res_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    res_time_id varchar(256)

  );

*/

  $sql = "INSERT INTO reservations (cat_sitter_id, co_name, co_phone, co_email, co_address, co_reason, co_specific_needs, co_start_date, co_end_date ,term_approval_status) VALUES ('$cs_user_id','$full_name','$phone','$email','$address','$reason','$needs','$co_start_date','$co_end_date','$term_approval');";
  $result = pg_query($sql) or die('Query Failed: ' .pg_last_error());

  $sql = "SELECT * FROM reservations ORDER BY reservation_id DESC LIMIT 1";
  $result = pg_query($sql);
  $row_counter = 0;
  while($row = pg_fetch_array($result, $row_counter,  PGSQL_ASSOC)){
    $reservation_id = $row['reservation_id'];
    $timestamp = $row['res_timestamp'];
    echo $timestamp;
    echo "<br>";
    $row_counter++;
  }
  $time_id = str_replace("-","",$timestamp);
  $time_id = str_replace(" ","", $time_id);
  $time_id = str_replace(":","", $time_id);
  $sql = "UPDATE reservations
          SET res_time_id = $time_id
          WHERE reservation_id = $reservation_id;";
  $result = pg_query($sql);
  $sql = "SELECT * FROM cat_sitters WHERE user_id = '$cs_user_id';";
  $result = pg_query($sql);
  $row = pg_fetch_array($result,0, PGSQL_ASSOC); //Since we are only calling on one row, not using the while loop command here makes sense.
  print_r($row);
  $cs_email= $row['email'];
  $to_email = "$cs_email";
  $subject = "IUMeow Cat Sitter Reservation Request Notice ";
  $body = "We are happy to inform you that a cat owner has requested your assistance in caring for their special furry friend(s). Please confirm or decline the request as soon as possible through the following link: http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/notification.php or simply login to your IUMeow account to confirm or decline the reservation request!

  Best,
  IU Meow Team";
  $headers = "From: ejmarin3425@gmail.com";
  mail($to_email, $subject, $body, $headers);
  header("Location: ../redplanet/index.php?Reservation=Sent");
  exit();






  //header("Location: ../redplanet/index.php?Reservation=Sent");
  //exit();
}
}
}
}
