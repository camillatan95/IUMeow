<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reset Passwords</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/fancybox.min.css">
  <link rel="stylesheet" href="css/_custom.css">
  <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<br><br><br><br><br>
<div class="container">
    <div class="wrapper-main">
  <center>
  <h2>Reset Your Password</h2>


<?php
session_start();

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $token = $_POST['token'];
  //$sql = "SELECT * FROM tokens WHERE email = '$'"
  echo"

  <form action='reset_password.inc.php' method='POST'>
    <label>Please enter your new password</label>
    <div class='col-5'>
    <input type='password' name='new_password' id='newP' class='form-control' >
    <input type='hidden' name='email' value='$email'>
    <input type='hidden' name='token' value='$token'>

    </div>
    <button id='reset' type='submit' name='confirm' class='btn btn-danger text-white font-weight-bold'>Confirm</button>
    <div class='col-5'>
  </form>
  ";
}

/*
CREATE TABLE tokens (
  token_id SERIAL not null primary key,
  email varchar REFERENCES cat_sitters(email),
  token varchar(256) not null
);
*

if (isset($_POST['confirm'])){
  $newPassword = $_POST['newP'];
  include_once 'iu_dbc.inc.php';
  $sql = "UPDATE token (cat_sitter_id, co_name, co_phone, co_email, co_address, co_reason, co_specific_needs) VALUES ('$cs_user_id','$full_name','$phone','$email','$address','$reason','$needs');";
  $result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
  header("Location: ../redplanet/index.php?Reservation=Sent");
  exit();
}

/*
  if(empty($password)) {
    header("Location: ..redplanet/create_new_password.php?Password=Empty");
    exit();
  } else {
    include_once ''
  }

}*/
?>
</div>
</div>
</div>


</body>
</html>
