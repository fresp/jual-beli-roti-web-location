<?php include 'template/head.php'; ?>
  <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div class="register-form">
        <div class="register-header">
          Belum punya akun ? Daftar <a href="daftar.php">di sini</a>
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
          <form action="helper/member.php?aksi=login" method="POST" id="frm-login">
            <div class="form-group">
              <input class="form-control" name="email" id="email" placeholder="Masukan email" type="email">
            </div>
            <div class="form-group">
              <input class="form-control" name="pass" id="pass" placeholder="Password" type="password">
              
            </div>
            <div class="form-group">
              
             
                <p align="right" style="margin-top: 10px;">Lupa password? Klik <a href="password_reset.php">disini</a></p>
              
            </div>
            <input type="submit" id="tombol-login" class="button" value="MASUK">
        
          </form>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Sidebar Kiri --> 
 <?php include 'template/footer.php'; ?>