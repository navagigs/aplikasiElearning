<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>e-Learning | Login</title>
	<style>@import "../assets/css/login_style.css";</style>
    <link href="assets/images/favicon.PNG" rel="shortcut icon" type="image/x-icon" />
    <meta name="author" content="Nava Gia Ginasta" />
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
<body><div id="leftContent"></div>
<div id="container">
	
	<div id="wrap"><span>Form Login</span>
    	<!--<ul class="cont"><a title="Daftar" href="reg.php">Daftar</a></ul><br />-->
		<div id="main">
			<div id="content">  
		  <table class='data' cellpadding='5'  width='250'>
					<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
                    	<tr>
                            <td  colspan="3">
                                <div id="eroruser"></div>
                                <div id="erorpass"></div>
                            </td>
                    	</tr>
                         <tr>
                           <td width="5"><img title="username" src="../assets/images/user.png" /></td>
                        	<td><input type="text" placeholder="Username" name="username" /></td>
                        </tr>
                        <tr>
                          <td width="5"><img title="password" src="../assets/images/keluar.png" /></td>
                        	<td><input type="password" placeholder="Password" name="password"/></td>
                       </tr>
                       <tr>
                         <td>&nbsp;</td>
                            <td><input type="submit" title="Masuk" name="login" class="buttonKirim" value="Masuk »" /></td>
                      </tr>
                   </form>
               </table>                    
		</div>
	</div>
</div>
</body>
</html>