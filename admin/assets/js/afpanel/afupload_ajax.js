$(document).ready(function(){
// afupload_ajax.js
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

// memunculkan form upload ketika di klik
$(".afuploader-form-close").click(function(){
	$(".af-upload-image").hide(500);
});


$("#m-sel-img").click(function(e){
	var type = $(this).attr("href");
	e.preventDefault();
	$(".af-upload-image").show(500);
	if(type == "logo")
	{
		$(".af-upload-image").load(base_url+"afuploader/af_merk_logo");
	}
	else if(type == "produk")
	{
		$(".af-upload-image").load(base_url+"afuploader/af_produk");
	}
	
});

// menutup form upload




// fungsi ready berakhir
});