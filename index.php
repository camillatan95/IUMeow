<?php
include_once 'header.php';
include_once 'iu_dbc.inc.php';
include_once 'contact.php';
?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
</head>

<body>

<link rel='stylesheet' type='text/css' href='cards.css'>
      <section class="site-hero overlay" style="background-image: url('images/cat.jpg');" data-stellar-background-ratio="0.5" id="section-home">
        <div class="container">
          <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
              <h1 class="heading">Trust us with your furry friend</h1>
            </div>
          </div>
        </div>

        <a class="mouse smoothscroll" href="#next" >
          <div class="mouse-icon">
            <span class="mouse-wheel"></span>
          </div>
        </a>
      </section>
      <!-- END section -->
      <section class="section bg-light pb-0"  >
        <div class="container">

          <div class="row check-availabilty" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

              <form class="signup-form" action="cat_sitter_query.inc.php" method="POST">
                <div class="row">
                  <div class="col-md-1 mb-3 mb-lg-0 col-lg-3" >
                    <label for="checkin_date" class="font-weight-bold text-black">Start Date</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="icon-calendar"></span></div>
                      <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-1 mb-3 mb-lg-0 col-lg-3">
                    <label for="checkout_date" class="font-weight-bold text-black">End Date</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="icon-calendar"></span></div>
                      <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-3 mb-3 mb-md-0 col-lg-6">
                    <div class="row">
                      <div class="col-md-6 mb-3 mb-md-0">
                        <label for="adults" class="font-weight-bold text-black">City</label>
                        <div class="field-icon-wrap">
                          <select name="city" id="city" class="form-control">
                            <option value="Indianapolis">Indianapolis</option>
                            <option value="Bloomington">Bloomington</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-5 mb-3 mb-md-0">
                        <label for="children" class="font-weight-bold text-black">Number of Cats</label>
                        <div class="field-icon-wrap">
                          <select name="num_cats" id="children" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4+</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 mb-3 mb-md-0 col-lg-9">
                    <div class="row">
                      <div class="col-md-6 mb-3 mb-md-0">
                        <label for="adults" class="font-weight-bold text-black"></label>
                      </div>

                      <div class="col-md-4 mb-3 mb-md-0">
                        <label for="children" class="font-weight-bold text-black"></label>
                        <div class="field-icon-wrap">
                          <button type="submit" name="submit" class="btn btn-danger btn-block text-white">Check Availabilty</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-lg-3 float-left" >

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5 bg-light" id="section-about">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
              <img src="https://images.pexels.com/photos/617278/pexels-photo-617278.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Image" class="img-fluid rounded">
            </div>
            <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
              <h2 class="heading mb-4">Meow-llow!</h2>
              <p class="mb-5" style="text-align: justify">We are a local pet-sitting e-business customized to meet the needs of cat owners in the Bloomington and Indianapolis areas. Originally conceived by Indiana University graduate students, IUMeow is a service intended to help the ever-evolving populations of these university towns find affordable, local, and caring cat-sitters. All citizens of these cities can access our services, and rest assured that IUMeow will put you in touch with a qualified cat-sitter just minutes away!</p>
              <p><a href="#section-team" class="btn btn-danger">Book Now</a></p>
            </div>

          </div>
        </div>
      </section>

      <div class="container section" id="section-team">

      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-12 mb-5">
          <h2 class="heading" data-aos="fade-up">Our Cat Sitters</h2>
        </div>
      </div>

<div class='container'>
<div class='row'>
<?php
include_once 'iu_dbc.inc.php';
$sql= "SELECT * FROM cat_sitters AS cs, cat_sitters_profiles AS cp
       WHERE cs.user_id = cp.user_id
       ORDER BY cp.user_id DESC LIMIT 6;";
$result = pg_query($sql) or die('Query Failed: ' .pg_last_error());
header("Location: ../redplanet/index.php?result=empty");

$row_counter=0;

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
          <textarea style='background-color:#edeeef;' id ='bio' name = 'bio' class = 'form-control' maxlength='500' rows='2' readonly>$bio</textarea>
          <input type='hidden' class='form-control' id='cs_user_id' name='cs_user_id' value = '$cs_user_id' readonly>
        <button type='submit' name='submit' id='myModal' class='btn btn-danger text-white' style='float:right'>Reserve</button>


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
</div>
</div>









<!--
      <div class="row">
        <div class='col-lg-6'>
        <br>
          <div class='flip-box'style='height:400px'>
            <div class='flip-box-inner' >

              <div class='flip-box-front' style="background-color:#eacecc;">
              <br>
                <img src='images/profile_photos/6.jpeg' alt='Card image' class='img-thumbnail rounded mx-auto d-block rounded-circle' style='height:50%'>
                <br>
                <div class='form-group'>
                  <label for='usr' style="font-size:20px">Name: Mary Stone</label>
                </div>
                <div class='form-group'>
                  <label for='usr'>City: Indianapolis</label>
                </div>



            </div>


          <div class='flip-box-back' style="background-color:#eacecc;">
            <br>
            <div class='form-group'>
              <label for='usr'>Cat Sitting Capacity: 3</label>
            </div>
            <div class='form-group'>
              <label for='usr'>Hourly Rate: $12 per hour</label>
            </div>
              <div class='form-group'>
                  <label for='usr'>Start of Availabilty: 04/01/2019</label>
              </div>
              <div class='form-group'>
                  <label for='usr'>End of Availability: 06/01/2019</label>
              </div>
              <div class='form-group'>
                <label for='usr'>Bio: I had 3 cats growing up with me when I was a kid,
                  and now I'm also living with my cat Bean in my studio here in Indianapolis.
                  I work as a system analyst at day, but in my spare time, I'd like to cook or read books with Bean.</label>
              </div>
              <br>
              <div class='form-group'>
              </div>
      </div>


</div>
</div>

</div>


<div class='col-lg-6'>
<br>
  <div class='flip-box'style='height:400px'>
    <div class='flip-box-inner'>

      <div class='flip-box-front' style="background-color:#dbd9d9;">
      <br>
        <img src='images/profile_photos/9.jpeg' alt='Card image' class='img-thumbnail rounded mx-auto d-block rounded-circle' style='height:50%'>
        <br>
        <div class='form-group'>
          <label for='usr' style="font-size:20px">Name: Emma Smith</label>
        </div>
        <div class='form-group'>
          <label for='usr'>City: Bloomington</label>
        </div>

    </div>


  <div class='flip-box-back' style="background-color:#dbd9d9;">
    <br><br><br>
    <div class='form-group'>
      <label for='usr'>Cat Sitting Capacity: 3</label>
    </div>
    <div class='form-group'>
      <label for='usr'>Hourly Rate: $12 per hour</label>
    </div>
      <div class='form-group'>
          <label for='usr'>Start of Availabilty: 04/01/2019</label>
      </div>
      <div class='form-group'>
          <label for='usr'>End of Availability: 06/01/2019</label>
      </div>
      <div class='form-group'>
        <label for='usr'>Bio: I am an IU graduate student living in Blommington, studying biology while also raising my cat Rio.</label>
      </div>
      <br>
      <div class='form-group'>
      </div>
</div>


</div>
</div>

</div>



</div>




<div class="row">
  <div class='col-lg-6'>
  <br>
    <div class='flip-box'style='height:400px'>
      <div class='flip-box-inner' >

        <div class='flip-box-front' style="background-color:#dbd9d9;">
        <br>
          <img src='images/profile_photos/11.jpg' alt='Card image' class='img-thumbnail rounded mx-auto d-block rounded-circle' style='height:50%'>
          <br>
          <div class='form-group'>
            <label for='usr' style="font-size:20px">Name: Pam Doe</label>
          </div>
          <div class='form-group'>
            <label for='usr'>City: Bloomington</label>
          </div>

      </div>


    <div class='flip-box-back' style="background-color:#dbd9d9;">
      <br><br><br>
      <div class='form-group'>
        <label for='usr'>Cat Sitting Capacity: 3</label>
      </div>
      <div class='form-group'>
        <label for='usr'>Hourly Rate: $15 per hour</label>
      </div>
        <div class='form-group'>
            <label for='usr'>Start of Availabilty: 04/01/2019</label>
        </div>
        <div class='form-group'>
            <label for='usr'>End of Availability: 06/01/2019</label>
        </div>
        <div class='form-group'>
          <label for='usr'>Bio:</label>
        </div>
        <br>
        <div class='form-group'>
        </div>
</div>


</div>
</div>

</div>


<div class='col-lg-6'>
<br>
<div class='flip-box'style='height:400px'>
<div class='flip-box-inner'>

<div class='flip-box-front' style="background-color:#eacecc;">
<br>
  <img src='images/profile_photos/12.jpg' alt='Card image' class='img-thumbnail rounded mx-auto d-block rounded-circle' style='height:50%'>
  <br>
  <div class='form-group'>
    <label for='usr' style="font-size:20px">Name: Emily Johnson</label>
  </div>
  <div class='form-group'>
    <label for='usr'>City: Bloomington</label>
  </div>

</div>


<div class='flip-box-back' style="background-color:#eacecc;">
<br><br><br>
<div class='form-group'>
  <label for='usr'>Cat Sitting Capacity: 2</label>
</div>
<div class='form-group'>
<label for='usr'>Hourly Rate: $10 per hour</label>
</div>
<div class='form-group'>
    <label for='usr'>Start of Availabilty: 04/01/2019</label>
</div>
<div class='form-group'>
    <label for='usr'>End of Availability: 05/01/2019</label>
</div>
<div class='form-group'>
  <label for='usr'>Bio:</label>
</div>
<br>
<div class='form-group'>
</div>
</div>


</div>
</div>

</div>


-->
</div>

</section>

<br>

      <section class="section" id="section-rooms">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading"
               data-aos="fade-up">FAQs</h2>
              <p data-aos="fade-up" data-aos-delay="100" style="font-weight:bold" >Q: How do I select and schedule a cat sitter for a specific time? </p>
                <p data-aos="fade-up" data-aos-delay="100">Select the dates and city in which you will need your cat-sitter for.
                This will filter cat-sitter profiles that match your desired needs.
                Browse through each available profile by clicking on a sitter’s profile
                card. When you find the sitter you like the best, fill out and submit
                the simple scheduling and payment form found on their user profile page.</p><br>
                <p data-aos="fade-up" data-aos-delay="100" style="font-weight:bold">Q: Do I need to create a user profile if I am only a cat-owner and don’t want to cat-sit?</p>
                <p data-aos="fade-up" data-aos-delay="100">No, you do not. You are only required to create a user profile if you are offering cat-sitting services.</p>
                <a href="faq.php"> More Details >> </a>
            </div>
          </div>

<br><br><br><br><br><br>
<small class="form-text text-muted">Sponsored by</small>
          <div class="row">

            <div class="col-md-6 col-lg-4" data-aos="fade-up">

                <figure class="img-wrap">
                  <img src="https://img.chewy.com/is/image/catalog/109206_MAIN._SY630_V1550248026_.jpg" style="width:80%" alt="Free website template" class="img-fluid mb-3">
                </figure>
                <div class="p-3 text-center room-info">
                  <h2>Hill's Science Diet</h2>
                  <a href="https://www.amazon.com/s?k=hills+science+diet+cat+food&crid=3AIGYC6Z8RLCW&sprefix=hills+%2Caps%2C165&ref=nb_sb_ss_i_3_6" target="_blank"  > <span class=" letter-spacing-1">Buy me on Amazon</span></a>
                </div>
              </a>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <figure class="img-wrap">
                  <img src="https://images-na.ssl-images-amazon.com/images/I/71YURG2o%2BdL._SL1300_.jpg" style="width:80%" alt="Free website template" class="img-fluid mb-3">
                </figure>
                <div class="p-3 text-center room-info">
                  <h2>Meow Mix</h2>
                  <a href="https://www.amazon.com/s?k=meow+mix&crid=2YP1YTFOEVZ98&sprefix=meow+m%2Caps%2C167&ref=nb_sb_ss_i_1_6" target="_blank" ><span class=" letter-spacing-1">Buy me on Amazon</span></a>
                </div>
              </a>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <figure class="img-wrap">
                  <img src="https://www.royalcanin.com/us/-/media/royal-canin/united-states/images/products/cats/appetite-control-spayed-neutered-7-years-dry-adult-cat-food/pwu457c4szprxovbl6ap.jpg" alt="Free website template" class="img-fluid mb-3">
                </figure>
                <div class="p-3 text-center room-info">
                  <h2>Royal Canin</h2>
                  <a href="https://www.amazon.com/s?k=royal+canin+cat+food&crid=1KMB9JQO7A6KM&sprefix=royal+ca%2Caps%2C166&ref=nb_sb_ss_i_3_8" target="_blank" ><span class="letter-spacing-1">Buy me on Amazon</span></a>
                </div>
              </a>
            </div>



          </div>

      </section>
</div>
<!--
      <section class="section slider-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Photos</h2>
              <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="slider-item">
                  <a href="images/slider-1.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-1.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-2.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-2.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-3.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-3.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-4.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-4.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-5.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-5.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-6.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-6.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
                <div class="slider-item">
                  <a href="images/slider-7.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="images/slider-7.jpg" alt="Image placeholder" class="img-fluid"></a>
                </div>
              </div>
              -->
              <!-- END slider -->

      <!-- END section -->


      <!--<section class="section bg-image overlay" style="background-image: url('images/hero_3.jpg');" id="section-menus">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading text-white" data-aos="fade">Our Restaurant Menu</h2>
              <p class="text-white" data-aos="fade" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
          <div class="food-menu-tabs" data-aos="fade">
            <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active letter-spacing-2" id="mains-tab" data-toggle="tab" href="#mains" role="tab" aria-controls="mains" aria-selected="true">Food</a>
              </li>
              <li class="nav-item">
                <a class="nav-link letter-spacing-2" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Desserts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link letter-spacing-2" id="drinks-tab" data-toggle="tab" href="#drinks" role="tab" aria-controls="drinks" aria-selected="false">Drinks</a>
              </li>
            </ul>
            <div class="tab-content py-5" id="myTabContent">


              <div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$20.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Murgh Tikka Masala</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$35.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Fish Moilee</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$15.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Safed Gosht</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$10.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">French Toast Combo</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$8.35</span>
                      <h3 class="text-white"><a href="#" class="text-white">Vegie Omelet</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$22.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Chorizo &amp; Egg Omelet</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                </div>-->


               <!-- .tab-pane -->
<!--
              <div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$11.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Banana Split</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$72.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Sticky Toffee Pudding</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$26.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Pecan</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$42.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Apple Strudel</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$7.35</span>
                      <h3 class="text-white"><a href="#" class="text-white">Pancakes</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$22.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Ice Cream Sundae</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                </div>
              </div>
<!--
              <div class="tab-pane fade text-left" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$32.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Spring Water</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$14.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Coke, Diet Coke, Coke Zero</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$93.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Orange Fanta</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$18.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Lemonade, Lemon Squash</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$38.35</span>
                      <h3 class="text-white"><a href="#" class="text-white">Sparkling Mineral Water</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                    <div class="food-menu mb-5">
                      <span class="d-block text-primary h4 mb-3">$69.00</span>
                      <h3 class="text-white"><a href="#" class="text-white">Lemon, Lime &amp; Bitters</a></h3>
                      <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                </div>
              </div> <!-- .tab-pane -->
            </div>
          </div>
        </div>
      </section>



      <!-- END section -->

    <!--
      <section class="section testimonial-section">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">People Says</h2>
            </div>
          </div>
          <div class="row">
            <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">

              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>

                  <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; Jean Smith</em></p>
              </div>

              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>
                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; John Doe</em></p>
              </div>

              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>

                  <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; John Doe</em></p>
              </div>


              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>

                  <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; Jean Smith</em></p>
              </div>

              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>
                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; John Doe</em></p>
              </div>

              <div class="testimonial text-center slider-item">
                <div class="author-image mb-3">
                  <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                </div>
                <blockquote>

                  <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                </blockquote>
                <p><em>&mdash; John Doe</em></p>
              </div>

            </div>
              <!-- END slider -->
          </div>

        </div>
      </section>


      <!-- <section class="section blog-post-entry bg-light" id="section-events">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Events</h2>
              <p data-aos="fade-up">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">

              <div class="media media-custom d-block mb-4 h-100">
                <a href="#" class="mb-4 d-block"><img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <span class="meta-post">February 26, 2018</span>
                  <h2 class="mt-0 mb-3"><a href="#">Travel Hacks to Make Your Flight More Comfortable</a></h2>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="200">
              <div class="media media-custom d-block mb-4 h-100">
                <a href="#" class="mb-4 d-block"><img src="images/img_2.jpg" alt="Image placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <span class="meta-post">February 26, 2018</span>
                  <h2 class="mt-0 mb-3"><a href="#">5 Job Types That Aallow You To Earn As You Travel The World</a></h2>
                  <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="300">
              <div class="media media-custom d-block mb-4 h-100">
                <a href="#" class="mb-4 d-block"><img src="images/img_3.jpg" alt="Image placeholder" class="img-fluid"></a>
                <div class="media-body">
                  <span class="meta-post">February 26, 2018</span>
                  <h2 class="mt-0 mb-3"><a href="#">30 Great Ideas On Gifts For Travelers</a></h2>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. t is a paradisematic country, in which roasted parts of sentences.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->

      <section class="section contact-section" id="section-contact">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Contact Us</h2>
              <p data-aos="fade-up">Questions? Concerns? Send us a message!</p>
            </div>
          </div>
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">



            <form method="post" class="bg-white p-md-5 p-4 mb-5 border" action="index.php">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control ">
                </div>
                <div class="col-md-6 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control ">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control ">
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label for="message">Write Message</label>
                  <textarea name="message" name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Send Message" name="submit"class="btn btn-primary text-white font-weight-bold">
                  <div class="submitting"></div>
                </div>
              </div>


            </form>



          </div>
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
              <div class="col-md-10 ml-auto contact-info">
                <p><span class="d-block">Address:</span> <span class="text-black" style="font-size:24px" > Indiana University, Luddy Hall, 700 North Woodlawn Avenue, Bloomington IN, 47408</span></p>
                <p><span class="d-block">Phone:</span> <span class="text-black" style="font-size:24px"> (+1) 812 275 2080</span></p>
                <p><span class="d-block">Email:</span> <span class="text-black" style="font-size:24px"> info@iumeow.com</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      <section class="section bg-image overlay" style="background-image: url('https://images.pexels.com/photos/923360/pexels-photo-923360.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">A Best Way of CatCare. Reserve Now!</h2>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
              <!-- Extra large modal -->
              <a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-team" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
            </div>
          </div>
        </div>
      </section>

      <footer class="section footer-section" style="background-image: url('');">
        <div class="container">
          <div class="row mb-4">
            <div class="col-md-4 mb-5">
              <ul class="list-unstyled link">
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php">Home</a></li>
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-about">About Us</a></li>
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-team">Find a Sitter</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-5">
              <ul class="list-unstyled link">
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-rooms">FAQs</a></li>
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/termsofagreement.php">Terms of Agreement</a></li>
                <li style="font-size:19px"><a href="http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/index.php#section-contact">Contact</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-5 pr-md-5 contact-info">
              <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
              <p style="font-size:18px"><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> Indiana University, Luddy Hall <br> 700 North Woodlawn Avenue <br> Bloomington IN, 47408</span></p>
              <p style="font-size:18px"><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 812 275 2080</span></p>
              <p style="font-size:18px"><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@iumeow.com</span></p>

            </div>


            <!--
            <div class="col-md-3 mb-5">
              <p>Sign up for our newsletter</p>
              <form action="#" class="footer-newsletter">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email...">
                  <button type="submit" class="btn"><span class="fa fa-paper-plane"></span></button>
                </div>
              </form>
            </div>
          -->
          </div>
          <div class="row pt-5">
            <p class="col-md-8 text-left">
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart text-primary" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>


          </div>
        </div>
      </footer>


      <!-- Modal -->
      <div class="modal fade " id="reservation-form" tabindex="-1" role="dialog" aria-labelledby="reservationFormTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">

                  <form action="index.html"  method="post" class="bg-white p-4">
                    <div class="row mb-4"><div class="col-12"><h2>Reservation</h2></div></div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="name">Name</label>
                        <input type="text" id="name" class="form-control ">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control ">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label class="text-black font-weight-bold" for="email">Email</label>
                        <input type="email" id="email" class="form-control ">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                        <input type="text" id="checkin_date" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                        <input type="text" id="checkout_date" class="form-control">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="adults" class="font-weight-bold text-black">Adults</label>
                        <div class="field-icon-wrap">
                          <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                          <select name="" id="adults" class="form-control">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4+</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="children" class="font-weight-bold text-black">Children</label>
                        <div class="field-icon-wrap">
                          <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                          <select name="" id="children" class="form-control">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4+</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-md-12 form-group">
                        <label class="text-black font-weight-bold" for="message">Notes</label>
                        <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <input type="submit" value="Reserve Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                      </div>
                    </div>
                  </form>

                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

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
    </body>
  </html>
