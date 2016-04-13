<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
session_start();
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus modul
if ($module=='modul' AND $act=='hapus'){
  mysql_query("DELETE FROM modul WHERE id_modul='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

// Input modul
elseif ($module=='modul' AND $act=='input'){
	
  // Cari angka urutan terakhir
  $u=mysql_query("SELECT urutan FROM modul ORDER by urutan DESC");
  $d=mysql_fetch_array($u);
  $urutan=$d[urutan]+1;
  
	$nama_modul=trim($_POST[nama_modul]);
	$link=trim($_POST[link]);
	$publish=trim($_POST[publish]);
	$aktif=trim($_POST[aktif]);
	$status=trim($_POST[status]);
	

$cek_akun=mysql_num_rows(mysql_query("SELECT * FROM modul WHERE nama_modul='$nama_modul'"));

if (empty($nama_modul)){
  echo "<div class='error msg'>Anda belum mengisikan <u>Nama Modul</u>
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></div>";
}
elseif (empty($link)){
  echo "<div class='error msg'>Anda belum mengisikan <u>Link Modul</u>
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></div>";
}
elseif (empty($publish)){
  echo "Anda belum mengisikan Publish<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($aktif)){
  echo "Anda belum mengisikan Aktif<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($status)){
  echo "Anda belum mengisikan Status<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
  
  // Input data modul
  mysql_query("INSERT INTO modul(nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan) 
	                       VALUES('$_POST[nama_modul]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$_POST[aktif]',
                                '$_POST[status]',
                                '$urutan')");
  header('location:../../media_admin.php?module='.$module);
}
}

// Update modul
elseif ($module=='modul' AND $act=='update'){
  mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
                                status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]'  
                          WHERE id_modul   = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}
}
?>
