<?php
session_start();
error_reporting(0);
if($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:index.php');
}
include 'template/head.php'; ?>
<div style="vertical-align: center;margin-top: 100px;" class="container container-top">
  <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
    <div class="register-form">
      <div class="register-header" style="text-align: center;">
          <h3> KONFIRMASI PEMBAYARAN</h3>
        <hr>
        Terima kasih telah berbelanja di Warungmodern!
        Bila Anda telah melakukan pembayaran secara BANK TRANSFER, Dan Pembayaran belum dikonfirmasi, konfirmasikan pembayaran Anda disini agar dapat kami proses segera.
        <hr>
      </div>
       
      <div>
        
        <form  action="helper/payment.php?aksi=konfirmasi" method="POST" id="frm-konfirmasi">
          
          <div class="column-5" style="text-align: right;">
            No invoice :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required "  id="inv" name="inv" placeholder="" type="number">
            </div>
          </div>
          
         <div class="column-5" style="text-align: right;">
            Bank Tujuan :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <SELECT class="form-control required alpha" id="bankwm" name="bankwm" >
                <option value="">--Pilih Bank--</option>
                <option value="BCA">BCA</option>
                <option value="Mandiri">Mandiri</option>
              </SELECT>
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            Bank Anda :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required alpha"  id="bankcust" name="bankcust" placeholder="" type="text">
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            Rekening Atas Nama :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required alpha"  id="nama" name="nama" placeholder="" type="text">
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            No Rekening :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required "  id="norek" name="norek" placeholder="" type="text">
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            Metode Transfer :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <SELECT class="form-control required " id="method" name="method">
                <option value="">--Pilih Metode--</option>
                <option value="ATM">ATM</option>
                <option value="E-Banking">E-Banking</option>
                <option value="Setoran Tunai">Setoran Tunai</option>
                <option value="M-Banking-SMS Banking">M-Banking-SMS Banking</option>
              </SELECT>
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            Nominal Transfer :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required "  id="nominal" name="nominal" placeholder="--Rp --" type="number">
            </div>
          </div>
          <div class="column-5" style="text-align: right;">
            Tanggal Transfer :
          </div>
          <div class="column-6" style="padding-left: 0px;">
            <div class="form-group">
              <input class="form-control required "  id="tgltransfer" name="tgltransfer" placeholder="--Tanggal/Bulan/Tahun--" type="text">
            </div>
          </div>
            <input type="submit" class="button" value="KONFIRMASI"><br>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include 'template/footer.php'; ?>