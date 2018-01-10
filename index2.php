<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Warung Modern</title>
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="assets/css/style.css">
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 <link rel="stylesheet" href="assets/css/idangerous.swiper.css">
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
 <link rel="stylesheet"
 href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"
 type="text/css">
 <script src="//kebunbibit.id/mobile/public/js/jquery.min.js"></script>
 <script type="text/javascript" src="assets\js\jquery-migrate.js"></script>
 <script src="//kebunbibit.id/mobile/public/js/bower_components/jquery_lazyload/jquery.lazyload.js"></script>
 <script src="assets/dist/jquery.addressPickerByGiro.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9q4LR-dTaJ8avQQ82lg8Fgjqqjt6oyhU&sensor=false&language=en"></script>


  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
 <link href="assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
 <style type="text/css">
  #facebook_style {
  
    width: 100%;
  text-align: center;
  margin: 20px 0px;

  }

  #facebook_style a {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    background: #2b838d;
    margin-bottom: 10px;
    color: #FFF;
  }
</style>

<script type="text/javascript">
  $(document).ready(function() {
      //jika showmore post diklik
      $('.load_more').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "tampil.php", //proses ke file php
            data: "idakhir="+ id_terakhir,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
  </script>
</head>
<body>
 <div id="navbar-main" style="display: block;" class="navbar-container">
  <div class="container">
    <div class="navbar">
      <div class="row">
        <div class="column-7" style="text-align: left;">
          <div class="wrapper" style="display: inline-block; position: absolute;">
             <button id="hamburger-menu" class="kb-button button-1" style="font-size: 24px;margin-top: -5px;color: #fff;"> <i class="fa fa-bars"></i></button>
          </div>
          <a href="#">
            <img class="logo" src="assets/img/logo.png">
          </a>
        </div>
        <div class="column-5" style="text-align: right;">
          <div class="wrapper">
            <ul class="top-right-menu">
              <li style="">
                <a href="#">
                  <div id="notification-badge-27162" style="display: none;" class="kb-badge">
                    <span style="position: relative;top: 1px;">0</span>
                  </div>
                  <i class="material-icons">notifications</i>
                </a>
              </li  >
              <li>
                <a id="open-cart-modal" href="#">
                  <div style="display: none;" class="kb-badge">
                    <span class="cart-count-replaceable" style="position: relative;top: 1px;">0
                    </span>
                  </div>
                  <i  class="material-icons">shopping_cart</i>
                </a>
              </li>
              <li>
                <a id="open-query-modal" href="#">
                  <i class="material-icons">search</i>
                </a>
              </li>
              <li>
                <a id="open-query-modal" href="#">
                  <i class="material-icons">photo_camera</i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="vertical-align: center;" class="container container-top">
      <!--SLIDER
      <div id="banner-slideshow">
        <div class="swiper-container">
          <div class="swiper-wrapper">
        
            <div class="swiper-slide">
              <a href="#">
                <img src="assets/img/banner-lg-1.jpg">
              </a>
            </div>
            <div class="swiper-slide"> 
              <a href="#">
                <img src="assets/img/banner-lg-1.jpg">
              </a>
            </div>
          
            <div class="swiper-slide">
             <img src="assets/img/banner-lg-1.jpg"> 
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    -->
    <div id="newest-welcome-list">
       <div class="search_style" id="search_style">
        <a id="<?php echo $id; ?>" href="#"  >
         <span class="fa fa-map-marker" style="color: #FF5454;">&nbsp5 KM</span>  dari Jl. Terusan Pejaten Barat II
        </a>
        
      </div>
      <ul class="product-list"  id="updates">
       <?php
       $con=mysqli_connect("localhost","root","","googlemap");
       $query = mysqli_query($con, "SELECT * FROM data_location LIMIT 2") or die (mysqli_error());
       if(mysqli_num_rows($query) == 0  ){
         echo "<b>Maaf Tukang Sayur <Br>Belum Tersedia dilokasi anda :(</b>";
       }else{
        while($r = mysqli_fetch_array($query)):   
        $lat = $r['lat'];
        $long = $r['lon'];
        $lat2 = -6.17017;
        $long2 = 106.83139;      
        $latFrom = deg2rad($lat2);
        $lonFrom = deg2rad($long2);
        $latTo = deg2rad($lat);
        $lonTo = deg2rad($long);  
        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
        $angle = atan2(sqrt($a), $b);
        $jarak = $angle * 6371000;
        $km = ceil($jarak);
        $id = $r['id'];
        $nama = $r['desc'];
        ?>
        <li class="list-content">
          <div class="product-wish">
            <div class="content">
              <ul class="rating">
                <li>
                  <button class="love__button-wish "><i class="fa fa-heart "></i></button>
                </li>      
              </ul>
            </div>
          </div>
          <a href="#">
            <img class="lazy" src="assets/img/lazyload.gif" data-original="assets/uploads/thumb/usb-cable.jpg">
            <div class="caption product-name">
              <?php echo  $nama ?>
            </div>  
           
          <div class="caption product-seller">
            <div class="content">
              <span class="fa fa-map-marker"></span>
              <?php echo $km. " Meter"  ?>
            </div>
          </div>
                <!--Rating
                <div class="product-special-info">
                  <div class="content">
                    <ul class="rating">
                      <li>
                         <i class="material-icons">star_border</i>
                      </li>
                      <li>
                         <i class="material-icons">star_border</i>
                      </li>
                      <li>
                         <i class="material-icons">star_border</i>
                      </li>
                      <li>
                         <i class="material-icons">star_border</i>
                      </li>
                      <li>
                         <i class="material-icons">star_border</i>
                      </li>
                    </ul>
                  </div>
                </div>
              -->
            </a>
        </li>
        <?php
          endwhile;
     
        ?>
      </ul>
      <div class="facebook_style" id="facebook_style">
        <a id="<?php echo $id; ?>" href="#" class="load_more" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Lihat Lainnya
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              <img src="assets/img/arrow1.png" /></a>
      </div>
      <?php
         }
         ?>
    </div>
  </div>
  <!-- Sidebar Kiri --> 
  <div id="overlay-body" style="display: none;"></div>
  <div id="app-menu" style="display: none;" class="side-menu-main-wrapper">
    <div class="side-menu-wrapper">
      <div class="section" style="padding: 0px;">
        <div class="bg-header">
          <div class="bg-header-content-box">
            <button id="close-menu" type="button" class="kb-button">
              <i style="color: #FFF;" class="material-icons">close</i>
            </button>
                <!--Jika User belum Login
                <div class="title">
                  Belum punya akun?
                </div>
                <div class="button-wrapper">
                  <div class="row">
                    <div class="column-6">
                      <a href="https://kebunbibit.id/mobile/index.php/register" style="display: block; text-align: center;" class="kb-button kb-button2 button-float">Daftar</a>
                    </div>
                    <div class="column-6">
                      <a href="https://kebunbibit.id/mobile/index.php/login" style="display: block; text-align: center;" class="kb-button kb-button2 button-float">Masuk</a>
                    </div>
                  </div>
                </div>
              -->
              <img class="user-photo" src="http://warungmodern.co/assets/img/default-dp.png">
              <div class="user-fullname">
                freza                    
              </div>
            </div>
          </div>
        </div>
        <div class="section">
          <ul>
            <li>
              <a href="#"><i class="material-icons">home</i> Beranda</a>
            </li>
            <li style="display: none;">
              <a href="#"><i class="material-icons">trending_down</i> Tawar Abis</a>
            </li>
            <li  style="display: none;" class="special-dropdown">
              <div class="row">
                <div class="column-10">
                  <a class="dropdown-emitter" href="#"><i class="material-icons">thumb_up</i> Rekomendasi</a>
                </div>
                <div class="column-2">
                  <button class="dropdown-button" type="button"><i class="fa fa-caret-down"></i></button>
                </div>
              </div>
              <div  class="special-dropdown-result">
                <ul>
                  <li>
                    <a href="#">
                      <div>
                        Boneka Horta
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div>
                        Spesial Magic Bean
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li  style="display: none;" class="special-dropdown">
              <div class="row">
                <div class="column-10">
                  <a class="dropdown-emitter" href="#"><i class="material-icons">label</i> Kategori</a>
                </div>
                <div class="column-2">
                  <button class="dropdown-button" type="button"><i class="fa fa-caret-down"></i></button>
                </div>
              </div>
              <div  class="special-dropdown-result">
                <ul>
                  <li>
                    <a href="#">
                      <div class="category-caption">
                       Fashion Pria                           
                     </div>
                   </a>
                 </li>
                 <li>
                  <a href="#">
                    <div class="category-caption">
                      Fashion Wanita                          
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="category-caption">
                      Handphone & Tablet                          
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="category-caption">
                      Lain Lain                           
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="section"  >
        <ul>
          <li>
            <a href="#"><i class="material-icons">local_florist</i> Produk Saya</a>
          </li>
          <li class="special-dropdown">
            <div class="row">
              <div class="column-10">
                <a class="dropdown-emitter" href="#"><i class="material-icons">swap_horiz</i> Transaksi</a>
              </div>
              <div class="column-2">
                <button class="dropdown-button" type="button"><i class="fa fa-caret-down"></i></button>
              </div>
            </div>
            <div style="display: none;" class="special-dropdown-result">
              <ul>
                <li>
                  <a href="#">
                    <div>
                      Pembelian
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div>
                      Penjualan
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#"><i class="material-icons">attach_money</i> Saldo Saya Rp 0</a>
          </li>
          <li>
            <a href="#"><i class="material-icons">favorite</i> Wishlist Saya</a>
          </li>
          <li class="special-dropdown">
            <div class="row">
              <div class="column-10">
                <a class="dropdown-emitter" href="#"><i class="material-icons">settings</i> Pengaturan</a>
              </div>
              <div class="column-2">
                <button class="dropdown-button" type="button"><i class="fa fa-caret-down"></i></button>
              </div>
            </div>
            <div  style="display: none;" class="special-dropdown-result">
              <ul>
                <li>
                  <a href="#">
                    <div>
                      Akun
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div>
                      Alamat
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div>
                      Rekening Bank
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="section" >
        <ul>
         <li>
           <a href="#"><i class="material-icons">business</i> Tentang Kami</a>
         </li>
         <li>
           <a href="#"><i class="material-icons">hourglass_full</i> Bagaimana Membeli</a>
         </li>
         <li>
           <a href="#"><i class="material-icons">hourglass_empty</i> Bagaimana Menjual</a>
         </li>
         <li>
           <a href="#"><i class="material-icons">credit_card</i> Cara Pembayaran</a>
         </li>
         <li>
           <a href="#"><i class="material-icons">done_all</i> Konfirmasi Pembayaran</a>
         </li>
       </ul>
     </div>
     <div class="section" style="display: none;" >
      <ul>
        <li>
          <a href="#"><i class="material-icons">help</i> Bantuan</a>
        </li>
        <li>
          <a href="#"><i class="material-icons">play_circle_filled</i> #YouTube</a>
        </li>
      </ul>
    </div>
    <div class="footer" style="display: none;">
      <div class="p">Copyright &copy; 2012 - 2017 Kebunbibit</div>
      <div class="p">All Rights Reserved</div>
      <div class="p">Page rendered in <strong>0.4308</strong> seconds.</div>
    </div>
  </div>
</div>
<!-- Sidebar Kanan --> 
<div id="search-slide-container" style="display: none;" class="slide-modal-container">
  <div class="slide-modal-header" style="padding: 0px;margin-bottom: 0px;">
    <div class="search-textbox">
      <div class="row">
        <div class="column-1">
          <button id="close-query-text" class="kb-button button-1 left-menu" style="color: #7ac144;   background: transparent; position: relative; left: 9px;">
            <i class="material-icons">arrow_back</i>
          </button>
        </div>
        <div class="column-9">
          <form action="#" class="navbar-search" method="GET" style="position: relative; bottom: 1px;">
            <input type="text" class="kb-input kb-input-search" id="kb-query-text" name="q" value="" autocomplete="off" placeholder="Cari Produk atau Pengguna">
          </form>
        </div>
        <div class="column-1">
          <button id="clear-query-text" class="kb-button button-1 left-menu" style="color: #7ac144; background: transparent;"><i class="material-icons">search</i></button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="//kebunbibit.id/mobile/public/js/kb-helper.js"></script><script src="//kebunbibit.id/mobile/public/js/jquery-ui.js"></script><script src="//kebunbibit.id/mobile/public/js/modal.js"></script><script src="//kebunbibit.id/mobile/public/js/jquery.bootpag.min.js"></script><script src="//kebunbibit.id/mobile/public/js/bower_components/mustache.js/mustache.min.js"></script><script src="//kebunbibit.id/mobile/public/js/numeral.min.js"></script>
<script src="//kebunbibit.id/public/js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>

<script src="//kebunbibit.id/mobile/public/js/bower_components/jquery_lazyload/jquery.lazyload.js"></script><script src="//kebunbibit.id/mobile/public/js/kb-global.js"></script><script src="//kebunbibit.id/mobile/public/js/icheck.min.js"></script><script src="//kebunbibit.id/mobile/public/js/jquery.touchSwipe.min.js"></script><script src="//kebunbibit.id/mobile/public/js/main.js"></script><script src="//kebunbibit.id/mobile/public/js/idangerous.swiper.min.js"></script><script src="//kebunbibit.id/mobile/public/js/slideshow.js"></script><script src="//kebunbibit.id/mobile/public/js/icheck.min.js"></script><script src="//kebunbibit.id/mobile/public/js/demo-checkbox.js"></script><script src="//kebunbibit.id/mobile/public/js/cart.js"></script><script src="//kebunbibit.id/mobile/public/js/numeral.min.js"></script>
<script src="//kebunbibit.id/mobile/public/js/welcome.js"></script>

</body>
</html>
