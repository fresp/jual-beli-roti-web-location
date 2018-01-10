<!-- Sidebar Kiri --> 
<div id="overlay-body" style="display: none;"></div>
<div id="app-menu" style="display: none;" class="side-menu-main-wrapper">
  <div class="side-menu-wrapper">
    <div class="section" style="padding: 0px;">
      <div class="bg-header">
        <div class="bg-header-content-box">
          <button id="close-menu" type="button" class="kb-button">

            <i style="color: #2B838D;" class="fa  fa-close "></i>
          </button>
          <?php
          if($_SESSION['login']){
            ?>
            <img class="user-photo" style="margin-left: 100px;" src="../assets/img/default-dp.png">
            <div class="user-fullname" >
              <?php echo $_SESSION['nama']; ?>  <a href="../helper/member.php?aksi=logout" style="background: #ff9000;padding: 3px;color: #fff;">Keluar</a>                
            </div>
            <div class="user-saldo" >
              Saldo Rp. 
              <?php 
              require_once 'module/saldo.php';
              $saldo = new saldo();
              $saldodata = $saldo->data(); 
              echo $saldodata;
              ?>             
            </div>  

            <?php
          }else{
            ?>
            <!--Jika User belum Login-->
            <div class="title">
              Belum punya akun?
              <br>
              <br>
            </div>
            <div class="button-wrapper">
              <div class="row">
                <div class="column-6">
                  <a href="daftar.php" style="display: block; text-align: center;" class="kb-button kb-button2 button-float">Daftar</a>
                </div>
                <div class="column-6">
                  <a href="login.php" style="display: block; text-align: center;" class="kb-button kb-button2 button-float">Masuk</a>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php
    if($_SESSION['login']){
      ?>
      <div class="section">
        <ul>
          <li>
            <a href="../member/index.php"><i class="fa fa-home"></i>  Dashboard</a>
          </li>
          
          <li class="special-dropdown">
            <div class="row">
              <div class="column-12" style="padding :0px">
                <div class="column-1">
                  <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-th"></i></a>
                </div>
                <div class="column-10">

                  <button type="button" id="sidekat" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
                    <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Kategori</a></span>
                  </button>
                </div>
                <div class="column-1" style="margin: 5px 0px 0px -40px;">
                  <i id="sidetooglekat" class="fa fa-angle-left"></i>
                </div>
              </div>
            </div>
            <div id="katmenu" style="display: none;">
              <?php 
              $segment ="sub";
              require_once 'module/produk.php';
              $produk = new produk();
              $listkat = $produk->kategori($segment); 
              echo $listkat;
              ?>
            </div>  
          </li>
          <li class="special-dropdown">
            <div class="row">
              <div class="column-1">
                <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-tags"></i></a>
              </div>
              <div class="column-10">

                <button type="button" id="sidebuy" class="btnnavbar" style="text-align: left;margin-top: -4px;height: 31px;">
                  <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Pembelian</a></span>
                </button>
              </div>
              <div class="column-1" style="margin: 5px 0px 0px -40px;">
                <i id="sidetooglebuy" class="fa fa-angle-left"></i>
              </div>
            </div>
            <div id="buymenu" style="display: none;">
              <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
                <div class="column-1">
                </div>
                <a href="../member/produk.php" style="width: 100%;padding-left: 27px;">
                  <div class="column-10"><span style="">Daftar Pemesanan</span><br>
                  </div>
                </a>
              </div>
              <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
                <div class="column-1">
                </div>
                <a href="?aksi=hayoooo" style="width: 100%;padding-left: 27px;">
                  <div class="column-10"><span style="">Transaksi dibatalkan</span><br>
                  </div>
                </a>
              </div>


            </div>  
          </li>
        </ul>
      </div>
      

      <div class="section">
        <?php 
        $segment ="sub";
        require_once 'module/seller.php';
        $seller = new seller();    
        $infolapak = $seller->infolapak($segment); 
        echo $infolapak;
        ?>
      </div>
      <div class="section">
        <ul>
          <li class="special-dropdown">
            <div class="row">
              <div class="column-1">
                <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-gear"></i></a>
              </div>
              <div class="column-10">

                <button type="button" id="sidesetting" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
                  <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Pengaturan</a></span>
                </button>
              </div>
              <div class="column-1" style="margin-left: -40px;">
                <i id="sidetoogleset" class="fa fa-angle-left"></i>
              </div>
            </div>
            <div id="settingmenu" style="display: none;">
              <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
                <div class="column-1">
                </div>
                <a href="../edit_akun.php" style="width: 100%;padding-left: 27px;">
                  <div class="column-10"><span style="">Akun saya</span><br>
                  </div>
                </a>
              </div>
              <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
                <div class="column-1">
                </div>
                <a href="../edit_pass.php" style="width: 100%;padding-left: 27px;">
                  <div class="column-10"><span style="">Password Saya</span><br>
                  </div>
                </a>
              </div>
              <?php
              $lapak =$_SESSION['lpk_id'];
              if(!$lapak){
              }else{
                ?>
                <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
                  <div class="column-1">
                  </div>
                  <a href="../edit_toko.php" style="width: 100%;padding-left: 27px;">
                    <div class="column-10"><span style="">Toko Saya</span><br>
                    </div>
                  </a>
                </div>
                <?php
              }
              ?>
            </div>  
          </li>
        </ul>
      </div>

      <div class="section" >
        <ul>
         <li>
           <a href="../help.php"><i class="fa fa-building-o"></i> Bantuan</a>
         </li>

             <li>
       <a href="konfirmasi.php"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
     </li>

       </ul>
     </div>
   </div>
   <footer style="border-top: 2px solid #d2d2d2;box-shadow: 2px 0 0 rgba(0, 0, 0, .13);width: 100%;padding: 7px;background: #fff;overflow: auto;">
    <div class="column-6" style="text-align: left;">
      Toko Kamu <br>
      <p style="margin-top: 0px;font-size: 16px;font-weight: bold;"><?php echo $_SESSION['lpkuser']?></p>
    </div>
    <div class="column-6">
     <a class="btn-pesan" href="../<?php echo $_SESSION['lpkuser']?>">Lihat</a>
   </div>
 </footer>
 <?php
}else{
  ?>
  <div class="section" >
    <ul>
     <li>
       <a href="../help.php"><i class="fa fa-building-o"></i> Bantuan</a>
     </li>
     <!--
     <li>
       <a href="#"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
     </li>
     -->
   </ul>
 </div>
</div>
<footer style="border-top: 2px solid #d2d2d2;box-shadow: 2px 0 0 rgba(0, 0, 0, .13);width: 100%;padding: 7px;background: #fff;overflow: auto;">
  <div class="column-6" style="text-align: left;">
    Ingin Berjualan? <br>
    <p style="margin-top: 0px;font-size: 16px;font-weight: bold;">Silahkan Klik</p>
  </div>
  <div class="column-6">
    <a class="btn-pesan" href="orderconfirm.php?selected=67">Disini</a>
  </div>

</footer>
<?php
}
?>
</div>
<div id="cart-slide-container" style="display: none;" class="slide-modal-container">
  <div class="slide-modal-header" style="padding: 0px;margin-bottom: 0px;">
    <div class="search-textbox">
      <div class="column-2">
        <button id="close-cart" class="kb-button button-1 left-menu" style="color: #7ac144;   background: transparent; position: relative; left: 9px;">
          <i class="fa fa-2x fa-close">  </i>
        </button>
        <script type="text/javascript">
          $("#close-cart").click(function() {
            $("#cart-slide-container").hide("slide", {
              direction: "right"
            }, 300, function() {
              $("#overlay-body").fadeOut("fast");
            });
          });
        </script>
      </div>
      <div class="column-10">
        <div class="navbar-search">

         <h3 style="padding: 5px 0px 0px 0px;margin: 0px;">KERANJANG BELANJA</h3>
       </div>
     </div>

   </div>
 </div>
 <div id="listcart" style="height: 93% ;">


  <?php
  $segment ="sub"; 
  require_once 'module/produk.php';
  $produk = new produk();
  $produkData = $produk->listcart($segment); 
  echo $produkData;
  ?>

</div>
</div>
<script type="text/javascript">
  var button = document.getElementById('sidesetting');
  button.onclick = function() {
    var div = document.getElementById('settingmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetoogleset").removeClass("fa fa-angle-down");
      $("#sidetoogleset").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetoogleset").removeClass("fa fa-angle-left");
      $("#sidetoogleset").addClass("fa fa-angle-down");
    }
  };
  var button = document.getElementById('sidekat');
  button.onclick = function() {
    var div = document.getElementById('katmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglekat").removeClass("fa fa-angle-down");
      $("#sidetooglekat").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglekat").removeClass("fa fa-angle-left");
      $("#sidetooglekat").addClass("fa fa-angle-down");
    }
  };
  var button = document.getElementById('sidebuy');
  button.onclick = function() {
    var div = document.getElementById('buymenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglebuy").removeClass("fa fa-angle-down");
      $("#sidetooglebuy").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglebuy").removeClass("fa fa-angle-left");
      $("#sidetooglebuy").addClass("fa fa-angle-down");
    }
  };  
  var button = document.getElementById('sidechart');
  button.onclick = function() {
    var div = document.getElementById('chartmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglechart").removeClass("fa fa-angle-down");
      $("#sidetooglechart").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglechart").removeClass("fa fa-angle-left");
      $("#sidetooglechart").addClass("fa fa-angle-down");
    }
  };
</script>
<script src="../assets/js/kb-helper.js"></script>
<script src="../assets/js/jquery-ui.js"></script>
<script src="../assets/js/jquery.lazyload.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>