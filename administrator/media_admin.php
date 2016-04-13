<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<script>window.alert('Silahkan Login terlebih dulu!!');window.location=(href='index.php');</script>";
}
else{
    if ($_SESSION['leveluser']=='siswa'){
     echo "<script>window.alert('Tidak Dapt Mengakses!');window.location=(href='index.php');</script>";  
	 }
    else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Learning | Administrator</title>
<link rel="shortcut icon" type="image/x-icon" href="../assets/images/l3c.jpg" />
	<style>@import "../assets/css/user.css";</style>
	<style>@import "../assets/css/menu-admin.css";</style>
    <style>@import "css/superfish.css";</style>
    <style>@import "css/uniform.default.css";</style>
    <style>@import "css/jquery.wysiwyg.css";</style>
    <style>@import "css/facebox.css";</style>
    <style>@import "css/smoothness/jquery-ui-1.8.8.custom.css";</style>
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/Delicious_500.font.js"></script>
    <script type="text/javascript" src="js/jquery.flot.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/facebox.js"></script>
    <script type="text/javascript" src="../assets/js/clock.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/switcher.js"></script>
	<script type="text/javascript" src="assets/js/jquery-1.2.3.pack.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.pack.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
	$("#alumniForm").validate({
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>
</head>

<body>
<?php
if ($_SESSION[leveluser]=='admin'){
?>
<div id='cssmenu' style="top:0px;border-bottom: 4px solid #F90;">
	<ul>
        	<li><a href="media_admin.php?module=home" title="Home">Home</a></li>
        	<li><a href="?module=admin" title="Administrator">Administrator</a></span></li>
        	<li><a href="?module=admin&act=pengajar" title="Pengajar">Pengajar</a></li>
        	<li><a href="?module=modul" title="Modul">Modul</a></li>
            <li><a href="#">Setting</a>
                  <ul>
                    <?php include "menu.php"; ?>
                 </ul>  
              </li>
        	<li style="float:right;"><a href="logout.php" onClick="return confirm('Apakah anda yakin akan Keluar ?');" title="Logout">
            LOGOUT</a></li>
    </ul> 
	</div>
</div>


<?php
}
elseif ($_SESSION[leveluser]=='pengajar'){
?>

<div id='cssmenu' style="top:0px;border-bottom: 4px solid #f90;">
	<ul>
        	<li><a href="media_admin.php?module=home" title="Home">HOME</a></li>
             <li><a href="#">SETTING</a>
                  <ul>
                      <?php include "menu.php"; ?>
                 </ul>
                 </li>
        	<li  style="float:right;"><a href="logout.php" onClick="return confirm('Apakah anda yakin akan Keluar ?');" title="Logout">LOGOUT</a></li>
            </ul>
            </div>
	</div>
 </div>

<?php
}
?>

<div id="container">
	<div id="wrap">
    	<div id="leftContent">     
       </div>
    		<div id="rightContent">
        	 	<div id="mainRight">
               <?php include "content_admin.php"; ?>
		</div>
	</div>
</div>
<div style="clear:both; padding-bottom:53px;"></div>
<div id='cssmenu' style="top:0px;border-top: 4px solid #f90;">
	<ul>      	
					<?php
                        if ($_SESSION[leveluser]=='admin'){
                           echo "<li><a href='#'>Login sebagai :Administrator</a></li><li  style='float:right'><a href='#'>";			   
  						   echo date('Y-m-d H:i:s');
						   echo "</a></li>";
								 }
                              elseif ($_SESSION[leveluser]=='pengajar'){
                           echo "<li><a href='#'>Login sebagai :Pengajar</a></li><li style='float:right'><a href='#'>";			   
  						   echo date('Y-m-d H:i:s');
						   echo "</a></li>";
                         }
              ?>
        </ul>
    </div>
 </div>
</body>
</html>

<?php
}
}
}
?>