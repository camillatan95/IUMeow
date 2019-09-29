<?php
include_once 'header.php';
include_once 'iu_dbc.inc.php';
$user_id = $_SESSION['u_id'];
$sql = "SELECT * FROM cat_sitters_profiles WHERE user_id ='$user_id';";
$result = pg_query($dbconn, $sql);
$resultcheck = pg_num_rows($result);
$row= pg_fetch_array($result, NULL, PGSQL_ASSOC);
$cs_city = $row["city"];
$cs_hr_rate = $row["hr_rate"];
$cs_num_cats = $row["num_cats"];
$cs_start_date = $row["start_date"];
$cs_end_date = $row["end_date"];
$cs_profile_image = $row["profile_img"];
$cs_bio = $row["bio"];



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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel='stylesheet' type='text/css' href='cards.css'>
  <body style = "background-image: url(https://cdn.shopify.com/s/files/1/3026/6974/files/grey-cat-paw-close-up.jpg?v=1534094480); background-size: cover;">
<br>
<?php
  if(isset($cs_profile_image)) {
    echo "<img src='$cs_profile_image' id = 'profilePicture' alt='user profile' width='300' height='200' class='img-thumbnail rounded mx-auto d-block rounded-circle' value='You will be the next one' onerror='changeProfileImg()'><br>
    <script type='text/javascript'>
      function changeProfileImg() {
        var image = document.getElementById('profilePicture');
        image.src = 'https://cancer.psu.edu/researchers/individual?p_p_id=researcherdisplay_WAR_medportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=serveResearcherImage&p_p_cacheability=cacheLevelPage&p_p_col_id=column-2&p_p_col_count=1&_researcherdisplay_WAR_medportlet_researcherUrlTitle=dennis-keith-pearl-phd&_researcherdisplay_WAR_medportlet_researcherDatasourceId=5B6500F63D0438DBE0540010E056499A'
      }
    </script>";
  } else {
    echo "<img src='images/profile_photos/generic_photo.jpeg' id = 'profilePicture' alt='user profile' width='300' height='200' class='img-thumbnail rounded mx-auto d-block rounded-circle' value='You will be the next one' onerror='changeProfileImg()'><br>
    <script type='text/javascript'>
      function changeProfileImg() {
        var image = document.getElementById('profilePicture');
        image.src = 'https://cancer.psu.edu/researchers/individual?p_p_id=researcherdisplay_WAR_medportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=serveResearcherImage&p_p_cacheability=cacheLevelPage&p_p_col_id=column-2&p_p_col_count=1&_researcherdisplay_WAR_medportlet_researcherUrlTitle=dennis-keith-pearl-phd&_researcherdisplay_WAR_medportlet_researcherDatasourceId=5B6500F63D0438DBE0540010E056499A'
      }
    </script>";
  }

/*
<img src="<?php echo $cs_profile_image; ?>" id = "profilePicture" alt="user profile" width="300" height="200" class="img-thumbnail rounded mx-auto d-block rounded-circle" value="You will be the next one" onerror="changeProfileImg()"><br>
<script type="text/javascript">
  function changeProfileImg() {
    var image = document.getElementById('profilePicture');
    image.src = "https://cancer.psu.edu/researchers/individual?p_p_id=researcherdisplay_WAR_medportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=serveResearcherImage&p_p_cacheability=cacheLevelPage&p_p_col_id=column-2&p_p_col_count=1&_researcherdisplay_WAR_medportlet_researcherUrlTitle=dennis-keith-pearl-phd&_researcherdisplay_WAR_medportlet_researcherDatasourceId=5B6500F63D0438DBE0540010E056499A"
  }
</script>
*/
?>


<!--<section class="site-hero overlay" style="background-image: url('') ;" data-stellar-background-ratio="0.5" id="section-home">

</section>-->
<div class="container">
<form action="myprofile.inc.php" onSubmit="alert('Your profile have been updated! Now you could check your profile by searching in Homepage.');" method="POST" enctype="multipart/form-data" class="bg-white p-md-5 p-4 mb-5 border" autocomplete="on">

    <label for="name">City</label>
    <select name="city" id="city" class="form-control">
    <option value="<?php echo $cs_city; ?>"><?php echo $cs_city; ?></option>
    <option value="Bloomington">Bloomington</option>
    <option value="Indianapolis">Indianapolis</option>
    </select>

        <br>
    <label for="name">Daily Rate</label>
    <input type="number" name="hr_rate" id="hr_rate" class="form-control " placeholder="e.g: 10, 12.." value="<?php echo $cs_hr_rate; ?>">
      <br>
    <label for="name">Number of Cats</label>
    <input type="number" name="num_cats" id="num_cats" class="form-control " placeholder="e.g: 1, 2.." value = "<?php echo $cs_num_cats; ?>">
    <input type="hidden" value="<?php echo $_SESSION['u_id']; ?>">
    <br>
    <label for="name">Availabilty Range</label>
    <br>
    <input type="date" id="start" name="start" placeholder="Start of Availabilty" value="<?php echo $cs_start_date; ?>">
    <input type="date" id="end" name="end" placeholder="end of Availabilty" value="<?php echo $cs_end_date; ?>">
    <small id="emailHelp" class="form-text text-muted">Please choose your latest availability</small>

    <br>
      <label for="name">Introduction</label>
        <textarea id ="bio" name = "bio" class = "form-control" placeholder="Introduce yourself in 500 characters or less" maxlength="500" rows="5"><?php echo $cs_bio; ?></textarea>
        <span id="wordCount">0</span> Characters

        <br>

        <script type="text/javascript">
        var myText = document.getElementById('bio');
        var wordCount = document.getElementById('wordCount');
        myText.addEventListener("keyup",function(){
          var character = myText.value.split('');
          wordCount.innerText = character.length;
        });

        </script>
<br>
        <label for="Profile-pic">Upload Your Profile Photo</label>
        <small class="form-text text-muted">Allowed: jpg, jpeg, png, pdf </small>
        <br>
        <input type="file" name="profile_pic">
        <br>


        <br>
        <button type="submit" name="submit" class="btn btn-primary text-white font-weight-bold">Update</button>
        <div class="submitting"></div>
        <small id="emailHelp" class="form-text text-muted"> Go to homepage to search and view your profile Meow~ </small>


  </form>
</div>

</body>
</html>
