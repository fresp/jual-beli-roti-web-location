<?php include 'template/head.php'; ?>
  <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div class="register-form">
        <div class="register-header">
          <h3>Upload Foto Toko</h3>
          <hr>
        </div>

        <div>
            <form id="uploadForm" action="../helper/lapak.php?aksi=upload"  enctype="multipart/form-data" method="post"">
              <div class="form-group">
                 <label >Foto Toko :</label>
                <div class="verif-wrapper">
                  <i style=""></i>
                  <input  name="seller" class="header-search"   type="file">
                  <input type="submit" class="tombol" value="upload">
                </div>
              </div>
              <div id="targetlayer" style="text-align: center;"></div>
            </form>
             <input type="submit" class="button" value="Menuju Halaman Seller"><br>
        </div>
      </div>
    </div>
  </div>
<?php include 'template/footer2.php'; ?>