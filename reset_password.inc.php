
<?php
if(isset($_POST['confirm'])) {
  include_once 'iu_dbc.inc.php';
  $new_password = $_POST['new_password'];
  $email = $_POST['email'];
  $token = $_POST['token'];

if(empty($new_password) || empty($email) || empty($token)) {
  header("Location: ../redplanet/reset.php?fields=empty");
  exit();
}else{
$sql = "SELECT * FROM tokens WHERE email = '$email' AND token = '$token';";
$result = pg_query($sql);
$resultcheck = pg_num_rows($result);
if($resultcheck > 0 ){
  $sql = "UPDATE cat_sitters SET
          pwd = '$new_password'
          WHERE email = '$email';";
$result = pg_query($sql) or die(pg_last_error());

$sql = "DELETE FROM tokens WHERE email = '$email' and token = '$token';";
$result = pg_query($sql) or die(pg_last_error());

header("Location: ../redplanet/index.php?password=Updated");
exit();

} else {
  header("Location: ../redplanet/reset.php?process=error");
  exit();
}



}
} else{
  header("Location: ../redplanet/m.php?file=size_error");
  exit();
}
