$(document).ready(function(){
// kategori.js
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


// menload semua data kategori
$(".af-produk-kategori-show").load('kategori_show');


// mengirim data input method dengan ajax
$(".alert-success").click(function(){
	$(".alert-success").hide(1000);
});

$(".alert-danger").click(function(){
	$(".alert-danger").hide(1000);
});

$("#ipt-kat").on('submit', function(e){
	e.preventDefault();// agar ketika submit tidak melanjutkan aksi submit html
	var af_kat_title = $("#ipt-kat-title").val();// mengambil value dari input id = ipt-m-title
	var af_kat_desk = $("#ipt-kat-desk").val();// mengambil value dari input id = ipt-m-desk
	var af_kat_kode = $("#ipt-kat-kode").val();// mengambil value dari input id= ipt-m-kode
	$.ajax({
			url:base_url+"af_panel/kategori_save", // url untuk passing data
			method:"POST", // metode pengiriman data
			data:{"kat_title":af_kat_title,
				  "kat_desk":af_kat_desk,
				  "kat_kode":af_kat_kode},
			success:function(res) // jika berhasil mengirim data atau data telah passed
			{
				
				if (res != '') 
        		{
            		$(document.body).append(res);
            		$("#ipt-kat")[0].reset();
            		$(".af-produk-kategori-show").load("kategori_show"); // class = af-produk-kategori-show menload data kategori_show

        		}
				
			}
		});
	
});


// edit dan hapus data kategori
$("a#af-del").click(function(){
	var idKat = $(this).attr("href");
	
	$.ajax({
		url:base_url+"af_panel/kategori_delete",
		method:"POST",
		data:{"id-kat":idKat},
		success:function(res)
		{
			$(".af-produk-kategori-show").load("kategori_show");
		}
	});
	return false;
});


$("a#af-edit").click(function(){
	var idKat = $(this).attr("href");
	
	$.ajax({
		url:base_url+"af_panel/kategori_edit",
		method:"POST",
		data:{"id-kat":idKat},
		success:function(res)
		{
			$(".af-produk-kategori-show").html(res);
		}
	});
	return false;
});



// akhir ready function
});