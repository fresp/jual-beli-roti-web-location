
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
              <li style="">
                <a href="#">
                  <i class="fa fa-bell" style="color: #fff;"></i>
                </a>
              </li>
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
        </ul>
      </div>
    </div>
  </div>
  <form action="../result.php" class="navbar-search" style="margin-top: 10px;display: none;" method="POST" id="frm-cari">
    <div class="search-wrapper" id="carii" style="margin-top: -30px;margin-left: 4px;">
      <i class="cari" >
        <i class="fa fa-search" style="color: #2B838D;"></i>
      </i>
      <input  name="q" class="header-search" required="required" value=""  placeholder="Cari Produk" type="text">
      <button class="tombol" type="submit">

       Cari
     </button>
   </div>
 </form>
</div>
</div>
</div>  <div style="margin-top: 90px;" class="container container-top" style="margin-top: 30px;background: #fff;padding: 10px;">
<div id="upload-wrapper">
  <form action="../helper/produk.php?aksi=uploadproduct" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
    <div class="form-group">
      <label >Foto Produk :</label>
      <div class="verif-wrapper">
        <i style=""></i>
        <input type="hidden" name="proid" value="">
        <input  name="ImageFile" class="header-search" id="imageInput" type="file">
        <input type="submit" class="tombol" value="upload">
      </div>
    </div>
    <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
  </form>
</div>
<div id="output" >
   <table  width="100%" border="0" cellpadding="4" cellspacing="0">
    <tr>
      <td align="center">
        <img style="border: 0px">
      </td>
    </tr>
  </table> 
  </div>
  <form id="imageform" style="height: 380px;" action="../helper/produk.php?aksi=saveproduks" method="POST" enctype="multipart/form-data">

  <div style=" text-align: left; padding: 0px 5px;">
    <div>
      <input type="text" class="kb-input" hidden="hidden" name="pro_image" style="" value="15585201_1717425178283699_96219660996607684_o-frezanugraha-693452.jpg" >
      <div class="row" style="margin-bottom: 10px;">
        <div class="column-12">
          <div>
            <label >Kategori Produk :</label>
            <div class="">
              <select class="kb-input" name="ctrg_id">
                <option value="1">Kue Tradisional</option>
                <option value="2">Roti Tawar</option>
                <option value="3">Roti Manis</option>
                <option value="4">Donat</option>
                <option value="5">Cake</option>
                <option value="6">Tart</option>
                <option value="7">Keringan</option>
                <option value="8">Lain lain</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <div class="column-12">
          <label >Nama Produk :</label>
          <input type="text" class="kb-input required" name="pro_name" id="pro_name"  value="" placeholder="Nama Produk">
        </div>
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <div class="column-12">
          <label >Harga Produk :</label>
          <input type="number" class="kb-input required required" 
          value="" name="pro_saleprice" id="pro_saleprice" placeholder="Harga">
        </div>
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <div class="column-12">
          <label >Deskripsi Produk :</label>
          <textarea class="kb-textarea required" name="pro_description" id="pro_description" style="width: 96%;height: 7em;" placeholder="Deskripsi Produk"></textarea>
        </div>
      </div>


      <div class="row" style="margin-bottom: 10px;">
        <div class="column-12">

          <input type="submit" name="submit" class="kb-button  button-float kb-button2" style="width: 100%;" value="Posting">
        </div>
      </div>
    </div>
  </div>
</form>   



</div>
<!-- Sidebar Kiri --> 
<div id="overlay-body" style="display: none;"></div>
<div id="app-menu" style="display: none;" class="side-menu-main-wrapper">
  <div class="side-menu-wrapper">
    <div class="section" style="padding: 0px;">
      <div class="bg-header">
        <div class="bg-header-content-box">
          <button id="close-menu" type="button" class="kb-button">

            <i style="color: #2B838D;" class="fa  fa-close "></i>
          </button>
          <img class="user-photo" style="margin-left: 100px;" src="../assets/img/default-dp.png">
          <div class="user-fullname" >
            Freza Nugraha  <a href="../helper/member.php?aksi=logout" style="background: #ff9000;padding: 3px;color: #fff;">Keluar</a>                
          </div>
          <div class="user-saldo" >
            Saldo Rp. 
            0             
          </div>  

        </div>
      </div>
    </div>
    <div class="section">
      <ul>
        <li>
          <a href="index.php"><i class="fa fa-home"></i>  Dashboard</a>
        </li>

        <li class="special-dropdown">
          <div class="row">
            <div class="column-12" style="padding :0px">
              <div class="column-1">
                <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-th"></i></a>
              </div>
              <div class="column-10">

                <button type="button" id="sidekat" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
                  <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Kategori</a></span>
                </button>
              </div>
              <div class="column-1" style="margin: 5px 0px 0px -40px;">
                <i id="sidetooglekat" class="fa fa-angle-left"></i>
              </div>
            </div>
          </div>
          <div id="katmenu" style="display: none;">
            <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Kue-Tradisional" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Kue Tradisional</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Roti-Tawar" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Roti Tawar</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Roti-Manis" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Roti Manis</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Donat" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Donat</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Cake" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Cake</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Tart" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Tart</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Keringan" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Keringan</span><br>
               </div>
             </a>
           </div>
           <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
             <div class="column-1">
             </div>
             <a href="../kategori/Lain-lain" style="width: 100%;padding-left: 27px;">
               <div class="column-10"><span style="">Lain lain</span><br>
               </div>
             </a>
           </div>

         </div>  
       </li>
       <li class="special-dropdown">
        <div class="row">
          <div class="column-1">
            <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-tags"></i></a>
          </div>
          <div class="column-10">

            <button type="button" id="sidebuy" class="btnnavbar" style="text-align: left;margin-top: -4px;height: 31px;">
              <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Pembelian</a></span>
            </button>
          </div>
          <div class="column-1" style="margin: 5px 0px 0px -40px;">
            <i id="sidetooglebuy" class="fa fa-angle-left"></i>
          </div>
        </div>
        <div id="buymenu" style="display: none;">
          <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
            <div class="column-1">
            </div>
            <a href="?aksi=hayoooo" style="width: 100%;padding-left: 27px;">
              <div class="column-10"><span style="">Daftar Pemesanan</span><br>
              </div>
            </a>
          </div>
          <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
            <div class="column-1">
            </div>
            <a href="?aksi=hayoooo" style="width: 100%;padding-left: 27px;">
              <div class="column-10"><span style="">Transaksi dibatalkan</span><br>
              </div>
            </a>
          </div>


        </div>  
      </li>
    </ul>
  </div>


  <div class="section">
   <ul>
     <li class="special-dropdown">
      <div class="row">
       <div class="column-1">
        <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-bar-chart"></i></a>
      </div>
      <div class="column-10">

        <button type="button" id="sidechart" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
         <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Penjualan</a></span>
       </button>
     </div>
     <div class="column-1" style="margin: 5px 0px 0px -40px;">
      <i id="sidetooglechart" class="fa fa-angle-left"></i>
    </div>
  </div>
  <div id="chartmenu" style="display: none;">
   <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
    <div class="column-1">
    </div>
    <a href="?aksi=hayoooo" style="width: 100%;padding-left: 27px;">
     <div class="column-10"><span style="">Daftar Penjualan</span><br>
     </div>
   </a>
 </div>
 <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
  <div class="column-1">
  </div>
  <a href="produk.php" style="width: 100%;padding-left: 27px;">
   <div class="column-10"><span style="">Daftar Produk</span><br>
   </div>
 </a>
</div>

</div>  
</li>
</ul>
</div>
<div class="section">
  <ul>
    <li class="special-dropdown">
      <div class="row">
        <div class="column-1">
          <a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-gear"></i></a>
        </div>
        <div class="column-10">

          <button type="button" id="sidesetting" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
            <span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Pengaturan</a></span>
          </button>
        </div>
        <div class="column-1" style="margin-left: -40px;">
          <i id="sidetoogleset" class="fa fa-angle-left"></i>
        </div>
      </div>
      <div id="settingmenu" style="display: none;">
        <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
          <div class="column-1">
          </div>
          <a href="edit_akun.php" style="width: 100%;padding-left: 27px;">
            <div class="column-10"><span style="">Akun saya</span><br>
            </div>
          </a>
        </div>
        <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
          <div class="column-1">
          </div>
          <a href="edit_pass.php" style="width: 100%;padding-left: 27px;">
            <div class="column-10"><span style="">Password Saya</span><br>
            </div>
          </a>
        </div>
        <div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
          <div class="column-1">
          </div>
          <a href="edit_toko.php" style="width: 100%;padding-left: 27px;">
            <div class="column-10"><span style="">Toko Saya</span><br>
            </div>
          </a>
        </div>
      </div>    
    </li>
  </ul>
</div>

<div class="section" >
  <ul>
   <li>
     <a href="#"><i class="fa fa-building-o"></i> Tentang Kami</a>
   </li>
   <li>
     <a href="#"><i class="fa fa-book"></i> Bagaimana Membeli</a>
   </li>
   <li>
     <a href="#"><i class="fa fa-book"></i> Bagaimana Menjual</a>
   </li>
   <li>
     <a href="#"><i class="fa fa-credit-card"></i> Cara Pembayaran</a>
   </li>
   <li>
     <a href="#"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
   </li>
 </ul>
</div>
</div>
<footer style="border-top: 2px solid #d2d2d2;box-shadow: 2px 0 0 rgba(0, 0, 0, .13);width: 100%;padding: 7px;background: #fff;overflow: auto;">
  <div class="column-6" style="text-align: left;">
    Toko Kamu <br>
    <p style="margin-top: 0px;font-size: 16px;font-weight: bold;">frezanugraha</p>
  </div>
  <div class="column-6">
   <a class="btn-pesan" href="../frezanugraha">Lihat</a>
 </div>
</footer>
</div>
<div id="cart-slide-container" style="display: none;" class="slide-modal-container">
  <div class="slide-modal-header" style="padding: 0px;margin-bottom: 0px;">
    <div class="search-textbox">
      <div class="column-2">
        <button id="close-cart" class="kb-button button-1 left-menu" style="color: #7ac144;   background: transparent; position: relative; left: 9px;">
          <i class="fa fa-2x fa-close">  </i>
        </button>
        <script type="text/javascript">
          $("#close-cart").click(function() {
            $("#cart-slide-container").hide("slide", {
              direction: "right"
            }, 300, function() {
              $("#overlay-body").fadeOut("fast");
            });
          });
        </script>
      </div>
      <div class="column-10">
        <div class="navbar-search">

         <h3 style="padding: 5px 0px 0px 0px;margin: 0px;">KERANJANG BELANJA</h3>
       </div>
     </div>

   </div>
 </div>
 <div id="listcart" style="height: 93% ;">


  <div class="search-content" style=" height: 86%; overflow-y: scroll;">	
   <p style="padding-top: 250px;font-weight: bold;">Belum ada barang di keranjang belanja kamu </p>
 </div>

</div>
</div>
<script type="text/javascript">
  var button = document.getElementById('sidesetting');
  button.onclick = function() {
    var div = document.getElementById('settingmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetoogleset").removeClass("fa fa-angle-down");
      $("#sidetoogleset").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetoogleset").removeClass("fa fa-angle-left");
      $("#sidetoogleset").addClass("fa fa-angle-down");
    }
  };
  var button = document.getElementById('sidekat');
  button.onclick = function() {
    var div = document.getElementById('katmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglekat").removeClass("fa fa-angle-down");
      $("#sidetooglekat").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglekat").removeClass("fa fa-angle-left");
      $("#sidetooglekat").addClass("fa fa-angle-down");
    }
  };
  var button = document.getElementById('sidebuy');
  button.onclick = function() {
    var div = document.getElementById('buymenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglebuy").removeClass("fa fa-angle-down");
      $("#sidetooglebuy").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglebuy").removeClass("fa fa-angle-left");
      $("#sidetooglebuy").addClass("fa fa-angle-down");
    }
  };  
  var button = document.getElementById('sidechart');
  button.onclick = function() {
    var div = document.getElementById('chartmenu');
    if (div.style.display !== 'none') {
      div.style.display = 'none';
      $("#sidetooglechart").removeClass("fa fa-angle-down");
      $("#sidetooglechart").addClass("fa fa-angle-left");
    }
    else {
      div.style.display = 'block';
      $("#sidetooglechart").removeClass("fa fa-angle-left");
      $("#sidetooglechart").addClass("fa fa-angle-down");
    }
  };
</script>
<script src="../assets/js/kb-helper.js"></script>
<script src="../assets/js/jquery-ui.js"></script>
<script src="../assets/js/jquery.lazyload.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>