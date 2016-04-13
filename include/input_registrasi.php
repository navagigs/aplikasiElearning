<?php 

include "configurasi/koneksi.php";
include "configurasi/library.php";
if (!empty($_POST['nis']) AND !empty($_POST['email'])){
 $pass=md5($_POST[password_login]);
    mysql_query("INSERT INTO registrasi_siswa(nis,
											  nama_lengkap,
											  username_login,
											  password_login,
											  id_kelas,
											  alamat,
											  tempat_lahir,
											  tgl_lahir,
											  jenis_kelamin,
											  agama,
											  nama_ayah,
                                              nama_ibu,
											  th_masuk,
											  email)
                             VALUES ('$_POST[nis]
											 ','$_POST[nama]
											 ','$_POST[username_login]
											 ','$pass
											 ','$_POST[kelas]
											 ','$_POST[alamat]
											 ','$_POST[tempat_lahir]
											 ','$_POST[tgl_lahir]
											 ','$_POST[jk]
											 ','$_POST[agama]
											 ','$_POST[nama_ayah]
											 ','$_POST[nama_ibu]
											 ','$_POST[thn_masuk]
											 ','$_POST[email]')");
    echo "<script>window.alert('Terimakasih telah mendaftarkan diri anda, silahkan tunggu konfirmasi email dari admin.');
            window.location=(href='index.php')</script>";
}else{
    header('location:index.php');
}
?>

