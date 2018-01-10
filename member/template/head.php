 <?php
 session_start();
 error_reporting(0);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Warung Modern</title>
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <script src="../assets/js/jquery-1.9.1.min.js"></script>
   <script type="text/javascript" src="../assets\js\jquery-migrate.js"></script>
   <script src="../assets/dist/jquery.addressPickerByGiro.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9q4LR-dTaJ8avQQ82lg8Fgjqqjt6oyhU&sensor=false&language=id&callback=initMap"></script>
   <script async='async' src="../assets/js/jquery.leanModal.min.js"></script> 
   <script type="text/javascript" src="js/jquery.form.min.js"></script>
   <link href="../assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
   <link href="../assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" >
   <script type="text/javascript" src="../assets/js/jquery.validate.min.js"></script>
   <script type="text/javascript" src="js/fungsi.js"></script>
   <link href="../assets/css/cheers-alert.min.css" rel="stylesheet" media="screen">
   <script type="text/javascript" src="../assets/js/cheers-alert.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../admin/assets/plugins/datatables/vendor/jquery.dataTables.min.css">
   <script type="text/javascript" language="javascript" src="../admin/assets/plugins/datatables/vendor/jquery.dataTables.min.js"></script>

   <style type="text/css">
    #content {
      display: block;
      width: 100%;
      background: #fff;
      padding: 25px 20px;
      padding-bottom: 35px;
      -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
      -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
      box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }


    .flatbtn {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      display: inline-block;
      outline: 0;
      border: 0;
      color: #f3faef;
      text-decoration: none;
      background-color: #6bb642;
      border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
      font-size: 1.2em;
      font-weight: bold;
      padding: 12px 22px 12px 22px;
      line-height: normal;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      text-transform: uppercase;
      text-shadow: 0 1px 0 rgba(0,0,0,0.3);
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      -webkit-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
      -moz-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
      box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
    }
    .flatbtn:hover {
      color: #fff;
      background-color: #73c437;
    }
    .flatbtn:active {
      -webkit-box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
      -moz-box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
      box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    /** custom login button **/
    .flatbtn-blu { 
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      display: inline-block;
      outline: 0;
      border: 0;
      color: #edf4f9;
      text-decoration: none;
      background-color: #4f94cf;
      border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
      font-size: 1.3em;
      font-weight: bold;
      padding: 12px 26px 12px 26px;
      line-height: normal;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      text-transform: uppercase;
      text-shadow: 0 1px 0 rgba(0,0,0,0.3);
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    }
    .flatbtn-blu:hover {
      color: #fff;
      background-color: #519dde;
    }
    .flatbtn-blu:active {
      -webkit-box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
      -moz-box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
      box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
    }


    /** modal window styles **/
    #lean_overlay {
      position: fixed;
      z-index:100;
      top: 0px;
      left: 0px;
      height:100%;
      width:100%;
      background: #000;
      display: none;
    }


    #loginmodal {
      width: 300px;
      padding: 15px 20px;
      background: #f3f6fa;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      border-radius: 6px;
      -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
      -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    }

  #loginform { /* no default styles */ }

  #loginform label { display: block; font-size: 1.1em; font-weight: bold; color: #7c8291; margin-bottom: 3px; }

  .modal {
    width: 300px;
    padding: 15px 20px;
    background: #f3f6fa;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
  }

.modalform { /* no default styles */ }

.modalform label { display: block; font-size: 1.1em; font-weight: bold; color: #7c8291; margin-bottom: 3px; }


.txtfield { 
  display: block;
  width: 100%;
  padding: 6px 5px;
  margin-bottom: 15px;
  font-family: 'Helvetica Neue', Helvetica, Verdana, sans-serif;
  color: #7988a3;
  font-size: 1.4em;
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
  background-color: #fff;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#edf3f9), to(#fff));
  background-image: -webkit-linear-gradient(top, #edf3f9, #fff);
  background-image: -moz-linear-gradient(top, #edf3f9, #fff);
  background-image: -ms-linear-gradient(top, #edf3f9, #fff);
  background-image: -o-linear-gradient(top, #edf3f9, #fff);
  background-image: linear-gradient(top, #edf3f9, #fff);
  border: 1px solid;
  border-color: #abbce8 #c3cae0 #b9c8ef;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
  -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.4);
  -webkit-transition: all 0.25s linear;
  -moz-transition: all 0.25s linear;
  transition: all 0.25s linear;
}

.txtfield:focus {
  outline: none;
  color: #525864;
  border-color: #84c0ee;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
  -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), 0 0 7px #96c7ec;
}
</style>
<script type="text/javascript">
  $(document).ready(function() { 
    var progressbox     = $('#progressbox');
    var progressbar     = $('#progressbar');
    var statustxt       = $('#statustxt');
    var completed       = '0%';
    var options = { 
          target:   '#output',   // target element(s) to be updated with server response 
          beforeSubmit:  beforeSubmit,  // pre-submit callback 
          uploadProgress: OnProgress,
          success:       afterSuccess,  // post-submit callback 
          resetForm: true        // reset the form after successful submit 
        }; 
        
        $('#MyUploadForm').submit(function() { 
          $(this).ajaxSubmit(options);        
          // return false to prevent standard browser submit and page navigation 
          return false; 
        });

        //when upload progresses  
        function OnProgress(event, position, total, percentComplete){
          //Progress bar
          progressbar.width(percentComplete + '%') //update progressbar percent complete
          statustxt.html(percentComplete + '%'); //update status text
          if(percentComplete>50)
          {
            statustxt.css('color','#fff'); //change status text to white after 50%
          }
        }

        //after succesful upload
        function afterSuccess(){
          $('#submit-btn').show(); //hide submit button
          $('#loading-img').hide(); //hide submit button
        }

        //function to check file size before uploading.
        function beforeSubmit(){
          //check whether browser fully supports all File API
          if (window.File && window.FileReader && window.FileList && window.Blob)
          {
            if( !$('#imageInput').val()) //check empty input filed
            {
              $("#output").html("Gambar tidak boleh kosong");
              return false
            }
            
            var fsize = $('#imageInput')[0].files[0].size; //get file size
            var ftype = $('#imageInput')[0].files[0].type; // get file type
            
            //allow only valid image file types 
            switch(ftype)
            {
              case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
              break;
              default:
              $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
              return false
            }
            
            //Allowed file size is less than 1 MB (1048576)
            if(fsize>1048576) 
            {
              $("#output").html("<b>"+bytesToSize(fsize) +"</b> Gambar terlalu besar <br/> Tolong resize gambar dengan gambar editor");
              return false
            }
            
            //Progress bar
            progressbox.show(); //show progressbar
            progressbar.width(completed); //initial value 0% of progressbar
            statustxt.html(completed); //set status text
            statustxt.css('color','#000'); //initial color of status text


            $('#submit-btn').hide(); //hide submit button
            $('#loading-img').show(); //hide submit button
            $("#output").html("");  
          }
          else
          {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            return false;
          }
        }

        //function to format bites bit.ly/19yoIPO
        function bytesToSize(bytes) {
         var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
         if (bytes == 0) return '0 Bytes';
         var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
         return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
       }
     }); 
   </script>
 </head>
 <body style="background-color: #F5F5F5;">
  <div id="navbar-main" style="display: inline-table;" class="navbar-container" >
    <div class="container" id="nav" style="padding-right: 0px;padding-left: 0px;height: 45px;">
      <div class="navbar">
        <div class="row" style="height: 30px;">
          <div class="column-6" style="text-align: left;">
            <div class="wrapper" style="display: inline-block; position: absolute;">
             <button id="hamburger-menu" class="kb-button button-1" style="font-size: 24px;margin-top: -5px;color: #fff;"> <i class="fa fa-bars"></i></button>
           </div>
           <a href="index.php">
            <img class="logo" src="../assets/img/logo.png">
          </a>
        </div>
        <div class="column-6" style="text-align: right;">
          <div class="wrapper" style="font-size: 24px;margin-top: -5px;">
            <ul class="top-right-menu">
              <?php
              if($_SESSION['login']){
                ?>

                <li>
                  <a href="member/add_product.php">
                    <i class="fa fa-camera" style="color: #fff;"></i>
                  </a>
                </li>
                <li style="margin: 0px;">
                  <button type="button" id="open-cart" class="btnnavbar" style="font-size: 24px;margin-top: -5px;">
                   <div style="display: none;" class="kb-badge">
                    <span class="cart-count-replaceable" style="position: relative;top: 1px;">0
                    </span>
                  </div>
                  <i  class="fa fa-shopping-cart" style="color: #fff;"></i>
                </button>
              </li>
              <li style="margin: 0px;">
               <button type="button" id="btntriggersearch" class="btnnavbar" style="font-size: 24px;margin-top: -5px;">
                 <div style="display: none;" class="kb-badge">
                  <span class="cart-count-replaceable" style="position: relative;top: 1px;">0
                  </span>
                </div>
                <i class="fa fa-search" style="color: #fff;"></i>
              </button>
              <script type="text/javascript">
                var button = document.getElementById('btntriggersearch');
                button.onclick = function() {
                  var div = document.getElementById('frm-cari');
                  var height = document.getElementById('navbar-main');
                  var content = document.getElementById('contents');
                  if (div.style.display !== 'none') {
                    div.style.display = 'none';
                    height.style.height = '0px';
                    content.style.margin = '0px 0px 0px 0px;';
                  }
                  else {
                    div.style.display = 'block';
                    height.style.height = '80px';
                    content.style.margin = '90px 0px 0px 0px;';
                  }
                };
              </script>
            </li>
            <?php
          }else{
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <form action="../result.php" class="navbar-search" style="margin-top: 10px;display: none;" method="POST" id="frm-cari">
    <div class="search-wrapper" id="carii" style="margin-top: -30px;margin-left: 4px;">
      <i class="cari" >
        <i class="fa fa-search" style="color: #2B838D;"></i>
      </i>
      <input  name="q" class="header-search" required="required" value="<?php if(!$cari){ echo ""; }else{ echo $cari; }?>"  placeholder="Cari Produk" type="text">
      <button class="tombol" type="submit">

       Cari
     </button>
   </div>
 </form>
</div>
</div>
</div>