$(document).ready(function(){
// afupload_send_ajax.js
// Dibuat oleh kelompok Tugas E-Commerce 
// Anggota Kelompok :
// - Rizky Setiawan
// - Kirman
// - Budi
// - Fatonah
// - Taryoso
// - Ririn

// NOTE :
// JS INI TELAH DIBUAT KOMENTARNYA PER SCRIPT AGAR PENGEMBANGANNYA TIDAK SULIT
// KOMENTAR SUDAH BERISI FUNGSI DAN ELEMENT YANG DIAMBIL
// TEKNOLOGI JAVASCRIPT = AJAX | JQUERY

// manipulasi input file
$("#afuploader-ipt").change(function(){
	var filename = $("#afuploader-ipt").val();
	var replace = document.getElementById('afupload-filename');

	replace.value = filename;
});


// mengirim / parsing data gambar ke database dan folder path
$("#afuploader-form").on('submit',function(e){
	e.preventDefault();
	var afupdata = new FormData(this);

	$(".afuploader-progress-col").show();
	$.ajax({
				url:base_url+"afuploader/af_merk_upl", 
				xhr: function()
  					{
    					var xhr = new window.XMLHttpRequest();
    					//Upload progress
    					xhr.upload.addEventListener("progress", function(evt){
      					if (evt.lengthComputable) 
      					{
        				var percentComplete = evt.loaded / evt.total*100;
        				$(".afuploader-progress").css("width",percentComplete+"%");
        				console.log(percentComplete);
      					}
    				}, 4000);
    				//Download progress
    xhr.addEventListener("progress", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with download progress
        console.log(percentComplete);
      }
    }, false);
    return xhr;
  },
				method:"POST",
				data:afupdata,
				contentType:false,
				cache: false,
				processData:false,
				success:function(data)
				{
					alert("Data berhasil di upload");
					setTimeout(function() 
					{
        				$(".afuploader-progress-col").slideUp(2000);
    				}, 1000);
					
				}
			});

});

// mengirim / parsing data gambar ke database dan folder path


// untuk memasukan gambar ke dalam per merk atau select


// akhir fungsi ready
});