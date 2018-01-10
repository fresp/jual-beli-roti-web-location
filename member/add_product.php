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
    <div id="output" >
      <table  width="100%" border="0" cellpadding="4" cellspacing="0">
        <tr>
          <td align="center">
            <img style="border: 0px">
          </td>
        </tr>
      </table> 

    </div>
    <form id="imageform" style="height: 380px;" action="../helper/produk.php?aksi=saveproduk" method="POST" enctype="multipart/form-data">

      <div style=" text-align: left; padding: 0px 5px;">
        <div>
          <input type="hidden" class="kb-input " name="pro_image" id="pro_image"  value="" placeholder="Nama Gambar">
          <div class="row" style="margin-bottom: 10px;">
            <div class="column-12">
              <div>
                <label >Kategori Produk :</label>
                <div class="">
                  <select class="kb-input" name="ctrg_id">
                    <option value="1">Kue Tradisional</option>
                    <option value="2">Roti Tawar</option>
                    <option value="3">Roti Manis</option>
                    <option value="4">Donat</option>
                    <option value="5">Cake</option>
                    <option value="6">Tart</option>
                    <option value="7">Keringan</option>
                    <option value="8">Lain lain</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="column-12">
              <label >Nama Produk :</label>
              <input type="text" class="kb-input required" name="pro_name" id="pro_name"  value="" placeholder="Nama Produk">
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="column-12">
              <label >Harga Produk :</label>
              <input type="number" class="kb-input required required" 
              value="" name="pro_saleprice" id="pro_saleprice" placeholder="Harga">
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="column-12">
              <label >Deskripsi Produk :</label>
              <textarea class="kb-textarea required" name="pro_description" id="pro_description" style="width: 96%;height: 7em;" placeholder="Deskripsi Produk"></textarea>
            </div>
          </div>


          <div class="row" style="margin-bottom: 10px;">
            <div class="column-12">
              <input type="submit" name="submit" id="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Posting">
            </div>
          </div>
        </div>
      </div>
    </form>
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