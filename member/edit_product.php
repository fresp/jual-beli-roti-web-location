<?php
session_start();
error_reporting(0);

if($_SESSION['login'] !=""){
  include 'template/head.php';
  ?>


  <div style="margin-top: 90px;" class="container container-top" style="margin-top: 30px;background: #fff;padding: 10px;">
    <div id="upload-wrapper">
      <form action="../helper/produk.php?aksi=uploadproduct" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
        <div class="form-group">
          <label >Foto Produk :</label>
          <div class="verif-wrapper">
            <i style=""></i>
            <input type="hidden" name="proid" value="<?php echo $_GET['id']?>">
            <input  name="ImageFile" class="header-search" id="imageInput" type="file">
            <input type="submit" class="tombol" value="upload">
          </div>
          <div style="width: 100%;text-align: center;">
            <span id="errorpay" style="font-weight: bold; color: red" ></span>
          </div>
        </div>
        <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
      </form>
    </div>
    
      <?php 
      $id =$_GET['id'];
      require_once '../module/produk.php';
      $produk = new produk();
      $sellerData = $produk->tampilproduk($id); 
      echo $sellerData;
      ?>
    <script>
      $(function() {
        $("#imageform").submit(function() {
          $("#pro_gambar").each(function() {
            var checkbox = $("#pro_gambar").val();
            var cust = $("#isicust").val();
            if (!checkbox) {
              $('<span>Foto Tidak Boleh Kosong</span>').appendTo('#errorpay');
              $('#metode').css('border', '2px solid #df3434');
              $('#submit').attr("disabled", true);
            }else {
              document.getElementById("userform").submit();
            }
          });

          return false;
        });
      });
    </script>
  </div>
  <?php
  include 'template/footer2.php';
}elseif($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:../index.php');
}
?>