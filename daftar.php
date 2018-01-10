<?php include 'template/head.php'; ?>
  <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div class="register-form">
        <div class="register-header">
          Sudah punya akun silahkan masuk <a href="login.php">di sini</a>
          <hr>
        </div>
        <!--Login With 0auth
        <div class="register-Auth">
          <button type="button" class="btn btn-block btn-primary"><i class="fa fa-facebook"> Facebook</i></button>
          <button type="button" class="btn btn-block btn-default"><i style="color: red;" class="fa fa-google"></i> Google</button>
        </div>
        -->
        <div>
          <!--Login With 0auth
          <div class="form-group">
            <div class="column-5" style="border-bottom: 1px solid #d5d2d2; margin-top: 20px;margin-bottom :20px;">
            </div>
            <div class="column-2" style="text-align: center; margin-bottom :20px;">
              <h4>ATAU</h4>
            </div>
            <div class="column-5" style="border-bottom: 1px solid #d5d2d2; margin-top: 20px;margin-bottom :20px;">
            </div>
          </div>
           -->
          <form  action="helper/member.php?aksi=daftar" method="POST" id="frm-dftr">
            <div class="form-group">
              <input class="form-control required " id="email" name="email" placeholder="Enter email" type="email"   >
            </div>
            <div class="column-6" style="padding-left: 0px;">
              <div class="form-group">
                <input class="form-control required alpha"  id="first" name="first" placeholder="Nama Depan" type="text">
              </div>
            </div>
            <div class="column-6" style="padding-right: 0px;">
              <div class="form-group">
                <input class="form-control required alpha"  id="last"  name="last" placeholder="Nama Belakang" type="text">
              </div>
            </div>
            <div class="form-group">
              <input class="form-control required" name="phone" id="phone" placeholder="Handphone" type="text">
            </div>
            <div class="form-group">
              <input class="form-control required" name="pass" id="pass" placeholder="Password" type="password">
            </div>
            <div class="form-group">
              <input class="form-control required" name="pass2" id="pass2" placeholder=" Ulangi Password" type="password">
            </div>
            <label for="exampleInputEmail1">Tekan "Daftar" jika Kamu telah menyetujui
              <a href="#">aturan penggunaan</a> </label>
            <input type="submit" class="button" value="Daftar"><br>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include 'template/footer.php'; ?>