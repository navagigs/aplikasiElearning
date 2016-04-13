<?php
include "../configurasi/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li><a href='$m[link]' class='parent'>$m[nama_modul]</a></li>";
  }
}
elseif ($_SESSION['leveluser']=='pengajar'){
  $sql=mysql_query("select * from modul where status='pengajar' and aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li><a href='$m[link]' class='parent'>$m[nama_modul]</a></li>";
  }
}
?>
