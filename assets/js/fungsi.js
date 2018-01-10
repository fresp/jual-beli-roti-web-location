$(document).ready(function(e){
  $("#settingdrop").click(function(){
    $("#settingmenu").toggle("fast");
  });
});

$(document).ready(function(e){
  $("#open-query-modal").click(function(){
    $("#search-slide-container").toggle("fast");
  });
});

jQuery(document).ready(function(){
  jQuery('#open-cart').live('click', function(event) {        
    $( "#cart-slide-container" ).show("slide", {direction: "right"}, 300, function(){
      $("#overlay-body").fadeIn("fast");
    });
  });
});

$(document).ready(function() {
  $('.alpha').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z '.\\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
          return true;
        }
        else {
          e.preventDefault();
          return false;
        }
      });
});
$(document).ready(function() {
  $('#last').keypress(function (e) {
    var regex = new RegExp(/^[a-zA-Z\s]+$/);
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
      return true;
    }
    else {
      e.preventDefault();
      return false;
    }
  });
  $('#frm-dftr').validate({
    rules: {
      phone: {
        digits: true,
        minlength:11,
        maxlength:13,
        required: true,
        remote: {
          url: "helper/member.php?aksi=checkphone",
          type: "post",
          data: {
            email: function() {
              return $( "#phone" ).val();
            }
          }
        }
      }, 
      email: {
        email: true,
        required: true,
        remote: {
          url: "helper/member.php?aksi=checkmail",
          type: "post",
          data: {
            email: function() {
              return $( "#email" ).val();
            }
          }
        }
      },
      first: {
        required: true,
        minlength:4,
        lettersonly: true
      },
      last: {
        required: true,
        minlength:1,
        lettersonly: true
      },
      pass: {
        required: true,
        minlength:8
      },
      pass2: {
        equalTo: "#pass"
      }
    },
    messages: {
      first: {
        required: "Nama Depan harus diisi",
        minlength: "Nama Depan minimal 4 karakter",
        lettersonly:jQuery.format("Tolong isi hanya Huruf")

      },
      last: {
        required: "Nama Belakang harus diisi",
        minlength: "Nama Belakang minimal 1 karakter",
        lettersonly:jQuery.format("letters only mate")
      },
      phone: {
        required: "Nomer Telepon Harus diisi",
        minlength: "Nomor Telepon minimal 11 Digit",
        maxlength: "Nomor Telepon maksimal 12 Digit",
        digits : "Tolong isi hanya nomor",
        remote: jQuery.validator.format("{0}  sudah terdaftar")

      },
      email: {
        required: "Alamat email harus diisi",
        email: "Format email tidak benar",
        remote: jQuery.validator.format("{0}  sudah terdaftar")
      },
      pass: {
        required: "password Harus diisi",
        minlength: "Password minimal 8 karakter"
      },
      pass2: {
        required: "password Harus diisi",
        equalTo: "Password tidak sama"
      }
    }
  });
});


$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#frm-login').validate({
    rules: {
      email: {
        email: true,
        required: true,
        remote: {
          url: "helper/member.php?aksi=checklogin",
          type: "post",
          data: {
            email: function() {
              return $( "#email" ).val();
            }
          }
        }
      },
      pass: {
        required: true,
        remote: {
          url: "helper/member.php?aksi=checkpassword",
          type: "post",
          data: {
            pass: function() {
              return $( "#pass" ).val();
            }
          }
        }
      }
    },
    messages: {
      email: {
        required: "Alamat email harus diisi",
        email: "Format email tidak benar",
        remote: jQuery.validator.format("email tidak terdaftar")
      },
      pass: {
        required: "password Harus diisi",
        remote: jQuery.validator.format("Password Salah")
      }
    }
  });
});
$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#frm-reset').validate({
    rules: {
      email: {
        required: true,
        remote: {
          url: "helper/member.php?aksi=cekreset",
          type: "post",
          data: {
            email: function() {
              return $( "#email" ).val();
            }
          }
        }
      }
    },
    messages: {
      email: {
        required: "Kolom ini tidak boleh kosong",
        remote: jQuery.validator.format("email tidak terdaftar")
      }
    }
  });
});

$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#form-aktivasi').validate({
    rules: {
      kodeotp: {
        required: true,
        remote: {
          url: "helper/member.php?aksi=checkotp",
          type: "post",
          data: {
            kodeotp: function() {
              return $( "#kodeotp" ).val();
            }
          }
        }
      }
    },
    messages: {
      kodeotp: {
        required: "Kode Verifikasi harus diisi",
        remote: jQuery.validator.format("Kode Verifikasi salah")
      }
    }
  });
});
$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z1-9'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#frm-buka').validate({
    rules: {
      namatoko: {
        required: true,
        minlength:5

      },
      user: {
        lettersonly: true,
        required: true,
        remote: {
          url: "../helper/lapak.php?aksi=cekseller",
          type: "post",
          data: {
            user: function() {
              return $( "#user" ).val();
            }
          }
        }

      }
    },
    messages: {
      namatoko: {
        required: "Nama Toko harus diisi",
        minlength: "Nama Toko minimal 5 karakter",
      },
      user: {
        required: "Username harus diisi", 
        minlength: "Username minimal 5 karakter",
        lettersonly:jQuery.format("jangan menggunakan spasi & spesial karakter"),
        remote: jQuery.validator.format("Username {0} sudah terdaftar")

      }
    }
  });
});

$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z1-9'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#frm-editmem').validate({
    rules: {
      memfirst: {
        required: true,
        minlength:5

      },
      memlast: {
        required: true,
        minlength:5

      },

      phone: {
        digits: true,
        minlength:11,
        maxlength:13,
        required: true,
        remote: {
          url: "../helper/member.php?aksi=checkphone",
          type: "post",
          data: {
            phone: function() {
              return $( "#phone" ).val();
            }
          }
        }
      }

    },
    messages: {
      memfirst: {
        required: "Nama Depan harus diisi",
        minlength: "Nama Depan minimal 5 karakter",
      },
      memlast: {
        required: "Nama belakang harus diisi",
        minlength: "Nama belakang minimal 5 karakter",
      },
      phone: {
        required: "Nomer Telepon Harus diisi",
        minlength: "Nomor Telepon minimal 11 Digit",
        maxlength: "Nomor Telepon maksimal 12 Digit",
        digits : "Tolong isi hanya nomor",
        remote: jQuery.validator.format("{0}  sudah terdaftar")
      }
    }
  });
});


$.validator.addMethod(
  "indonesianDate",
  function(value, element) {
        // put your own logic here, this is just a (crappy) example
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
      },
      "Please enter a date in the format DD/MM/YYYY"
      );


$(document).ready(function() {
      //jika showmore post diklik
      $('.load_more').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "helper/lapak.php?aksi=getdata", //proses ke file php
            data: "idakhir="+ id_terakhir,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
$(document).ready(function() {
      //jika showmore post diklik
      $('.load_cari').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_cari = $(this).attr("name");
        var id_terakhir = $(this).attr("id");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "../helper/produk.php?aksi=getcari", //proses ke file php
            data: "idakhir="+ id_terakhir+"&idcari="+id_cari,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
$(document).ready(function() {
      //jika showmore post diklik
      $('.load_produk').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        var id_lapak = $(this).attr("name");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "helper/produk.php?aksi=getdata", //proses ke file php
            data: "idakhir="+ id_terakhir+"&idlapak="+id_lapak,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
$(document).ready(function() {
      //jika showmore post diklik
      $('.load_barang').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        var id_lapak = $(this).attr("name");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "../helper/produk.php?aksi=getdatabarang", //proses ke file php
            data: "idakhir="+ id_terakhir+"&idlapak="+id_lapak,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
$(document).ready(function() {
      //jika showmore post diklik
      $('.load_kategori').live("click",function() {
        //buat variabel id_terakhir dari id milik load_more
        var id_terakhir = $(this).attr("id");
        var id_lapak = $(this).attr("name");
        //Jika id_terakhir tidak sama dengan end
        if(id_terakhir!='end'){//lakukan request ajax
          $.ajax({
            type: "POST",
            url: "../helper/produk.php?aksi=getdatakat", //proses ke file php
            data: "idakhir="+ id_terakhir+"&idkategori="+id_lapak,
            beforeSend: function() {
              $('a.load_more').append('<img src="assets/img/facebook_style_loader.gif" />');
            },
            success: function(html){
              $(".facebook_style").remove(); //hilangkan div dengan class name facebook style
              $("ul#updates").append(html); //memberikan respon ke ol#updates
            }
          });
        }
        
        return false;
      });
    });
$(document).ready(function(){
  $(".tombol-simpan").live("click",function(){
    var data = $('.form-user').serialize();
    $.ajax({
      type: 'POST',
      url: "module/sessionlokasi.php",
      data: data,
      success: function() {
        $('.feed').load('helper/lapak.php?aksi=ulload');
        $('#modaltrigger').load("module/datalokasi.php");
        $('#listcart').load('helper/produk.php?aksi=listcart');
      }
    });
  });
});
$(document).ready(function(){
  $(".tombol-lapak").live("click",function(){
    var data = $('.form-user').serialize();
    $.ajax({
      type: 'POST',
      url: "../helper/lapak.php?aksi=updatelokasi",
      data: data,
      success: function() {
        $('#lapaklokasi').load("../module/lokasilapak.php");
      }
    });
  });
});

$(document).ready(function(){
  $("#timer").live("click",function(){
    var data = $('.form-aktivasi').serialize();
    $.ajax({
      type: 'POST',
      url: "helper/member.php?aksi=requestkode",
      data: data,
      success: function() {
        window.location.reload(1);
      }
    });
  });
});

$(document).ready(function(){
  $("#del").live("click",function(){
    var idc = $(this).attr("name");
    var data = $('#frm-cart'+idc).serialize();
    $.ajax({
      type: 'POST',
      url: "helper/produk.php?aksi=cartdel",
      data: data,
      success: function() {
       $('#listcart').load('helper/produk.php?aksi=listcart');
     }
   });
  });
});

$(document).ready(function(){
  $("#update").live("click",function(){
    var idc = $(this).attr("name");
    var data = $('#frm-cart'+idc).serialize();
    $.ajax({
      type: 'POST',
      url: "helper/produk.php?aksi=cartupdate",
      data: data,
      success: function() {
       $('#listcart').load('helper/produk.php?aksi=listcart');
     }
   });
  });
});