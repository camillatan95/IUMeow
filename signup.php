<?php
include_once 'header.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>signup form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

<!--<div class="container"id="logo" >
  <nav class="navbar navbar-expand-sm bg-light navbar-light" >
    <ul class="navbar-nav">
      <li class="nav-item active mr-auto">
        <a class="navbar-brand" href="index.php"><span class="text-danger">IU</span>Meow</a>
      </li><br>
      <li class="nav-item">
        <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" href="#section-team">Find a Sitter</a></li>
      </li>
      <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="#section-signup">Become a Sitter</a></li>
      </li>
      <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="#section-rooms">FAQ</a></li>
      </li>
      <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="#section-contact">Contact</a></li>
      </li>
      <li class="nav-item">
        <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" id="myBtn"><span class="pb_rounded-4 px-4 rounded">Login</span></a>
      </li>
      <li class="nav-item">
      <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" href="signup.php" target="_blank"><span class="pb_rounded-4 px-4 rounded">Get Started</span></a></li>
      </li>
    </ul>
  </nav>
</div>-->

<br>
<div class="container" >

        <form id="signup" action="cat_sitter.inc.php" onsubmit="return ValidateForm();" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
          <div class="row">

            <div class="col-md-6 form-group">

              <label for="name">First Name <span class="text-danger">*</span></label>
              <input type="text" name="first_name" id="first_name" class="form-control "><span class="error_msg text-danger"></span>
            </div>
            <div class="col-md-6 form-group">
              <label for="name">Last Name <span class="text-danger">*</span></label>
              <input type="text" name="last_name" id="last_name" class="form-control "><span class="error_msg text-danger"></span>
            </div>
            <div class="col-md-6 form-group">
              <label for="phone">Phone <span class="text-danger">*</span></label>
              <input type="number" name="phone" id="phone" class="form-control "><span class="error_msg text-danger"></span>
            </div>
            <div class="col-md-6 form-group">
              <label for="Password">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" id="password" class="form-control "><span class="error_msg text-danger"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="email">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" id="email" class="form-control "><span class="error_msg text-danger"></span>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-12 form-group">
              <label for="message">Paypal Email <span class="text-danger">*</span></label>
              <input name="paypal" name="message" id="paypal" class="form-control "></input><span class="error_msg text-danger"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="checkbox" id="cb" name="term_approval" onsubmit="checkthebox()" value="1"> <a href="termsofagreement.php" target="_blank">I have read the terms and conditions</a><br>
              <div class="submitting"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <button type="submit"  name="submit" class="btn btn-danger text-white font-weight-bold">Submit</button>
              <div class="submitting"></div>
            </div>
          </div>
<script>
          function ValidateForm()
          {
              $('span.error_msg').html('');
              var success = true;
              $("#signup input").each(function()
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
function checkthebox(){
  if (document.getElementById("cb").checked = false){
    //document.getElementById("cb").write （5+6）;
    //I dont know how to check and print alert text for checkbox!!!

  }

}
</script>


        </form>

    </div>

</section>
</body>
</html>
