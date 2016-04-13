<?php
include "configurasi/koneksi.php";
include "configurasi/library.php";
include "configurasi/fungsi_indotgl.php";
include "configurasi/fungsi_combobox.php";
include "configurasi/class_paging.php";


session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  echo "<script>window.alert('Anda Belum melakukan login!');window.location=(href='index.php');</script>";
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<script>window.alert('Silahkan Login terlebih dulu!');window.location=(href='index.php');</script>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-Learning | Siswa</title>	
<link rel="shortcut icon" type="image/x-icon" href="assets/images/l3c.jpg" />
<style>
@import "assets/css/user.css";
@import "assets/css/menu.css";
</style>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery.visualize.js"></script>
    <script type="text/javascript" src="assets/js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="assets/js/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="assets/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="assets/js/jquery.idtabs.js"></script>
    <script type="text/javascript" src="assets/js/jquery.datatables.js"></script>
    <script type="text/javascript" src="assets/js/jquery.jeditable.js"></script>
    <script type="text/javascript" src="assets/js/jquery.ui.js"></script>
    <script type="text/javascript" src="assets/js/clock.js"></script>
	<script type="text/javascript" src="assets/js/excanvas.js"></script>
	<script type="text/javascript" src="assets/js/cufon.js"></script>
	<script type="text/javascript" src="assets/js/Geometr231_Hv_BT_400.font.js"></script>
	<script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
		themes  : 'simple,advanced',
		languages : 'en',
		disk_cache : true,
		debug : false
});
</script>
	<script language="javascript" type="text/javascript" src="../tinymcpuk/tiny_mce_src.js"></script>
    <script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
		theme_advanced_buttons3_add : "emotions,flash",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;

		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;

		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}

		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}

		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>
	<script language="javascript" type="text/javascript">
        function pertanyaan(){
         if(confirm('Anda yakin yang ingin keluar?'))
            {
            return true;
             }
            else
            {
            return false;
             }
        }

        
</script>
	<script type="text/javascript">
	function confirmClose() {
	  alert("You have chosen to close this window");
		if (confirm("Are you sure?")) {
		  parent.close();
		}
		else
		  alert("Close cancelled."); {
		}
	}
// End -->
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
<body onLoad="startclock()">
<div id='cssmenu' style="top:0px;border-bottom: 4px solid #1b9bff;">
	<ul>
        	<li><a href="media.php?module=home" title="Home">Home</a></li>
        	<li><a href="media.php?module=kelas" title="Kelas">Kelas</a></li>
        	<li><a href="media.php?module=matapelajaran" title="Mata Pelajaran">Mata Pelajaran</a></li>
        	<li><a href="media.php?module=materi" title="Materi">Materi</a></li>
        	<li><a href="media.php?module=quiz" title="Tugas / Quiz">Tugas / Quiz</a></li>
        	<li><a href="#">Setting</a>
            	<ul>
        		<li><a href="<?php echo "media.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]";?>" title="Home"> Profil</a></li>
        		<li><a href="media.php?module=siswa&act=detailaccount">Username / Password</a></li>                
                </ul>
            </li>
        	<!--li><a href="#">
					<SCRIPT language=JavaScript>var d = new Date();
						var h = d.getHours();
						if (h < 11) { document.write('Selamat pagi, pengunjung...'); }
						else { if (h < 15) { document.write('Selamat siang, pengunjung...'); }
						else { if (h < 19) { document.write('Selamat sore, pengunjung...'); }
						else { if (h <= 23) { document.write('Selamat malam, pengunjung...'); }
						}}}
                    </SCRIPT> </a>
            </li-->
        	<li style="float:right;"><a href="logout.php" onClick="return confirm('Apakah anda yakin akan Keluar ?');" title="Logout">
            Logout</a></li>
       </ul>
	</div>
<div id="container">
	<div id="wrap">
    		<div id="rightContent">
        	 	<div id="mainRight">
   <?php include "include/content.php"; ?>
</div>
</div>
</div>
<div style="clear:both; padding-bottom:53px;"></div>
    <div class="menubar" style="bottom:0px; border-top: 4px solid #1b9bff;">
		<div id="cssmenu">
         		<ul>  
        			<li><a href="https://www.facebook.com/RezaNurFajri" target="_blank">
                    Copyright 2014 &copy; Reza Nur Fajri </a></li>
					<li style="float:right;"><a href="#"><?php echo date('Y-m-d H:i:s');  ?></a></li>
        		</ul>
    		</div>
 		</div></div>
</body>
</html>

<?php } } ?>