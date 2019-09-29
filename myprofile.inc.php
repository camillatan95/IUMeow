<?php
if (isset($_POST['submit'])) {
  include_once 'iu_dbc.inc.php';
  session_start();
//Carrying over our inputs from the form into php variables.
  $city = $_POST['city'];
  $user_id = $_SESSION['u_id'];
  $hr_rate= $_POST['hr_rate'];
  $num_cats = $_POST['num_cats'];
  $start_date = $_POST['start'];
  $end_date = $_POST['end'];
  $bio = $_POST['bio'];
  $file = $_FILES['profile_pic'];
  $filename = $_FILES['profile_pic']['name'];
  $filetmpname = $_FILES['profile_pic']['tmp_name'];
  $filesize = $_FILES['profile_pic']['size'];
  $fileerror = $_FILES['profile_pic']['error'];
  $filetype = $_FILES['profile_pic']['type'];

/*
This is how you separate the filetype php variable and get extract only the jpeg element and element the image element through the / separator.
$test= explode('/',$filetype);
print_r($test);
echo "<br>";
echo $test['1'];
*/


  /*
  Creating the profile image database

    CREATE TABLE profileimg (
    id SERIAL not null primary key,
    user_id integer not null,
    status integer not null
  );
  */
if($fileerror == 4) {
  $sql = "SELECT profile_img FROM cat_sitters_profiles WHERE user_id = '$user_id';";
  $result = pg_query($sql);
  $row = pg_fetch_array($result,0,PGSQL_ASSOC);
  $filedestination = $row['profile_img'];

} else {

if(isset($filename)) {
  $fileext = explode('.', $filename);
  $fileactualext = strtolower(end($fileext));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if(in_array($fileactualext, $allowed)) {
    if($fileerror === 0) {
      if($filesize < 1000000) {
          $filenamenew = uniqid('', true).".".$fileactualext;
          $typeext= explode('/',$filetype);
          $actual_type_ext = $typeext['1'];
          $filedestination = 'images/profile_photos/'.$user_id.".".$actual_type_ext; //in the example, they used the $filenamenew variable but for our purposes, we are using our session id variable instead.
          move_uploaded_file($filetmpname, $filedestination) or die('Query Failed: ' .pg_last_error());
          chmod("$filedestination", 0644); //This ensures that the file has the right set of permissions so that it can be viewed.
          echo "success";

      } else {
        header("Location: ../redplanet/myprofile.php?file=size_error");
        exit();
      }
    } else {
      header("Location: ../redplanet/myprofile.php?file=upload_error");
      exit();
    }

  } else {
    header("Location: ../redplanet/myprofile.php?file=type_error");
    exit();
  }
} else {
  $filedestination = 'images/profile_photos/generic_photo.jpeg';
}


//print_r($file);
//echo $filetype;

}
}
if(empty($user_id) || empty($city) || empty($num_cats) || empty($start_date) || empty($end_date) || empty($hr_rate) || empty($file) || empty($bio)) {
  header("Location: ../redplanet/myprofile.php?signup=empty");
  exit();
} else {
  //Format the dates that were submitted
$start_date_ymd = date('Y-m-d', strtotime($start_date));
$end_date_ymd = date('Y-m-d', strtotime($end_date));
 if($start_date_ymd > $end_date_ymd) {
   header("Location: ../redplanet/myprofile.php?date=error");
   exit();
 } else {

   $sql="SELECT * FROM cat_sitters_profiles WHERE user_id ='$user_id'";
   $result= pg_query($sql) or die('Query Failed: ' .pg_last_error());
   $resultcheck = pg_num_rows($result);

   if($resultcheck > 0 ) {
     $sql = "UPDATE cat_sitters_profiles SET
        city ='$city',
        hr_rate ='$hr_rate',
        num_cats = '$num_cats',
        start_date = '$start_date_ymd',
        end_date = '$end_date_ymd',
        profile_img = '$filedestination',
        bio = '$bio'
        WHERE user_id = '$user_id';";
      $result = pg_query($dbconn, $sql);
      header("Location: ../redplanet/myprofile.php?Update=Success");
      echo "<div class='alert alert-success' role='alert'>Your profile is successfully updated!</div>";
      exit();
   } else {


 /*
The sql code used to create the cat_sitter_profiles data table.

CREATE TABLE cat_sitters_profiles (
  update_id SERIAL not null primary key,
  user_id integer REFERENCES cat_sitters(user_id),
  city varchar(256) not null,
  hr_rate varchar(256) not null,
  num_cats varchar(256) not null,
  start_date varchar(256) not null,
  end_date varchar(256) not null,
  profile_img varchar(256) not null,
  bio varchar(500) not null

); */

   $query= "INSERT INTO cat_sitters_profiles (user_id, city, hr_rate, num_cats, start_date, end_date, profile_img, bio) VALUES ('$user_id', '$city', '$hr_rate' , '$num_cats', '$start_date_ymd', '$end_date_ymd', '$filedestination', '$bio');";
   $result= pg_query($query) or die('Query Failed: ' .pg_last_error());
   header("Location: ../redplanet/myprofile.php?Submit=Success");
   //$message = "Your profile is successfully updated!";
   //echo "<div class="alert alert-success" role="alert">
  //Your profile is successfully updated!</div>";
  //<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  //echo"swal("Hello world!")";
   //echo "<script type='text/javascript'>alert('$message');</script>";
   exit();
 }
}
}
