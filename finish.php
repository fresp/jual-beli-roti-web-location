 <?php
 session_start();
 error_reporting(0);
 $inv = $_GET['inv'];
 $mthd = $_GET['mthd'];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Selesai-Warung Modern</title>
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <script src="assets/js/jquery-1.9.1.min.js"></script>
   <script type="text/javascript" src="assets\js\jquery-migrate.js"></script>
   <script src="assets/dist/jquery.addressPickerByGiro.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9q4LR-dTaJ8avQQ82lg8Fgjqqjt6oyhU&sensor=false&language=id"></script>
   <script async='async' src="assets/js/jquery.leanModal.min.js"></script> 

   <style type="text/css">
     /*Hide the radio buttons*/
     [type='radio']{
      display: none;
    }
    /*Draw a plain border around the image so that
    it does not move when selected */
    label img{
      border: 3px solid white;
      cursor: pointer;
    }
    /*Draw a colored border around the image when the radio button 
    adjacent to the label it is in is checked. */
    [type='radio']:checked + label img{
      border: 3px solid #C63;
    }
  </style>

  <link href="assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

</head>
<body style="background-color: #F5F5F5;">

  <div id="navbar-main" style="display: inline-table;" class="navbar-container" >
    <div class="container" style="padding-right: 0px;padding-left: 0px;height: 45px;">
      <div class="navbar">
        <div class="row" style="height: 30px;">
          <div class="column-12" style="text-align: center;">

            <a href="index.php">
              <img class="logo" src="assets/img/logo.png">
            </a>
          </div>

        </div>
        <form action="result.php" class="navbar-search" style="margin-top: 10px;display: none;" method="POST" id="frm-cari">
          <div class="search-wrapper" id="carii" style="margin-top: -30px;margin-left: 4px;">
            <i class="cari" >
              <i class="material-icons" style="color: #2B838D;">search</i>
            </i>
            <input  name="q" class="header-search" required="required" value="<?php if(!$cari){ echo ""; }else{ echo $cari; }?>"  placeholder="Cari Produk" type="text">
            <button class="tombol" type="submit">

             Cari
           </button>
         </div>
       </form>
     </div>
   </div>
 </div>

   <?php 
    require_once 'module/payment.php';
    $payment = new payment();
    $paymentFinish = $payment->finish($inv); 
    echo $paymentFinish;
    ?>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
  <div class="feed" id="feed" style="text-align: center">
    <a href="#" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">KEMBALI BELANJA</a>
  </div>
</div>


<script src="assets/js/kb-helper.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/jquery.lazyload.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>