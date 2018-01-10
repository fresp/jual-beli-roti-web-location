<?php
session_start();
error_reporting(0);

if($_SESSION['login'] !=""){
  include 'template/head.php';
  ?>
  <div id="loginmodal" style="display:none;">
    <div class="row-fluid">
      <div class="span12">
        <form id="loginform" method="post" class="form-user">  
          <div class="row-fluid">
            <label class="control-label" for="inputAddress">Lokasi Terdekat</label>
            <div class="controls">

              <input type="text" name="nerbie" onfocus="this.select();" onmouseup="return false;"  class="txtfield inputAddress input-xxlarge" value="<?php echo $_SESSION['lpknerbie'] ?>" autocomplete="off" placeholder="Type in your address">
            </div>

            <input type="text" hidden="hidden" name="lat" class="latitude" id="latitude">
            <input type="text" hidden="hidden" name="lon" class="longitude" id="longitude">
          </div>
          <a class="btn tombol-lapak hidemodal" style="  background: #232323;padding: 5px 10px;color: #fff;  ">Tentukan</a>

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

  <div style="margin-top: 90px;" class="container container-top" style="margin-top: 30px;background: #fff;padding: 10px;">
    <div id="upload-wrapper">
      <form action="../helper/lapak.php?aksi=uploadtoko" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
        <div class="form-group">
          <label >Foto Toko :</label>
          <div class="verif-wrapper">
            <i style=""></i>
            <input type="hidden" name="proid" value="<?php echo $_GET['id']?>">
            <input  name="ImageFile" class="header-search" id="imageInput" type="file">
            <input type="submit" class="tombol" value="upload">
          </div>
        </div>
        <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
      </form>
    </div>

    <div id="tampiltoko">
      <?php 
      $id =$_GET['id'];
      require_once '../module/seller.php';
      $seller = new seller();
      $sellerData = $seller->tampiltoko($id); 
      echo $sellerData;
      ?>
    </div>
  </div>
  <?php
  include 'template/footer2.php';
}elseif($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:../index.php');
}
?>