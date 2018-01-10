<?php 
include 'template/head.php';
session_start();
error_reporting(0);
if($_SESSION['alert']=='login'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Login Berhasil',
        message: 'Selamat Berbelanja',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='savepassword'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Password berhasil diganti',
        message: 'Silahkan Login Kembali',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='tokooffline'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Toko Offline',
        message: 'Maaf Toko Sedang Offline',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='accdenied'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Akses Ditolak',
        message: 'Silahkan Login terlebih dahulu',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='resetpassword'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Password berhasil diganti',
        message: 'Silahkan Login',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='resetfailed'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Password Gagal diganti',
        message: 'Silahkan Mencoba lagi',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='versuccess'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Pendaftaran Berhasil',
        message: 'Silahkan Berbelanja',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}elseif($_SESSION['alert']=='savepassword'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Password berhasil diganti',
        message: 'Silahkan Login Kembali',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}elseif($_SESSION['alert']=='logout'){
  ?>

  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Berhasil keluar',
        message: 'Sampai Bertemu lagi',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}elseif($_SESSION['alert']=='404'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: '404 Not Found',
        message: 'Halaman Tidak ditemukan',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}elseif($_SESSION['alert']=='nerbielost'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Lokasi Belum Ada',
        message: 'Tentukan Lokasi kamu',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
elseif($_SESSION['alert']=='denied'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Pembelian Gagal',
        message: 'Silahkan Login terlebih dahulu',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
}
?>
<div id="loginmodal" style="display:none;">
  <div class="row-fluid">
    <div class="span12">
      <form id="loginform" method="post" class="form-user">  
        <div class="row-fluid">
          <label class="control-label" for="inputAddress">Lokasi Terdekat</label>
          <div class="controls">

            <input type="text" name="nerbie" onfocus="this.select();" onmouseup="return false;"  class="txtfield inputAddress input-xxlarge" value="<?php echo $_SESSION['nerbie'] ?>" autocomplete="off" placeholder="Type in your address">
          </div>

          <input type="text" hidden="hidden" name="lat" class="latitude" id="latitude">
          <input type="text" hidden="hidden" name="lon" class="longitude" id="longitude">
        </div>
        <a class="btn tombol-simpan hidemodal" style="  background: #232323;padding: 5px 10px;color: #fff;  ">Tentukan</a>

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
<div style="margin-top: 90px;" class="container container-top" id="contents">

  <div id="newest-welcome-list">
    <div class="search_style" id="search_style">
      <a href="#loginmodal" id="modaltrigger">
       <span class="fa fa-map-marker" style="color: #FF5454;">
        <?php
        if($_SESSION['nerbie']==""){
          echo "</span> Tentukan Lokasimu";
        }
        else{
          $teks = $_SESSION['nerbie'];
              //pecah string berdasarkan string ","
          $pecah = explode(",", $teks);
              //mencari element array 0
          $hasil = $pecah[0];
              //tampilkan hasil pemecahan

          echo "5 KM </span> dari ".$hasil;
        }
        ?>
      </a>
    </div>

    <div class="feed" id="feed">
      <ul class="product-list"  id="updates">
        <?php 
        require_once 'module/seller.php';
        $seller = new seller();
        $sellerData = $seller->data(); 
        echo $sellerData;
        ?>
      </ul>

    </div>
  </div>
</div>
<?php include 'template/footer.php'; ?>
<?php
unset($_SESSION['alert']);
?>  