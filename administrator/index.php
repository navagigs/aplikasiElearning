<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>e-Learning | Login Administrator</title>
	<link rel="shortcut icon" type="image/x-icon" href="../assets/images/l3c.jpg" />
    <style>@import "../assets/css/login.css";</style>
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/Delicious_500.font.js"></script>
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

<body>

<div id="container">
<div id="wrap">
       <table class="table">
		<form method="POST"action="cek_login.php" onSubmit="return validasi(this)">
                <tr>
                    <td><input type="text" placeholder="Username" id="text" name="username"  class="input" /></td>
                </tr>
                <tr>
                    <td><input type="password" placeholder="Password" id="passsword" name="password" /></td>
                </tr>
                <tr>
                    <td><input type="submit" class="button" value="Masuk »" /></td>
   			    </tr>
          		<tr>
                    <td>
        				<div id="eroruser"></div>
        				<div id="erorpass"></div>
                    </td>
          		</tr>
   		</form>
 </table>
 </div><img src="../assets/images/logo_login copy.JPG" width="325" height="173" /><a class="a" href="../index.php" target="_blank">»View Website</a>
</div>
     <ul class="copy">
			Copyright 2014 &copy; e-Learning <br />
			Crate by <a href="https://www.facebook.com/RezaNurFajri" target="_blank">Reza Nur Fajri</a>
        </ul>
</body>
</html>