<?php
session_start();
error_reporting(0);
$id = $_SESSION['iduser'];
if($_SESSION['login'] !=""){
  include 'template/head.php';
  ?>
    <div style="margin-top: 90px;" class="container container-top" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div id="tampilmember">
        <form action="../helper/member.php?aksi=savepassword" enctype="multipart/form-data" method="POST" id="frm-editpass" style="overflow: hidden;height: auto;font-size: 12px;width: 100%;margin-right: auto;margin-left: auto;background: #fff;padding: 30px 20px 0px 20px;border-radius: 10px;box-shadow: 1px 1px 3px #AAA;margin-top: 10px;">

          <div style=" text-align: left; padding: 0px 5px;">
            <div class="column-12" style="margin-bottom: 10px;padding: 0px;">
              <div class="column-12">
                <label>Password Sekarang :</label>
                <input class="kb-input " name="pass" id="pass" placeholder="Password Sekarang" type="password">
              </div>
            </div>
            <div class="column-12" style="padding: 0px;">
              <div class="column-12">
                <div class="column-6 "  style="padding: 0px;">
                  <label>Password Baru :</label>
                  <input class="kb-input required" name="passnew" id="passnew" placeholder="Password Baru" type="password" >
                </div>
                <div class="column-6 form-group" style="padding: 0px;">
                  <label>Password konfirmasi :</label>
                  <input class="kb-input required" name="pass2"
                  id="pass2" placeholder="Password Konfirmasi" type="password">
                </div>
              </div>
            </div>
          
            <div class="column-12" style="margin-bottom: 10px;padding: 0px;" id="lapaklokasi">
              <div class="column-12" style="margin-bottom: 10px;">
                <input name="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Simpan" type="submit">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div id="verifikasi" class="modal" style="display:none;">
      <div class="row-fluid">
        <div class="span12"> 
          <div class="row-fluid">
            <label class="control-label" for="inputAddress" style="text-align: center;">Ganti Nomer</label>
            <hr>
            <div class="column-12 "  style="padding: 0px;">
              <label style="font-weight: unset;">Nomer Lama :</label>
              <input class="kb-input required" name="memfirst" id="memfirst" style="" disabled value="<?php echo $rowtmp['mem_phone']?>" placeholder="Nomer Lama" type="text" >
            </div>
            <form  id="frm-requestotp" method="post" class="frm-requestotp">  

              <div class="column-12 " style="padding: 0px;">
                <label style="font-weight: unset;">Nomer Baru:</label>
                <input class="kb-input required" name="phone"
                id="phone" value="" placeholder="Nomer Baru" type="text">
                <button  class="kb-button requestotp button-float kb-button2" style="padding: 7px;cursor: pointer;width: 97%;margin: 10px 0px;" type="submit">
                  Minta Kode
                </button> 
              </div>
            </form>
            <div id="otpsucces"></div>
            <form action="../helper/member.php?aksi=simpanno" method="POST" id="frm-updateno">
              <div class="column-12"  style="padding: 0px;">
                <label style="font-weight: unset;">Kode Verifikasi :</label>
                <input class="kb-input required" name="kodeotp" id="kodeotp" style="" value="<?php echo $kode?>" placeholder="Kode Verifikasi" type="text" >
              </div>
              <div class="column-12 form-group"  style="padding: 0px;">
                <label style="font-weight: unset;">Password :</label>
                <input class="kb-input required" name="pass" id="pass" style="" value="" placeholder="password" type="password" >
              </div>
              <button  class="kb-button simpanno button-float kb-button2" style="padding: 7px;cursor: pointer;width: 97%;background: #4b4545;margin: 10px 0px;" type="submit">
                Simpan
              </button> 
            </form>
          </div>


          
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
  <?php
  include 'template/footer2.php';
}elseif($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:../index.php');
}
?>