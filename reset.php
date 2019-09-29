<?php
include_once 'header.php';
session_start();
?>

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
  <h2>Reset Your Passwords</h2>

  <form action="token.inc.php" method="POST" onsubmit="The temporary token has been sent to your email! Please enter the temporary token into the form below.">
    <label>Please enter your email (an email will be send to your mailbox)</label>
    <div class="col-5">
    <input type="text" name="email" id="email" class="form-control" >
    </div>
    <button id="reset" type="submit" name="submit" class="btn btn-danger text-white font-weight-bold">Send me Token</button>
    <div class="col-5">
  </form>

<form action="reset.inc.php" method="POST">
    Please enter your token from your email:
<input type="text" name="token" id="token" class="form-control" >  </div>
    <a href="reset.php">Didn't receive an email?</a>
        <br>
        <br>
        <button id="reset" type="submit" name="submit" class="btn btn-danger text-white font-weight-bold">Submit</button>
        <div class="submitting"></div>

  </form>
</div>
</div>
</div>

</body>
</html>
