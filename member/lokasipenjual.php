<?php include 'template/head.php'; ?>
  <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div class="register-form">
        <div class="register-header">
          <h4><span style="font-weight: bold;">Langkah ke 2</span> | Tentukan Lokasi Toko</h4>
          <hr>
        </div>

        <div>
          <div class="row-fluid">
                <div class="span12">
                  <form  action="../helper/lapak.php?aksi=setlokasi" method="POST">  
                    <div class="row-fluid">
                      <label class="control-label" for="inputAddress">Lokasi Terdekat</label>
                      <div class="controls">
                        <input type="text" name="nerbie" class="inputAddress input-xxlarge" value="
                        <?php
                        if($_SESSION['nerbie']==""){
                          echo "Jl. Taman Wijaya Kusuma, Ps. Baru, Sawah Besar, Kota Jakarta Pusat, DKI Jakarta 10710, Indonesia";
                        }else{
                          echo $_SESSION['nerbie'];
                        }
                        ?>
                        " autocomplete="off" placeholder="Type in your address">
                      </div>

                      <input type="text" hidden="hidden" name="lat" class="latitude" id="latitude">
                      <input type="text" hidden="hidden" name="lon" class="longitude" id="longitude">
                    </div>
                    <br>
                     <input type="submit" class="button" value="NEXT">
                  </form>
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
      </div>
    </div>
  </div>
<?php include 'template/footer2.php'; ?>