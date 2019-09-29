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
<br><br><br><br><br><br><br><br>
<body>

<?php
include_once 'header.php';

if(isset($_POST['submit_invoice'])){
  $invoice = $_POST['invoice'];
  $rev_id = $_POST['rev_id'];
  $cs_id = $_POST['cs_id'];
}

?>
<div class="container">
<img src="images/checkout" alt="checkout" style="width:50%">
<br>
<img src="images/arrow.png" alt="arrow" style="width:5%;margin-left:140px;">
<br><br>
</div>
<div class="container-fluid">
<div class="row">
  <img src="https://www.aboutcatsonline.com/images/catpaws.jpg" alt="pointer">
<div id="paypal-button" style="float:right"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
  paypal.Button.render({
    // Configure environment
    env: "sandbox",
    client: {
      sandbox: "AbdJlcp9iZQ5Rlt2oNnCapBOz_4IoDaLgVNaUu4IkPegXAXe5tUPZ3oSHTUuAuCuRP7rOEuP708_Rs3d"
    },
    // Customize button (optional)
    locale: "en_US",
    style: {
      size: "small",
      color: "gold",
      shape: "pill",
    },
    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: "<?php echo $invoice; ?>",
            currency: "USD"
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.location.href = "http://ella.ils.indiana.edu/~emarin/iumeow/redplanet/paypal_confirmation?rev_id=<?php echo $rev_id; ?>.php";
      });
    }
  }, "#paypal-button");

  </script>

</div>
</div>
</body>
</html>
