<?php 
$name= $_GET['name'];
$kategori=str_replace('-', ' ', $name);
session_start();
error_reporting(0);
$idlapak = $_SESSION['lpk_id'];

include 'member/template/headaccess.php';
if($_SESSION['alert']=='diluar'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.success({
        title: 'Maaf',
        message: 'Produk diluar Jangkauan',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
unset($_SESSION['alert']);
}
?>
<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<div class="feed" id="feed" style="height: 30px;">
		<div style="float: left;margin: -7px 10px 0px 0px;padding: 10px;">
			<p style="margin: 3px;font-weight: bold;color: #2B838D;">Kategori : <?php echo $kategori?></p>
		</div>
	</div>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<div class="feed" id="feed">
        <ul class="product-list"  id="updates">
          <?php 
          require_once 'module/produk.php';
          $produk = new produk();
          $databarang = $produk->datakategori($kategori); 
          echo $databarang;
          ?>
        </ul>
       
     </div>
</div>
<?php
include 'member/template/footeraccess.php';
?>
