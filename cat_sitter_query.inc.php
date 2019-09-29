
<?php

include_once 'header.php';

  if(isset($_POST['submit'])) {
    include_once 'iu_dbc.inc.php';
    //Carrying over our inputs from the form into php variables.
    $start_date= $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $city= $_POST['city'];
    $num_cats= $_POST['num_cats'];


if(empty($start_date) || empty($end_date) || empty($city) || empty($num_cats)) {
    header("Location: ../redplanet/index.php?searchfields=empty");
    exit();
  }

  else {
    //Format the dates that were submitted
  $start_date_ymd = date('Y-m-d', strtotime($start_date));
  $end_date_ymd = date('Y-m-d', strtotime($end_date));
  if($start_date_ymd > $end_date_ymd) {
    header("Location: ../redplanet/index.php?date=error");
    exit();
  }else {

/* This is how you can get rows manually.
    $query= "SELECT * FROM cat_sitters";
    $result= pg_query($query) or die('Query Failed: ' .pg_last_error());

    $row = pg_fetch_array($result,0, PGSQL_NUM);
    echo $row[0];
    $row = pg_fetch_array($result,1, PGSQL_NUM);
    echo $row[0];
    $row = pg_fetch_array($result,2, PGSQL_NUM);
    echo $row[0];
    $row = pg_fetch_array($result,3, PGSQL_NUM);
    echo $row[0];
    $row = pg_fetch_array($result,4, PGSQL_NUM);
    echo $row[0];*/

    $query= "SELECT cs.user_id, cs.first_name, cs.last_name, cs.phone, cs.email, cp.city, cp.hr_rate, cp.num_cats, cp.start_date, cp.end_date, cp.profile_img, cp.bio
    FROM cat_sitters AS cs, cat_sitters_profiles AS cp
    WHERE cs.user_id=cp.user_id AND cp.city='$city' AND cp.num_cats>='$num_cats' AND cp.start_date <='$start_date' AND cp.end_date>='$end_date';";
    $result= pg_query($query) or die('Query Failed: ' .pg_last_error());

$row_counter=0;
echo "<br>";




/*
echo"
  <table>";
   echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>City</th>
            <th>Hourly Rate</th>
            <th>Cat Sitting Capacity</th>
            <th>Start Date of Availabilty</th>
            <th>End Date of Availabilty</th>
        </tr>";
  echo "<tr><td>";
  echo $row["first_name"]." " ;
  echo "</td><td>";
  echo $row["last_name"]." ";
  echo "</td><td>";
  echo $row["phone"]." ";
  echo "</td><td>";
  echo $row["email"]." ";
  echo "</td><td>";
  echo $row["city"]." ";
  echo "</td><td>";
  echo $row["hr_rate"]." ";
  echo "</td><td>";
  echo $row["num_cats"]." ";
  echo "</td><td>";
  echo $row["start_date"]." ";
  echo "</td><td>";
  echo $row["end_date"];
  echo "</td></tr>";
  //cs stands for cat sitter
  $profile_photo = $row["profile_img"];
  $cs_first_name = $row["first_name"];
  $cs_last_name = $row["last_name"];
  $cs_phone = $row["phone"];
  $cs_email = $row["email"];
  $cs_city = $row["city"];
  $cs_hr_rate = $row["hr_rate"];
  $cs_num_cats = $row["num_cats"];
  $cs_start_date = $row["start_date"];
  $cs_end_date = $row["end_date"];
  $cs_user_id = $row["user_id"];
*/
//cs stands for cat sitter

/*
<table>
<tr>
  <th>Dog</th>
  <th>cat</th>
</tr>
<td>
......
</td></tr>
</div>
</div>
*/

  //$row_counter++;
}
echo "</table";
//}
}}
?>


<!doctype html>
<html>
<head>
  <meta charset='UTF-8'>
  <title>Cards</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
  <link rel='stylesheet' type='text/css' href='cards.css'>
  <body>
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
    <br><br>
    <div class='container'>
    <div class='row'>


<?php
    while($row= pg_fetch_array($result, $row_counter, PGSQL_ASSOC)) {

    $profile_photo = $row["profile_img"];
    $cs_first_name = $row["first_name"];
    $cs_last_name = $row["last_name"];
    $cs_phone = $row["phone"];
    $cs_email = $row["email"];
    $cs_city = $row["city"];
    $cs_hr_rate = $row["hr_rate"];
    $cs_num_cats = $row["num_cats"];
    $cs_start_date = $row["start_date"];
    $cs_end_date = $row["end_date"];
    $cs_user_id = $row["user_id"];
    $bio = $row["bio"];
echo"
<div class='col-md-6 col-lg-4' data-aos='fade-up' data-aos-delay='100'>
  <div class='block-2'>
    <div class='flipper'>
      <div class='front' style='background-image: url($profile_photo);'>
        <div class='box'>
          <h2>$cs_first_name $cs_last_name</h2>
          <p>$cs_city</p>
        </div>
      </div>
      <div class='back' style='background-image: url(images/w.jpg);background-size: cover; text-align:center;'>

      <form action='reservations.php' onSubmit='alert('Your reservation has been sent to this cat sitter! You should receive a response shortly.');' method='POST' autocomplete='on'>


        Cat Sitting Capacity
        <input type='city' style='background-color:#edeeef; height:30px' class='form-control' id='num_cats' name = 'cs_num_cats'value='$cs_num_cats' readonly>

        Daily Rate
        <input style='background-color:#edeeef; height:30px' type='text' class='form-control' id='hr_rate' name='cs_hr_rate' value=$$cs_hr_rate readonly>
            Start of Availabilty
            <input style='background-color:#edeeef; height:30px' type='date' class='form-control' id='cs_start_date' name='cs_start_date' value = $cs_start_date readonly>
        End of Availability
            <input style='background-color:#edeeef; height:30px;' type='date' class='form-control' id='cs_end_date' name='cs_end_date' value = '$cs_end_date' readonly>
        Bio
          <textarea style='background-color:#edeeef;' id ='bio' name = 'bio' class = 'form-control' maxlength='500' rows='3' readonly>$bio</textarea>
          <input type='hidden' class='form-control' id='cs_user_id' name='cs_user_id' value = '$cs_user_id' readonly>
        <button type='submit' name='submit' id='myModal' class='btn btn-danger text-white' style='float:right'>Reserve</button>
        <br>
      </form>

        <!-- back content -->
        <div class='author d-flex'>
          <div class='image mr-3 align-self-center'>
            <img src='$profile_photo' alt=''>
          </div>
          <div class='name align-self-center'>$cs_first_name $cs_last_name<span class='position'>$cs_city</span></div>
        </div>
      </div>
    </div>
  </div> <!-- .flip-container -->
  </div>
  ";
$row_counter++;}
?>

<!--
    <div class='col-lg-6'>
    <div class='flip-box'style='height:500px'>
    <div class='flip-box-inner'>

    <div class='flip-box-front'>
      <img src='$profile_photo' alt='Card image' style='width:50%'>
        <div class='form-group'>
            <label for='usr'>Name</label>
            <input type='text' class='form-control' id='cat_sitter_id' value='$cs_first_name $cs_last_name' readonly>
        </div>
      <div class='form-group'>
      <label for='usr'>City</label>
      <input type='city' class='form-control' id='city' value='$city' readonly>
      </div>
    <div class='form-group'>
    <label for='usr'>Hourly Rate</label>
    <input type='city' class='form-control' id='hr_rate' value=$$cs_hr_rate readonly>
    </div>


  </div>

      <div class='flip-box-back'><br>
      <div class='form-group'>
      <label for='usr'>Cat Sitting Capacity</label>
      <input type='city' class='form-control' id='num_cats' value='$cs_num_cats' readonly>
      </div>
          <div class='form-group'>
              <label for='usr'>Start of Availabilty</label>
              <input type='rates' class='form-control' id='cs_start_date' value = $cs_start_date readonly>
          </div>
          <div class='form-group'>
              <label for='usr'>End of Availability</label>
              <input type='availability' class='form-control' id='cs_end_date' value = '$cs_end_date' readonly>
          </div>
          <div class='form-group'>
            <label for='usr'>Bio</label>
            <input type='bio' class='form-control' id='pwd'>
          </div>
          <div class='form-group'>
              <label for='usr'>Reserve</label>
              <button type='submit' name='submit' class='btn btn-danger btn-block text-white'>Reserve</button>
          </div>

      </div>


  </div>
  </div>
</div>-->
<?php
      echo"
      <div class='col-lg-6'>
      <br><br>
      <p style='text-align:center;'><span style='font-weight: bold;''>$row_counter</span> results for &#171 start date: $start_date, end date: $end_date, city: $city, $num_cats number of cat &#187</p>
      </div>
      ";
?>
</div>
</div>
<br><br>



</body>
</html>
