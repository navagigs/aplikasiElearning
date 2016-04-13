<?php
session_start();
?>
<?php

$bataswaktu       = time("U") - 300;
$user = mysql_query("SELECT * FROM online WHERE online ='Y'");
while ($r=mysql_fetch_array($user)){
    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $s = mysql_fetch_array($siswa);
    if ($s[id_siswa] != $_SESSION[idsiswa]){
    if (!empty($s[foto])){       
        echo "<a href='javascript:void(0)' onclick='javascript:chatWith($s[nama_lengkap])'><img src='foto_siswa/small_$s[foto]' title='$s[nama_lengkap]'></a><br>";
    }
    else{
        echo "<a href='javascript:void(0)' onclick='javascript:chatWith($s[nama_lengkap])'><img src='foto_siswa/foto_kosong.png' title='$s[nama_lengkap]'></a><br>";
    }
    }
    else{
       if (!empty($s[foto])){
        echo "<img src='foto_siswa/small_$s[foto]' title='$s[nama_lengkap]'><br>";
        }
        else{
            echo "<img src='foto_siswa/foto_kosong.png' title='$s[nama_lengkap]'><br>";
        }
    }
    
}
?>
