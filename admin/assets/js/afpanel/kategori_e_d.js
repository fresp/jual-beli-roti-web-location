// kategori_e_d.js
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

// untuk aksi menghapus dan edit data , merk, kategori, slug kategori
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

// simpan edit kategori
$("#ipt-kate").on('submit', function(e){
	e.preventDefault();
	var idkate = $("#ipt-kate-id").val();
	var tlkate = $("#ipt-kate-title").val();
	var dkkate = $("#ipt-kate-desk").val();
	var kdkate = $("#ipt-kate-kode").val();

	$.ajax({
		url:base_url+"af_panel/kategori_update/",
		method:"POST",
		data:{"id-kate":idkate,
			  "tl-kate":tlkate,
			  "dk-kate":dkkate,
			  "kd-kate":kdkate},
		success:function(res)
		{
			$(".af-produk-kategori-show").load("kategori_show");
		}
	});
});

// batal edit kategori
$("#af-kate-batal").click(function(){

	$(".af-produk-kategori-show").load("kategori_show");

});