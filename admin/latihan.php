<html>
<head>
<title>copy to clipboard</title>
<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script type="text/javascript">
function copyToClipboard() {
  $("#generate-notif").select();
  document.execCommand("copy"); 
alert("berhasil di copy");
}
</script>
</head>
<body>
<div class='input-group'>
<input type='text'  class='form-control' name='code'   id='generate-notif'>
<span class='input-group-btn'>
<button class='btn btn-info btn-flat' type='button' onclick=copyToClipboard()>Copy</button>
</span>
</div>
</body>
</html>