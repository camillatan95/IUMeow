<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php


session_start();

if (isset($_POST['submit'])) {

    include_once 'iu_dbc.inc.php';
  //Carrying over our inputs from the form into php variables.
    $email= $_POST['email'];
    $pwd= $_POST['password'];

  }

  if(empty($email) || empty($pwd)) {
    $message = "Please enter your email and passwords";
echo "<script type='text/javascript'>alert('$message');</script>";

//echo"<script type="text/javascript">location.href = 'http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php';</script>";
//header("Location: ../redplanet/index.php?login=empty");

  } else {
    $query= "SELECT * FROM cat_sitters WHERE email='$email';";
    $result= pg_query($dbconn,$query) or die('Query Failed: ' .pg_last_error());
//pg_num_rows returns back the number rows that satisfy the query
    $resultcheck = pg_num_rows($result);
    if($resultcheck < 1) {
        header("Location: ../redplanet/index.php?login=error");
        //echo'alert("Incorrect email or password")';
        exit();
    } else {
      if ($row = pg_fetch_assoc($result)) {
      //login the user here
       $_SESSION['u_id'] = $row['user_id'];
       $_SESSION['u_first'] = $row['first_name'];
       $_SESSION['u_last'] = $row['last_name'];
       $_SESSION['u_email'] = $row['email'];
       $_SESSION['paypal'] = $row['paypal'];
       header("Location: ../redplanet/index.php?login=success");
       exit();
    }
  }
}
