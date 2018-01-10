$(document).ready(function(){
// merk.js
// Dibuat oleh kelompok Tugas E-Commerce 
// Anggota Kelompok :
// - Rizky Setiawan
// - Kirman
// - Budi
// - Fatonah
// - Taryoso
// - Rini

// NOTE :
// JS INI TELAH DIBUAT KOMENTARNYA PER SCRIPT AGAR PENGEMBANGANNYA TIDAK SULIT
// KOMENTAR SUDAH BERISI FUNGSI DAN ELEMENT YANG DIAMBIL
// TEKNOLOGI JAVASCRIPT = AJAX | JQUERY

// class = af-produk-kategori-shpw menload data kategori_Show
$(".af-produk-kategori-show").load("merk_show"); // class = af-produk-kategori-show menload data kategori_show
$(".m-logo-show").css("display","none");

$(".alert-success").click(function(){
	$(".alert-success").hide(1000);
});

$(".alert-danger").click(function(){
	$(".alert-danger").hide(1000);
});
// proses input data kategori produk baru
$("#ipt-merk").on('submit', function(e){
	e.preventDefault();// agar ketika submit tidak melanjutkan aksi submit html
	var af_merk_title = $("#ipt-m-title").val();// mengambil value dari input id = ipt-m-title
	var af_merk_desk = $("#ipt-m-desk").val();// mengambil value dari input id = ipt-m-desk
	var af_merk_kode = $("#ipt-m-kode").val();// mengambil value dari input id= ipt-m-kode
	var af_merk_img = $("#ipt-m-url").val();
	 if($("#ipt-m-url").val()=="")
  	{
    alert("Pilih gamabar logo dahulu")
  	}
  else
  {
	$.ajax({
			url:base_url+"af_panel/merk_save", // url untuk passing data
			method:"POST", // metode pengiriman data
			data:{"merk_title":af_merk_title,
				  "merk_desk":af_merk_desk,
				  "merk_kode":af_merk_kode,
				  "merk_img":af_merk_img},
			success:function(res) // jika berhasil mengirim data atau data telah passed
			{
				
				if (res != '') 
        		{
            		$(document.body).append(res);
            		$("#ipt-merk")[0].reset();
            		$(".m-logo-show").css("display","none");
            		$("a#m-sel-img").html("Pilih logo merk");
            		$(".af-produk-kategori-show").load("merk_show"); // class = af-produk-kategori-show menload data kategori_show

        		}
				
			}
		});
	}
});


// function ready berakhir
});