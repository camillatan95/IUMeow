<?php
  session_start();
?>

<!--Problem: Need to fix the access to homepage other sections like about us/find a sitter; when click nav bar on
get start&faqs page it does not respond-->

<!DOCTYPE HTML>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>IUMeow</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/animate.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/aos.css">
      <link rel="stylesheet" href="css/bootstrap-datepicker.css">
      <link rel="stylesheet" href="css/jquery.timepicker.css">
      <link rel="stylesheet" href="css/fancybox.min.css">
      <link rel="stylesheet" href="css/_custom.css">
      <link rel="stylesheet" href="bootstrap.bundle.min.js/bootstrap.bundle.js">
      <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
      <!-- Theme Style -->
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body data-spy="scroll" data-target="#templateux-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="templateux-navbar" style="background-color: rgba(0, 0, 0, 0.5);">
      <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-danger">IU</span>Meow</a>
        <div class="site-menu-toggle js-site-menu-toggle  ml-auto"  data-aos="fade" data-toggle="collapse" data-target="#templateux-navbar-nav" aria-controls="templateux-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <?php
            if(isset($_SESSION['u_id'])){
            include_once 'iu_dbc.inc.php';
            $cs_user_id = $_SESSION['u_id'];
            $sql = "SELECT *
                    FROM reservations
                    WHERE cat_sitter_id = '$cs_user_id';";
            $result = pg_query($sql);
            $reservations = pg_num_rows($result);
            $sql = "SELECT * FROM pending_agreements WHERE cs_id = '$cs_user_id' AND co_owner_invoice_status IS NULL;";
            $result = pg_query($sql);
            $pending_reservations = pg_num_rows($result);
            $sql = "SELECT * FROM pending_agreements WHERE cs_id = '$cs_user_id' AND co_owner_invoice_status IS NOT NULL;";
            $result = pg_query($sql);
            $confirmed_reservations = pg_num_rows($result);
            $sql = "SELECT *
                    FROM pending_agreements AS pg
                    WHERE pg.cs_id = '$cs_user_id' AND pg.co_owner_invoice_status IS NOT NULL;";
                    //pg.co_owner_invoice_status IS NOT NULL
            $result = pg_query($sql)or die('Query Failed: ' .pg_last_error());
            $diff = pg_num_rows($result);
            $open_reservations = $reservations - $diff;
          }
            //Logged In Navigation Bar
            if(isset($_SESSION['u_id']) && $reservations > 0 || $pending_reservations > 0 || $confirmed_reservations > 0 ) {
                echo "
                <div class='collapse navbar-collapse' id='templateux-navbar-nav'>
                  <ul class='navbar-nav ml-auto'>
                    <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-about'>About Us</a></li>
                    <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-team'>Find a Sitter</a></li>
                    <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-rooms'>FAQ</a></li>
                    <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-contact'>Contact</a></li>
                    <div class='btn-group'>
  <button type='button' class='btn-success pb_rounded-4 px-4 rounded dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    Notifications
  </button>
  <div class='dropdown-menu'>
    <a class='dropdown-item' href='notification.php'><span class='btn-success pb_rounded-4 px-4 rounded'>Open Reservation $reservations</span></a>
    <a class='dropdown-item' href='pending_reservations.php'><span class='btn-warning pb_rounded-4 px-4 rounded'>Pending Reservations $pending_reservations</span></a>
    <a class='dropdown-item' href='confirmed_reservations.php'><span class='btn-info pb_rounded-4 px-4 rounded'>Confirmed Reservations $confirmed_reservations</span></a>
    <div class='dropdown-divider'></div>
    <a class='dropdown-item' href='#'>Separated link</a>
  </div>
</div>


                    <li class='nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0'>
                            <form action='logout.inc.php' method='POST'>
                              <div class='row'>
                                <div class='col-md-6 form-group'>
                                  <button type='submit' name='submit' class='btn btn-danger text-white font-weight-bold'>Logout</button>
                            </form>
                    </li>

                  </ul>
                </div>
              </div>
            </nav>



            ";
          }

          if(isset($_SESSION['u_id'])) {
              echo "<div class='collapse navbar-collapse' id='templateux-navbar-nav'>
                <ul class='navbar-nav ml-auto'>
                  <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-about'>About Us</a></li>
                  <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-team'>Find a Sitter</a></li>
                  <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-rooms'>FAQ</a></li>
                  <li class='nav-item'><a class='nav-link' href='http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-contact'>Contact</a></li>

                  <li class='nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0'><a class='nav-link' href='myprofile.php'><span class='pb_rounded-4 px-4 rounded'>My Profile</span></a></li>
                  <li class=' nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0'><a class='nav-link' href='notification.php'><span class='pb_rounded-4 px-4 rounded'>Reservation</span></a></li>
                  <li class='nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0'>
                          <form action='logout.inc.php' method='POST'>
                            <div class='row'>
                              <div class='col-md-6 form-group'>
                                <button type='submit' name='submit' class='btn btn-danger text-white font-weight-bold'>Logout</button>
                          </form>
                  </li>

                </ul>
              </div>
            </div>
          </nav>";}





            ?>

<!--Logged Out Navigation Bar -->
        <div class="collapse navbar-collapse" id="templateux-navbar-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-about">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-team">Find a Sitter</a></li>
            <!--<li class="nav-item"><a class="nav-link" href="#section-signup">Become a Sitter</a></li>-->
            <li class="nav-item"><a class="nav-link" href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-rooms">FAQ</a></li>
            <!--<li class="nav-item"><a class="nav-link" href="#section-menus">Menus</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-events">Events</a></li>-->
            <li class="nav-item"><a class="nav-link" href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-contact">Contact</a></li>
            <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" id="myBtn"><span class="pb_rounded-4 px-4 rounded">Login</span></a>
              <div id="myModal" class="modal">

                  <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="login.inc.php" method="POST">
                      <label>Email</label>
                      <input type="text" name="email" id="email" class="form-control" >
                      <label>Password</label>
                      <input type="password" name="password" id="password" class="form-control" >
                      <a href="reset.php">Forgot your password?</a>
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <br>
                          <button type="submit" name="submit" class="btn btn-danger text-white font-weight-bold">Submit</button>
                          <div class="submitting"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <a href="signup.php" class="btn btn-danger text-white font-weight-bold">Get Started</a>
                          <div class="submitting"></div>


                      </div>
                    </form>
                  </div>
                </div>


                <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
            </li>
            <li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" href="signup.php"><span class="pb_rounded-4 px-4 rounded">Get Started</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
</body>
</html>
    <!-- END nav -->
