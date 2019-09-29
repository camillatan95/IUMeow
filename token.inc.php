
<?php
if(isset($_POST['submit'])) {
  include_once 'header.php';
   include_once 'iu_dbc.inc.php';
  $email = $_POST['email'];
  $token = rand();
   $to_email = "$email";
   $subject = "IUMeow: Temporary Password Recovery Token";
   $body = "Here is your temporary token: $token.";
   $headers = "From: ejmarin3425@gmail.com";
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   header("Location: ../redplanet/index.php?signup=invalid_email");
     exit();} else {


   if ( mail($to_email, $subject, $body, $headers)) {
     echo "
     <html>
     <head>
       <meta charset='UTF-8'>
       <title>Reset Passwords</title>
       <meta name='viewport' content='width=device-width, initial-scale=1'>
       <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700'>
       <link rel='stylesheet' href='css/bootstrap.min.css'>
       <link rel='stylesheet' href='css/animate.css'>
       <link rel='stylesheet' href='css/owl.carousel.min.css'>
       <link rel='stylesheet' href='css/aos.css'>
       <link rel='stylesheet' href='css/bootstrap-datepicker.css'>
       <link rel='stylesheet' href='css/jquery.timepicker.css'>
       <link rel='stylesheet' href='css/fancybox.min.css'>
       <link rel='stylesheet' href='css/_custom.css'>
       <link rel='stylesheet' href='fonts/ionicons/css/ionicons.min.css'>
       <link rel='stylesheet' href='fonts/fontawesome/css/font-awesome.min.css'>

     <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
     <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
     <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
     </head>

     <body>
     <br><br><br><br><br>
     <div class='container'>
         <div class='wrapper-main'>
       <center>
       <h2>Reset Your Passwords</h2>

       <form action='reset_password.php' method='POST'>
         <label>Please enter your email (an email will be send to your mailbox)</label>
         <div class='col-5'>
         <input type='text' name='email' id='email' class='form-control' value = '$email' >
         </div>
         <button id='reset' type='submit' name='submit' class='btn btn-danger text-white font-weight-bold'>Send me Token</button>
         <div class='col-5'>
       </form>

       <div class='alert alert-success alert-dismissible'>
         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
         <strong>Success!</strong> Token has been sent to the email above! Please enter the temporary token in the form below.
       </div>

     <form action='reset.inc.php' method='POST'>
         Please enter your token from your email:
     <input type='number' name='token' id='token' class='form-control' >
     <input type='hidden' name='email' value='$email'>  </div>
         <a href='reset.php'>Didn't receive an email?</a>

             <br>
             <br>
             <button id='reset' type='submit' name='submit' class='btn btn-danger text-white font-weight-bold'>Submit</button>
             <div class='submitting'></div>

       </form>
     </div>
     </div>
     </div>

     </body>





     ";
/*
CREATE TABLE tokens (
  token_id SERIAL not null primary key,
  email varchar(256) not null,
  token varchar(256) not null
);

*/
    $sql = "SELECT * FROM tokens WHERE email = '$email';"; //confirm that the right combination of email and token have been submitted through the form and are contained within the database.
    $result = pg_query($sql);
    $result_check = pg_num_rows($result);
    if($result_check > 0 ){
      $sql = "UPDATE tokens SET
      token = '$token'
      WHERE email = '$email';";
      $result = pg_query($sql);
    } else {

     $sql = "INSERT INTO tokens (email, token) VALUES ('$email', '$token');";
     $result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
   }
   } else {
     header("Location: ../redplanet/reset.php?email=error");
     exit();
   }

 }}
