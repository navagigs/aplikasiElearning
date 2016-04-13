<?php
include "configurasi/koneksi.php";

echo "<li class='icn_view_users'><a href='media.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]'>Edit Profil</a></li>";
echo "<li class='icn_edit_article'><a href='media.php?module=siswa&act=detailaccount'>Edit Username & Password</a></li>";
echo "<li class='icn_jump_back'><a href='logout.php' onclick='return confirm('Apakah anda yakin akan Keluar ?');'>Logout</a></li>";

?>
