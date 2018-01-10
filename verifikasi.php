<?php
  session_start();
  error_reporting(0);
 if (isset($_GET['email'])){
    $email =$_GET['email'];
    $_SESSION['email'] = $email;
?>
<?php include 'template/head.php'; ?>
   <div style="vertical-align: center;margin-top: 100px;" class="container container-top">
    <div class="register-wrapper" style="background: #fff; padding: 5px 10px 5px 10px; height: 15em;">
      <div class="register-form" style="background: #fff; padding: 3px">
        <div class="register-header">
          <h3 style="font-weight: bold;">Aktivasi Akun</h3><br>
        </div>
        <div class="register-Auth">
          Maaf akun kamu belum Aktif, Silahkan Verifikasi terlebih dahulu.
        </div>
        <div>
          <form action="helper/member.php?aksi=aktivasi" class="form-aktivasi" id="form-aktivasi" method="POST" >
             <input type="text" hidden="hidden" name="email" id="email" value="<?php echo $email ?>">
            <div class="verif-wrapper">
              <i style=""></i>
             
                 <input  name="kodeotp" id="kodeotp" class="header-search  required"  placeholder="Masukan Kode yg didapat" type="text">
         
              <input type="submit" class="tombol" style="width: 20%;cursor: pointer;" value="Aktivasi">
              <label for="kodeotp" generated="true" class="error"></label>
            </div>
          </form>
          <div style="text-align: center;">

            <div id="pesan" style="margin-top: 10px;">
            <?php
              if (isset($_SESSION['pesan'])){
                echo $_SESSION['pesan'];
              }else{
                echo "Silahkan Request Kode disini:";
              }
            ?>
            </div>   
            <?php
            if (isset($_SESSION['request'])){
              date_default_timezone_set('Asia/Jakarta');
              $awal  = $_SESSION['request'];
              $akhir = new DateTime(); 
              $a =$awal->format('d-m-Y : H:i:s');
              $b =$akhir->format('d-m-Y : H:i:s');
              if($a < $b){
            ?>
            <a class="button getkode" id='timer'>Request Kode</a> 
            <?php
              }else if($a > $b){
                $diff  = $awal->diff($akhir);
                  $text =  $_SESSION['nohp'];
                  $num_char = 7;
                  $a= substr($text, 0,3);
                  $b= '****';
                  $c= substr($text, -4,4);
                  $_SESSION['pesan'] = 'kode telah dikirimkan ke '.$a.$b.$c.' silakan cek inbox Anda.';
            ?>
                <script type="text/javascript">
                  $(document).ready(function() {
                        /** Membuat Waktu Mulai Hitung Mundur Dengan 
                        * var detik = 0,
                        * var menit = 1,
                        * var jam = 1
                        * var detik = <?php echo $diff->s ?>;
                        */
                        var detik = <?php echo $diff->s ?>;
                        var menit = 0;
                        var jam   = 0;
                       
                       /**
                         * Membuat function hitung() sebagai Penghitungan Waktu
                       */
                      function hitung() {
                        /** setTimout(hitung, 1000) digunakan untuk 
                          * mengulang atau merefresh halaman selama 1000 (1 detik) 
                        */
                        setTimeout(hitung,1000);
                 
                         /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                         if(menit < 10 && jam == 0){
                           var peringatan = 'style="color:red"';
                         };
               
                         /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                         $('#timer').html(
                            '' + detik + ' detik'
                          );
                         $('#pesan').html(
                            'kode telah dikirimkan ke <?php echo $a.$b.$c?>, silakan cek inbox Anda.'
                          );
                         $("#timer").attr("disabled", "disabled"); 
                 
                        /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                        detik --;
               
                        /** Jika var detik < 0
                          * var detik akan dikembalikan ke 59
                          * Menit akan Berkurang 1
                        */
                        if(detik < 0) {
                           $("#timer").removeAttr('disabled');
                           window.location.reload(1); 
                            /** Jika menit < 0
                              * Maka menit akan dikembali ke 59
                              * Jam akan Berkurang 1
                            */
                        } 
                      }           
                      /** Menjalankan Function Hitung Waktu Mundur */ 
                      hitung();
                  }); 
                    // ]]>
                </script>
                <a class="button getkode" disabled="disabled" id='timer'>Request Kode</a>     
            <?php
                }else{
            ?>
                 
            <?php
                }
            }else{
            ?>
              <a class="button getkode" id='timer'>Request Kode</a>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
include 'template/footer.php'; 
}else{
  header("Location: index.php?Gagal");
}
?>
