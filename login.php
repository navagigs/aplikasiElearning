<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Learning | Login</title>

<style>@import "assets/css/login_style.css";</style>
<link rel="shortcut icon" type="image/x-icon" href="assets/images/l3c.jpg" />
	<script type="text/javascript" src="administrator/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="administrator/js/cufon-yui.js"></script>
    <script type="text/javascript" src="administrator/js/Delicious_500.font.js"></script>

    <script language="javascript">
	function validasi(form){
  if (form.username.value == ""){
      document.getElementById('eroruser').innerHTML = "<div class='error_msg'>Username Kosong</div>";
      form.username.focus();
      $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
      });
    return (false);
  }

  if (form.password.value == ""){
    document.getElementById('erorpass').innerHTML = "<div class='error_msg'>Password Kosong</div>";
    form.password.focus();
    $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
    });
    return (false);
  }
  return (true);
}
</script>
</head>
<style>
<?php
include "configurasi/koneksi.php";
$background=mysql_query("SELECT * FROM background ORDER BY id_background DESC LIMIT 4");
while($b=mysql_fetch_array($background)){
	 echo "
		body {
			height: 100%;
			margin: 0;
			padding: 0;
			font-family:Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
			background:url('foto_background/$b[gambar]');
			background-attachment:fixed;
			background-size:cover;
			font-size: 12px;
}";
 }
 ?>
</style>
<body>
	<div id="container">
    	<div id="leftcontent">
       		 <b>Selamat Datang</b> di Media Pembelajaran Online 
       			 <br /><b><font color="#06C">SMAN 3 Ciamis</font></b><br />
       				 <font size="4">Sarana Pembelajaran Siswa dengan menggunakan Teknologi Online</font>

       			 </div>
        <div id="centercontent"></div>
        <div id="rightcontent">
        	<div id="content">
        <table>
			<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
        	<tr>
            	<td colspan="2"><input type="text" placeholder="Username" name="username" class="inputuser" /></td>
            </tr>

            <tr>
            	<td><input type="password" placeholder="Password" name="password" class="inputpass" />
                <input type="submit" title="Log in" class="button" name="login" value="" /></td>
            </tr>
            <tr>
            	<td colspan="2">
                <div id="erorpass"></div>
            	<div id="eroruser"></div></td>           
            </tr>

            </form>
        </table>
        </div>
        </div>
        <ul class="copy">
			Copyright 2014 &copy;  e-Learning <br />
			Crate by <a href="#" target="_blank">SMAN 3 Ciamis</a>

</ul>
</body>
</html>