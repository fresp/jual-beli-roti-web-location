
<?php
session_start();
error_reporting(0);
$teks=$_GET["name"];
$pecah = explode("-", $teks);
$a = $pecah[0];
$b = $pecah[1];
$c = $pecah[2];
$d = $pecah[3];
$e = $pecah[4];
$f = $pecah[5];
$g = $pecah[6];
$h = $pecah[7];
$cari=str_replace('-', ' ', $teks);

include 'member/template/headaccess.php';
?>
<script type="text/javascript">
  $(window).load(function() {
    var div = document.getElementById('frm-cari');
    var height = document.getElementById('navbar-main');
    var content = document.getElementById('contents');
    div.style.display = 'block';
    height.style.height = '80px';
    content.style.margin = '90px 0px 0px 0px;';
  });
</script>

<div style="margin-top: 90px;" class="container container-top">

  <div class="feed" id="feed">

    <ul class="product-list"  id="updates">
     <?php
     require_once 'module/produk.php';
     $produk = new produk();
     $produkcari = $produk->cari($a,$b,$c,$d,$e,$f,$g,$h); 
     echo $produkcari;
     ?>
   </ul>

 </div>
</div>
<?php
include 'member/template/footeraccess.php';
?>