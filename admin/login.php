<?php
session_start();
error_reporting(0);
if($_SESSION['loginadmin']=="YES"){

  header('Location:../admin/index.php');
}
?>  <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Adminstrator</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link href="../assets/css/cheers-alert.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="../assets/js/cheers-alert.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="../assets/js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/jquery-migrate.js"></script>
  <script src="../assets/dist/jquery.addressPickerByGiro.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9q4LR-dTaJ8avQQ82lg8Fgjqqjt6oyhU&sensor=false&language=id"></script>
  <script async='async' src="../assets/js/jquery.leanModal.min.js"></script> 
  <link href="../assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="../assets/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="assets/js/fungsi.js"></script>
</head>
<body style="background-color: #F5F5F5;">
<?php
if($_SESSION['alert']=='logindulu'){
  ?>
  <script type='text/javascript'>
    $(document).ready( function () {
      cheers.warning({
        title: 'Akses Gagal',
        message: 'Silahkan Login',
        alert: $('select[name="alert"]').val(),
      });
    }); 
  </script>
  <?php
  unset($_SESSION['alert']);
}
?>
  <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
      <div class="register-form">
        <div class="register-header">
          Login Admin
          <hr>
        </div>

        <div>

          <form action="../helper/admin.php?aksi=login" method="POST" id="frm-login">
            <div class="form-group">
              <input class="form-control" name="username" id="username" placeholder="Masukan username" type="text">
            </div>
            <div class="form-group">
              <input class="form-control" name="pass" id="pass" placeholder="Password" type="password">
            </div>
            <input type="submit" id="tombol-login" class="button" value="MASUK">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
