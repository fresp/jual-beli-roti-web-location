<?php include 'template/head.php'; ?>
<div style="vertical-align: center;margin-top: 100px;" class="container container-top">
	<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
		<div class="register-form">

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
      <form action="helper/member.php?aksi=resetpassword" method="POST" id="frm-reset">
      	<div class="form-group">
      		<label>Alamat E-mail atau Nomor Handphone</label>
      		<input class="form-control" name="email" id="email" type="text">
      	</div>
      
      	<input type="submit" id="tombol-login" class="button" value="Reset Password">

      </form>

  </div>
</div>
</div>
</div>
<!-- Sidebar Kiri --> 
<?php include 'template/footer.php'; ?>