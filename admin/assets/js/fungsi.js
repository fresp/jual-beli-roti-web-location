$(document).ready(function() {
  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z'.\\s]+$/i.test(value);
  }, "Only alphabetical characters");
  $('#frm-login').validate({
    rules: {
      username: {
        required: true,
        remote: {
          url: "../helper/admin.php?aksi=checklogin",
          type: "post",
          data: {
            username: function() {
              return $( "#username" ).val();
            }
          }
        }
      },
      pass: {
        required: true,
        remote: {
          url: "../helper/admin.php?aksi=checkpassword",
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
      username: {
        required: "username harus diisi",
        remote: jQuery.validator.format("email tidak terdaftar")
      },
      pass: {
        required: "password Harus diisi",
        remote: jQuery.validator.format("Password Salah")
      }
    }
  });
});
