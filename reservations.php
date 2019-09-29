<?php

if(isset($_POST['submit'])) {
  include_once 'iu_dbc.inc.php';
  include_once 'header.php';
  $cs_user_id = $_POST['cs_user_id'];
  $cs_start_date = $_POST['cs_start_date'];
  $cs_end_date = $_POST['cs_end_date'];

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>signup form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="reserve.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body style = "background-color: #f4d7d7">
<br><br><br>
<div class="container">
<form id="reserve" action="reservation.inc.php" onsubmit="return ValidateForm();" method="POST" class="bg-white p-md-5 p-4 mb-5 border" autocomplete="on">

  <div class="form-group">
  <label for="name" style="font-size:22px; float:inherit; color:grey;">Reservation Form</label>
  </div>
  <div class="form-group">
    <label for="name">Full Name</label><span class="text-danger">*</span></label>
    <input type="text" name="full_name" id="full_name" class="form-control " placeholder="Full Name"><span class="error_msg text-danger"></span>
  </div>
      <br>
      <div class="form-group">
    <label for="name">Phone</label><span class="text-danger">*</span></label>
    <input type="text" name="phone" id="phone" class="form-control " placeholder="Phone"><span class="error_msg text-danger"></span>
  </div>
      <br>
      <div class="form-group">
    <label for="name">Email</label><span class="text-danger">*</span></label>
    <input type="text" name="email" id="email" class="form-control " placeholder="Email"><span class="error_msg text-danger"></span>
  </div>
      <br>
      <div class="form-group">
    <label for="name">Address</label><span class="text-danger">*</span></label>
    <input type="text" name="address" id="address" class="form-control " placeholder="Address"><span class="error_msg text-danger"></span>
  </div>
      <br>
      <div class="form-group">
      <label for="name">Reason for Cat-Sitting</label><span class="text-danger">*</span></label><span class="error_msg text-danger"></span>
        <textarea id ="reason" name = "reason" class = "form-control" placeholder="Introduce yourself in 500 characters or less" maxlength="500" rows="5"></textarea>
  </div>
     <br>
<div class="form-group">
        <label for="name">Specific Needs for your Cat(s) (Optional)</label>
          <textarea id ="needs" name = "needs" class = "form-control"  placeholder="Briefly Describe Your Cat's Specific Needs" maxlength="1000" rows="5"></textarea>
  </div>
<br>
<small id="checkdates" class="form-text text-muted">Please select your start and end dates</small>
<div class="form-row">
  <div class="col">
            <label for="name">Start Date</label>
          <input type="date" name="co_start_date" id="co_start_date"  class="form-control" value = "<?php echo $cs_start_date; ?>">
</div>
<div class="col">
          <label for="name">End Date</label>
        <input type="date" name="co_end_date" id="start_date"  class="form-control" value = "<?php echo $cs_end_date; ?>">
</div>
  </div>
          <input type="hidden" name="cs_user_id" id="cs_user_id" class="form-control " placeholder="e.g: 10, 12.." value = "<?php echo $cs_user_id ?>">
<br>
<div class="row">
  <div class="col-md-6 form-group">
    <input type="checkbox" id="cb" name="term_approval" value="1"> <a href="termsofagreement.php" target="_blank">I have read and agree to the terms and conditions</a><br>
    <div class="submitting"></div>
  </div>
</div>
<br>

        <button type="submit" name="submit" class="btn btn-primary text-white font-weight-bold">Make Reservation</button>
        <div class="submitting"></div>

        <script>
                  function ValidateForm()
                  {
                      $('span.error_msg').html('');
                      var success = true;
                      $("#reserve input").each(function()
                          {
                              if($(this).val()=="")
                              {
                                  $(this).next().html("* This field is required");
                                  success = false;
                              }
                          });
                      return success;
                  }
        </script>

        <script>
        if ($(#reason).get(0).textContent.length == 0){
          $(#reason).next().html("* This field is required");
        }
        </script>


  </form>
</body>
</html>
