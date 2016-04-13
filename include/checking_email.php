<?php
include "configurasi/koneksi.php";

$sql = mysql_query("SELECT * FROM siswa
                   WHERE email = '$_POST[email]'");
$ketemu = mysql_num_rows($sql);

echo $ketemu;
?>
