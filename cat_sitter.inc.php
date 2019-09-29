<?php
if (isset($_POST['submit'])) {
  include_once 'iu_dbc.inc.php';
//Carrying over our inputs from the form into php variables.
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $pwd = $_POST['password'];
  $phone= $_POST['phone'];
  $email= $_POST['email'];
  $paypal=$_POST['paypal'];
  $term_status = $_POST['term_approval'];

}

if(empty($first_name) || empty($last_name) || empty($pwd) || empty($phone) || empty($email) || empty($paypal) || empty($term_status)) {
  header("Location: ../redplanet/index.php?signup=empty");
  exit();

  } else {
          if (!preg_match("/^[a-zA-Z]*$/", $first_name) || !preg_match("/^[a-zA-Z]*$/", $last_name) ) {

                header("Location: ../redplanet/index.php?signup=invalid");
                exit();
   }else{
         //check if email is valid
           if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           header("Location: ../redplanet/index.php?signup=invalid_email");
             exit();
           } else {

             $sql="SELECT * FROM cat_sitters WHERE email='$email'";
             $result= pg_query($dbconn, $sql) or die('Query Failed: ' .pg_last_error());
             $resultcheck= pg_num_rows($result);

             if($resultcheck > 0) {
               header("Location: ../redplanet/index.php?email=taken");
               exit();
             } else {


             $query= "INSERT INTO cat_sitters (first_name, last_name, pwd, phone, email, paypal, term_approval_status) VALUES ('$first_name', '$last_name', '$pwd' , '$phone', '$email', '$paypal','$term_status');";
             $result= pg_query($query) or die('Query Failed: ' .pg_last_error());
             header("Location: ../redplanet/index.php?signup=success");
             exit();
           }
   }


}

}

/*
CREATE TABLE cat_sitters (
user_id SERIAL not null primary key,
first_name varchar(256) not null,
last_name varchar(256) not null,
pwd varchar(256) not null,
phone varchar(256) not null,
email varchar(256) not null,
paypal varchar(256) not null,
term_approval_status varchar(256) not null
); */
