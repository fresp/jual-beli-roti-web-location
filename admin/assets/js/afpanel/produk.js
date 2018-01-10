$(document).ready(function(){
// Produk.js
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


// ini untuk menu data input produk
$("#ndp").css("background","#9C27B0");

$(".menu-nav li").click(function(){
  var cval = $(this).attr("id")
  if(cval == "ndp")
  {
    $("#ndp").css("background","#9C27B0");
    $("#mjp").css("background","#3F51B5");
    $("#gp").css("background","#3F51B5");
    $(".af-produk-info-desc-hold").css("display","block");
    $(".af-produk-content-ipt").css("display","none");
  } else if (cval == "mjp")
          {
            $("#ndp").css("background","#3F51B5");
            $("#mjp").css("background","#9C27B0");
            $("#gp").css("background","#3F51B5");
            $(".af-produk-info-desc-hold").css("display","none");
            $(".af-produk-content-ipt").css("display","block");
          } else if (cval == "gp") 
                  {
                    $("#ndp").css("background","#3F51B5");
                    $("#mjp").css("background","#3F51B5");
                    $("#gp").css("background","#9C27B0");
                    $(".af-produk-info-desc-hold").css("display","none");
                    $(".af-produk-content-ipt").css("display","none");
                  }
});


// JS untuk kode produk otomatis dimulai
// ini untuk data label / merk produk
$("#label").change(function(){ // fungsi jika id = label berubah nilainya

		$("#labelb").show(300);
  
		var label = $("#label").val(); // mengambil variabel dengan id = label
		var labels = $("#labelb").val(); // mengambil bariabel dengan id = labelb
		var code = document.getElementById('code'); // mengambil element input dengan id = code
		var fcode = document.getElementById('fcode'); // mengambil element input dengan id = fcode
	
    // mengirim data untuk mengambil kode
		$.ajax({
         type: "POST", // method pengiriman data POST
         url: base_url + "af_panel/num/"+label+labels, // mengirim request kode dengan parameter value dari variable = label dan labels
         dataType: "text", // tipe data yang dikirimkan TEXT
         cache:false, // Cache false
         success: // jika request berhasil
              function(data){
                code.value = data;
                fcode.value = label+labels; 
              }
          });
	});
// ini untuk data per jenis produk
$("#labelb").change(function(){ // fungsi jika id = labelb berubah nilainya
		var label = $("#label").val(); // mengambil variabel dengan id = label
		var labels = $("#labelb").val(); // mengambil variabel dengan id = labelb
		var code = document.getElementById('code'); // mengambil element input dengan id = code
		var fcode = document.getElementById('fcode'); // mengambil element input dengan id = fcode


    // mengirim data untuk mengambil kode
		$.ajax({
         type: "POST", // method pengiriman data POST
         url: base_url + "af_panel/num/"+label+labels, // mengirim request kode dengan parameter value dari variable = label dan labels
         dataType: "text", // tipe data yang dikirimkan TEXT
         cache:false, // Cache false
         success: // jika request berhasil
              function(data){
                code.value = data;
                fcode.value = label+labels;
              }
          });

    $.ajax({
          type: "POST", // method pengiriman data POST
          url: base_url + "af_panel/hook_skat/", // mengirim request kode dengan parameter value dari variable = label dan labels
          dataType: "text", // tipe data yang dikirimkan TEXT
          data:{'data':labels},
          cache:false, // Cache false
          success: // jika request berhasil
              function(data){
                $("#labelc").html(data);
                $("#labelc").show(300);
              }
          });

   
	});
// JS untuk kode produk otomatis berakhir

// data produk input

$("#ipt-produk").on('submit', function(e){
  e.preventDefault();
  var ptitle = $("#title").val();
  var pdesk = $("#anct").summernote('code');
  var pjml = $("#jml").val();
  var phg = $("#harga").val();
  var puimg = $("#ipt-m-url").val();
  var plabel = $("#label").val();
  var plabelb = $("#labelb").val();
  var plabelc = $("#labelc").val();
  var pkode = $("#code").val();
  var pfkode = $("#fcode").val();
  var pweight = $("#weight").val();

  if(ptitle =='')
  {
    alert('Judul atau nama produk masih kosong');
  }
  else if(pdesk =='<p><br></p>')
  {
    alert('Deskripsi produk masih kosong')
  }
  else if(pjml =='')
  {
    alert('Jumlah produk masih kosong');
  }
  else if(phg =='')
  {
    alert('Harga produk masih kosong');
  }
  else if(puimg =='')
  {
    alert('Gambar produk masih kosong');
  }
  else if(pweight =='')
  {
    alert('Berat produk masih kosong');
  }
  else if(plabel =='')
  {
    alert('Silahkan pilih merk produk');
  }
  else if(plabelb =='')
  {
    alert('Silahkan pilih kategori produk');
  }
  else if(plabelc =='')
  {
    alert('Silahkan pilih jenis produk');
  }
  else
  {
    $.ajax({
    type: "POST",
    url: base_url+"af_panel/produk_save",
    dataType: "text",
    data: {"af_ipt_name":ptitle,
           "textb":pdesk,
           "af_ipt_harga":phg,
           "af_ipt_jumlah":pjml,
           "af_ipt_uimg":puimg,
           "af_ipt_label":plabel,
           "af_ipt_labelb":plabelb,
           "af_ipt_labelc":plabelc,
           "af_ipt_kode":pkode,
           "af_ipt_fkode":pfkode,
           "af_ipt_weight":pweight
          },
    success: function(data){
      alert("data berhasil di input");
      window.location.replace(base_url+'af_panel/produk');
    }
  });
  }
});

// untuk menampilkan editor dan mengatur editor
$("#anct").summernote({ // mengambil editor
  height: 300,
  maxheight:300
});


});