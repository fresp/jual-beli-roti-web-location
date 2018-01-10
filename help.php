<?php 
include 'member/template/headaccess.php';
?>
<div style="margin-top: 90px;" class="container container-top" id="contents">
  <div id="newest-welcome-list">
    <div class="feed" id="feed" style="padding : 2px 10px; background: #fff">
      <?php 
      if($_GET['tag']=="bagaimana-membeli"){
        ?>
        <h2>CARA BELANJA</h2>
        <hr>
        <h2 class="lead">1. Pilih Produk</h2>
        <p>Warung Modern.com menghadirkan ribuan produk dari banyak penjual. Untuk memudahkan Anda berbelanja, silakan simak tiga pilihan cara memilih produk berikut:</p>
        <ol class="default">
          <li>Daftar/Login terlebih dahulu</li>
          <li>Tentukan Lokasi pengiriman</li>
          <li>Cari produk berdasarkan penjual tertentu yang berada dilokasi sekitar kamu</li>
          <li>Ketikkan kata kunci pencarian di search bar yang telah disediakan. Anda bebas mengetikkan apa saja yang ingin Anda cari pada kolom tersebut. Warung Modern.com menggunakan teknologi <em>advanced search</em> yang akhirnya dapat meningkatkan kepuasan Anda terhadap hasil search yang diberikan.</li>


        </ol>
        <h2 class="lead">2. Beli Produk</h2>
        <p>Setelah Anda menemukan dan menentukan produk yang Anda inginkan, lanjutkan dengan membeli Produk.</p>
        <ol class="default">
          <li>Klik icon Keranjang Belanja pada tiap foto produk atau klik tombol "BELI" di halaman deskripsi produk untuk menambahkan produk pada keranjang belanja, lalu pilih tombol ‘Keranjang Belanja’ untuk melihat isi keranjang belanja Anda.</li> 
          <li>Di halaman "Keranjang Belanja”, cek produk dan jumlah pesanan, lalu klik tombol "BAYAR".</li>
          <li>Jika isi keranjang belanja dirasa masih belum pas atau sesuai keinginan Anda, Anda dapat menambahkan atau mengurangi jumlah produk yang dipesan. Jika setelah diperbarui sudah dirasa pas atau sesuai keinginan, lalu klik tombol "BAYAR".</li>
        </ol>
        <h2 class="lead">3. Konfirmasi Pembelian</h2>
        <ol class="default">
          <li>Masukan Nama penerima,Nomor Telp, Alamat</li>
          <li>Klik Tinggalkan Pesan Jika Kamu ingin meninggalkan pesan kepada penjual</li>
          <li>Pilih Metode Pembayaran, lalu klik tombol "BAYAR"</li>
          <li>Pantau Handphone Anda. Kami akan mengirimkan Rincian Pembayaran ke nomer Anda melalui sms.</li>
        </ol>
        <h2 class="lead">4. Pemesanan Selesai</h2>
        <p>Selamat, transaksi Anda di warungmodern.com sudah selesai! Berikut adalah beberapa hal yang wajib dibaca:</p>
        <ol class="default">
          <li>Catat ID Kode Transaksi yang muncul, ini adalah order ID dan sangat penting disimpan agar dapat menjadi referensi di kemudian waktu. Anda juga dapat melihat order ID atau Kode Transaksi ini pada sms yg kami kirimkan atau pada halaman akun Anda (Daftar Pemesanan).</li>
          <li>Khusus pembayaran melalui Transfer Bank dan sudah melakukan pembayaran tapi status pesanan masih "Menunggu Pembayaran" mohon segera lakukan konfirmasi pembayaran melalui menu "<a href="/konfirmasi">KONFIRMASI PEMBAYARAN</a>" .</li>
          <li>Anda dapat melacak status pengiriman pesanan Anda melalui halaman <a href="/member/transactions.php?list=buy">Daftar Pemesanan</a></li>
        </ol>
        <p><br><br></p>

        <?php
      }elseif($_GET['tag']=="bagaimana-menjual"){
        ?>
        <h2>CARA BERJUALAN</h2>
        <hr>
        <h2 class="lead">1. Daftar Menjadi Penjual</h2>
        <p>Warung Modern.com Menghadirkan Transaksi C2C yang berarti transaksi dari member ke member, Silahkan Mendaftar Menjadi Penjual</p>
        <ol class="default">
          <li>Daftar/Login terlebih dahulu</li>
          <li>Klik 3dots sebelah kiri dan pilih  Daftar Menjadi Penjual </li>
          <li>Langkah 1 Masukan username, Nama Toko, Jam aktif dan klik Next</li>
          <li>Langkah 2 Tentukan Lokasi Kamu klik Next</li>
          <li>Langkah 3 Upload Foto Toko Klik Upload</li>
          <li>Selamat Toko Kamu berhasil dibuka</li>
        </ol>
        <h2 class="lead">2. Upload Produk</h2>
        <p>Setelah akun penjual anda berhasil dibuat, silahkan mengupload produk anda</p>
        <ol class="default">
          <li>Klik icon Kamera di header</li> 
          <li>Upload Gambar Produk Kamu</li>
          <li>Masukan Nama Produk, Harga, Deskripsi, pilih kategori produk dan klik next</li>
          <li>Selamat Produk kamu berhasil diupload dan menunggu review dari warungmodern.com</li>
        </ol>
        
        <p><br><br></p>

        <?php
      }elseif($_GET['tag']=="tarik-saldo"){
        ?>
        <h2>Tarik Saldo</h2>
        <hr>

        <p>Warung Modern.com Menghadirkan Transaksi VIA transfer Bank Dengan Perantara Warungmodern sebagai fasilitas antar penjual dan pembeli, Setelah Transaksi Selesai Maka Saldo akan masuk ke Akun yang berhak, Dan Berikut Cara Menarik Saldo :</p>
        <ol class="default">
          <li>Masuk Ke Halaman Member</li>
          <li>Klik Tombol Lihat di Bagian Menu Saldo </li>
          <li>Di halaman Saldo Akan berisi rincian saldo kamu</li>
          <li>Dan Jika Ingin Melakukan Penarikan Saldo, Silahkan Klik Lihat Penarikan</li>
          <li>Nah akan Tampil Halaman Tarik Saldo, Silahkan Masukan Informasi Bank Tujuan, Nama pemegang Bank, Norekening Dan Jumlah Saldo</li>
          <li>Silahkan Klik Simpan</li>
          <li>Selamat Permohonan Tarik Saldo Selesai, Dan menunggu diProses oleh admin</li>
        </ol>
       

        <?php
      }else{
        ?>
        <ul class="product-list"  id="updates">
          <li class="list-content">
            <a href="help/bagaimana-membeli">
              <div class="caption product-name">
                Bagaimana Membeli
              </div>  
            </a>
          </li>
          <li class="list-content">
            <a href="help/bagaimana-menjual">
              <div class="caption product-name">
                Bagaimana menjual
              </div>
            </a>
          </li>
          <li class="list-content">
            <a href="help/tarik-saldo">
              <div class="caption product-name">
                Tarik Saldo
              </div>
            </a>
          </li>
        </ul>
        <?php 
      }
      ?>
    </div>
  </div>
</div>
<?php 
include 'member/template/footeraccess.php';
unset($_SESSION['alert']);
?> 