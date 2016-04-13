<?php
include "../configurasi/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Tidak Bisa Mekases!</div>";
}
else{
$login=mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

$login_guru =mysql_query("SELECT * FROM pengajar WHERE username_login='$username' AND password_login='$pass' AND blokir='N'");
$ketemu_guru=mysql_num_rows($login_guru);
$g=mysql_fetch_array($login_guru);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "timeout.php";

  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[idadmin]      = $r[id_admin];

  // session timeout
  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();

	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE admin SET id_session='$sid_baru' WHERE username='$username'");
  header('location:media_admin.php?module=home');
}
elseif($ketemu_guru > 0){
  session_start();
  include "timeout.php";

  $_SESSION[nip]          = $g[nip];
  $_SESSION[idpengajar]   = $g[id_pengajar];
  $_SESSION[namauser]     = $g[username_login];
  $_SESSION[namalengkap]  = $g[nama_lengkap];
  $_SESSION[passuser]     = $g[password_login];
  $_SESSION[leveluser]    = $g[level];

  // session timeout
  $_SESSION[login] = 1;
  timer();

	$sid_lama = session_id();

	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE pengajar SET id_session='$sid_baru' WHERE username_login='$username'");
  header('location:media_admin.php?module=home');
}
else{
   echo "<script>window.alert('LOGIN GAGAL! Username atau Password tidak benar !');window.location=(href='index.php');</script>";
}
}
?>
