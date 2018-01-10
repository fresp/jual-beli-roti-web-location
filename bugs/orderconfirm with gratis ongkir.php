 <?php
 session_start();
 error_reporting(0);
 $selected =$_GET['selected'];
 if(!$selected OR !$_SESSION['iduser']){
  header("Location: index.php?Error");
}

?>
<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Konfirmasi Pembelian</title>
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
  <style type="text/css">
    #content {
      display: block;
      width: 100%;
      background: #fff;
      padding: 25px 20px;
      padding-bottom: 35px;
      -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
      -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
      box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }


    .flatbtn {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      display: inline-block;
      outline: 0;
      border: 0;
      color: #f3faef;
      text-decoration: none;
      background-color: #6bb642;
      border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
      font-size: 1.2em;
      font-weight: bold;
      padding: 12px 22px 12px 22px;
      line-height: normal;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      text-transform: uppercase;
      text-shadow: 0 1px 0 rgba(0,0,0,0.3);
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      -webkit-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
      -moz-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
      box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
    }
    .flatbtn:hover {
      color: #fff;
      background-color: #73c437;
    }
    .flatbtn:active {
      -webkit-box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
      -moz-box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
      box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    /** custom login button **/
    .flatbtn-blu { 
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      display: inline-block;
      outline: 0;
      border: 0;
      color: #edf4f9;
      text-decoration: none;
      background-color: #4f94cf;
      border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
      font-size: 1.3em;
      font-weight: bold;
      padding: 12px 26px 12px 26px;
      line-height: normal;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      text-transform: uppercase;
      text-shadow: 0 1px 0 rgba(0,0,0,0.3);
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    }
    .flatbtn-blu:hover {
      color: #fff;
      background-color: #519dde;
    }
    .flatbtn-blu:active {
      -webkit-box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
      -moz-box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
      box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
    }


    /** modal window styles **/
    #lean_overlay {
      position: fixed;
      z-index:100;
      top: 0px;
      left: 0px;
      height:100%;
      width:100%;
      background: #000;
      display: none;
    }


    #loginmodal {
      width: 300px;
      padding: 15px 20px;
      background: #f3f6fa;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      border-radius: 6px;
      -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
      -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    }

  #loginform { /* no default styles */ }

  #loginform label { display: block; font-size: 1.1em; font-weight: bold; color: #7c8291; margin-bottom: 3px; }


  .txtfield { 
    display: block;
    width: 100%;
    padding: 6px 5px;
    margin-bottom: 15px;
    font-family: 'Helvetica Neue', Helvetica, Verdana, sans-serif;
    color: #7988a3;
    font-size: 1.4em;
    text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
    background-color: #fff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#edf3f9), to(#fff));
    background-image: -webkit-linear-gradient(top, #edf3f9, #fff);
    background-image: -moz-linear-gradient(top, #edf3f9, #fff);
    background-image: -ms-linear-gradient(top, #edf3f9, #fff);
    background-image: -o-linear-gradient(top, #edf3f9, #fff);
    background-image: linear-gradient(top, #edf3f9, #fff);
    border: 1px solid;
    border-color: #abbce8 #c3cae0 #b9c8ef;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
    -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
    -webkit-transition: all 0.25s linear;
    -moz-transition: all 0.25s linear;
    transition: all 0.25s linear;
  }

  .txtfield:focus {
    outline: none;
    color: #525864;
    border-color: #84c0ee;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
    -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
  }
</style>  
<link href="assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

</head>
<body style="background-color: #F5F5F5;">
  <div id="loginmodal" style="display:none;">
    <div class="row-fluid" style="overflow: scroll;height: 200px;">
      <div class="span12">
        <form id="customerform" method="post" class="form-customer">  
          <div class="row-fluid">
            <label class="control-label" for="inputAddress">Lokasi Terdekat</label>
            <div >
              <input type="text" name="penerima" disabled class="txtfield  input-xxlarge" value="<?php echo $_SESSION['nerbie'] ?>" autocomplete="off" placeholder="<?php echo $_SESSION['nerbie'] ?>">
            </div>
            <label class="control-label" for="inputAddress">Nama Penerima</label>
            <div >
              <input type="text" name="penerima" class="txtfield  input-xxlarge" value="Freza Nugraha" autocomplete="off" placeholder="Nama Penerima">
            </div>
            <label class="control-label" for="inputAddress">Alamat Lengkap</label>
            <div >
              <textarea type="text" name="alamat" class="txtfield  input-xxlarge" value="Freza Nugraha" autocomplete="off" placeholder="Jl.Pejaten Barat II
              Rt 011/08 No.23
              Patokan Rumah Freza Nugraha"></textarea>
            </div>
            <label class="control-label" for="inputAddress">Nomer Lain yang dapat dihubungi</label>
            <div >
              <input type="text" name="nomer" class="txtfield  input-xxlarge" value="+629999999999" autocomplete="off" placeholder="+629999999999">
            </div>
          </div>
          <a class="btn tombol-cust hidemodal" style="  background: #232323;padding: 5px 10px;color: #fff; cursor: pointer; ">Tentukan</a>

        </form>
        <script type="text/javascript">
          $(function(){
            $('#loginform').submit(function(e){
              return false;
            });

            $('#modaltrigger').leanModal({ top: 90, overlay: 0.45, closeButton: ".hidemodal" });
          });
        </script>
      </div>
    </div>
    <script>
      $('.inputAddress').addressPickerByGiro({
        distanceWidget: true,
        boundElements: {
          'region': '.region',
          'county': '.county',
          'street': '.street',
          'street_number': '.street_number',
          'latitude': '.latitude',
          'longitude': '.longitude',

        }
      });
    </script>
  </div>
  <script type="text/javascript">
    $(function(){
      $('#loginform').submit(function(e){
        return false;
      });
      
      $('#modaltrigger').leanModal({
        top: 110,
        overlay: 0.45,
        closeButton: ".hidemodal" 
      });
    });
  </script>
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

 <div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">

  <div class="feed" id="feed">
    <span style="font-weight: bold;">Alamat Pengiriman</span>
  </div>
</div>

<div style="background: #fff;padding: 10px;" class="container container-top">
  <div class="alamat" id="alamat" style="text-align: center;">  
    <?php 
    require_once 'module/payment.php';
    $payment = new payment();
    $paymentAlamat = $payment->alamatload(); 
    echo $paymentAlamat;
    ?>
  </div>
  <div class="feed" id="feed" style="text-align: center;margin-top: 7px;">  
   <a class="btn-pesan" href="#loginmodal" id="modaltrigger" style="float: none;"><i class="fa fa-home"></i>  Ganti Alamat</a>
 </div>


</div>
<div style="background: #fff;padding: 10px;margin-top: 7px;" class="container container-top">
  <?php 
  require_once 'module/payment.php';
  $payment = new payment();
  $paymentCart = $payment->listcart($selected); 
  echo $paymentCart;
  ?>
</div>

<div style="background: #fff;padding: 10px;margin-top: 7px;" class="container container-top">
 <!-- VOUCHER Dan Pesan
  <span style="font-weight: bold;"><a href="#">Punya Kode Voucher?</a></span> 
  <br><br>
--> 
<button type="button" id="btntriggerpesan" class="btnnavbar">
  <span style="font-weight: bold;"><a href="#">Tinggalkan Pesan untuk Penjual?</a></span>
</button>
<script type="text/javascript">
  var button = document.getElementById('btntriggerpesan');
  button.onclick = function() {
    var div = document.getElementById('frm-pesan');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
    }
    else {
      div.style.display = 'block';
    }
  };
</script>
<div id="frm-pesan" style="display: none;">
  <div class="search-wrapper" id="carii" style="margin-top: 0px;margin-left: 4px;">
    <textarea type="text" id="pesan" style="max-width: 100%;min-width: 100%;
" placeholder="isi Pesan Mu disini"></textarea>
    <script type="text/javascript">
      $("#pesan").on('keypress change', function(event) {
       var data=$(this).val();
       $("#isipesan").val(data);
     });
   </script>
 </div>
</div>

</div>
<div style="margin-top: 7px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
  <div class="feed" id="feed">
    <span style="font-weight: bold;">Metode Pembayaran</span>  <span id="errorpay" style="font-weight: bold; float: right;color: red" ></span>
  </div>
</div>
<div style="background: #fff;padding: 10px;height: 60px;" id="metode" class="container container-top">
  <input type="radio" name="shape" class="metode" value="cod" id="cod"/>
  <label for="cod">
    <img src="assets/img/bank1.png" alt="cod"/>
  </label>
  <input type="radio" name="shape" class="metode" value="bca" id="bca"/>
  <label for="bca">
    <img src="assets/img/bank2.png" alt="bca"/>
  </label>
  <input type="radio" name="shape" class="metode" value="mandiri" id="mandiri"/>
  <label for="mandiri">
    <img src="assets/img/bank3.png" alt="mandiri"/>
  </label>
  <script type="text/javascript">
    $("input[type='radio']").click(function(){
      var a     = $(this).attr('value');
      $("#payment").val(a);
      $('#add').attr("disabled", false);
      var kosong = '- Rp.',
          freeongkir= 'Free hanya untuk bank';
      var nol = 0;
      if(a != "cod"){
        var sum = 0.0;
        $('.totalongkir').each(function()
        {
          sum += parseFloat($(this).text());
        });
        $(".dfree").html(Number(sum).toLocaleString('id'));
        $(".hfree").html(sum);
        $('.dfree').show();
        $('.dpfree').html(kosong);
      }else{
        $(".dfree").html(nol);
        $(".hfree").html(nol);
        $('.dfree').hide();
        $('.dpfree').html(freeongkir);
      }
    });
  </script>
</div>
<div style="margin-top: 7px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
  <div class="feed" id="feed">
    <span style="font-weight: bold;">Konfirmasi Pembayaran</span>
  </div>
</div>
<div style="background: #fff;padding: 10px;height: 70px;" class="container container-top">
  <div class="column-6" style="float: left;padding-left: 0px">
    <span style="">Subtotal</span><br> 
    <!--<span style="">Kupon</span><br>-->
    <span style="">Biaya Kirim</span><br> 
    <span style="" class="free">Gratis Ongkir</span><br>     
  </div>
  <div class="column-6" style="float: right;text-align:right;padding-right: 0px">
    <span style="font-weight: bold;">Rp.</span><span  class="tampilsub " style="font-weight: bold;"></span><br><span  class="hasilsub konfirmasi" style="font-weight: bold;display: none;"></span>    
    <span style="font-weight: bold;">Rp.</span><span  class="tampilongkir " style="font-weight: bold;"></span><br><span  class="hasilongkir konfirmasi" style="font-weight: bold;display: none;"></span>
    <span style="font-weight: bold;" class="dpfree" ></span><span  class="dfree" style="font-weight: bold;"></span><br><span  class="hfree" style="font-weight: bold;"></span>
    <script type="text/javascript">
      var sum = 0.0;
      $('.totalongkir').each(function()
      {
        sum += parseFloat($(this).text());
      });
      $(".tampilongkir").html(Number(sum).toLocaleString('id'));
      $(".hasilongkir").html(sum);

      var sum = 0.0;
      $('.subtotal').each(function()
      {
        sum += parseFloat($(this).text());
      });
      $(".tampilsub").html(Number(sum).toLocaleString('id'));
      $(".hasilsub").html(sum);
    </script>        
  </div>

</div>
<div style="background: #2B838D;padding: 10px;border-bottom: 3px solid #eee;height: 40px;color: #fff;" class="container container-top">
  <div class="column-6" style="float: left;padding-left: 0px">
    <span style="">Total Pembayaran</span><br> 

  </div>
  <div class="column-6" style="float: right;text-align:right;padding-right: 0px">
    <span style="font-weight: bold;">Rp.</span><span class="totalkonfirmasi" style="font-weight: bold;"></span><span class="hasilkonfirmasi" style="font-weight: bold;display: none"></span><br> 
    <script type="text/javascript">
      var sum = 0.0;
      $('.konfirmasi').each(function()
      {
        sum += parseFloat($(this).text());
      });
      $(".hasilkonfirmasi").html(sum);
      $(".totalkonfirmasi").html(Number(sum).toLocaleString('id'));
    </script>
  </div>
</div>

<div style="background: #fff;padding: 7px; margin-top: 7px;text-align: center;" class="container container-top">
  <form action="helper/payment.php?aksi=cartselected" id="myForm" method="POST">
    <input type="hidden"  id="id" name="id" value="<?php echo $selected ?>" />
    <input type="hidden"  id="isipesan" name="isipesan"/>
    <input type="hidden"  id="isitotal" name="isitotal"/>
    <input type="hidden"  id="payment" name="payment" />
    <input type="submit" value="Bayar" id="add" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">
  </form>
  <script>
  $(function() {
      $("#myForm").submit(function() {
          $("#payment").each(function() {
              var checkbox = $("#payment").val();
              if (!checkbox) {
                 $('<span>Pilih Metode dulu</span>').appendTo('#errorpay');
                 $('#metode').css('border', '2px solid #df3434');
                 $('#add').attr("disabled", true);
              } else {
                  document.getElementById("userform").submit();
              }
          });

          return false;
      });
  });
  </script>


</div>
<script type="text/javascript">
  var sum = 0.0;
  $('.hasilkonfirmasi').each(function()
  {
    sum += parseFloat($(this).text());
  });
  $("#isitotal").val(sum);
</script>
<script type="text/javascript">


  $(document).ready(function(){
    $(".tombol-cust").live("click",function(){
      var data = $('.form-customer').serialize();
      $.ajax({
        type: 'POST',
        url: "helper/payment.php?aksi=addalamat",
        data: data,
        success: function() {
          $('.alamat').load('helper/payment.php?aksi=alamatload');
        }
      });
    });
  });
</script>

<script src="assets/js/kb-helper.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/jquery.lazyload.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>