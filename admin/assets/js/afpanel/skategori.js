$(document).ready(function(){
// skategori.js
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


// menload semua data slug kategori
$(".af-produk-kategori-show").load('skategori_show');

$("#ipt-skat").on('submit', function(e){
	e.preventDefault();
	var skat_t = $("#ipt-skat-title").val();
	var skat_d = $("#ipt-skat-desk").val();
	var skat_kt = $(".ipt-skat-ktama").val();

	$.ajax({
			url:base_url+"af_panel/skategori_save", // url untuk passing data
			method:"POST", // metode pengiriman data
			data:{"skat_title":skat_t,
				  "skat_desk":skat_d,
				  "skat_idk":skat_kt},
			success:function(res) // jika berhasil mengirim data atau data telah passed
			{
				
				if (res != '') 
        		{
            		$(document.body).append(res);
            		$("#ipt-kat")[0].reset();
            		$(".af-produk-kategori-show").load("skategori_show"); // class = af-produk-kategori-show menload data kategori_show

        		}
				
			}

	});

});


// akhir ready function
});	