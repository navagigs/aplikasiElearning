<?php
include "../../../configurasi/koneksi.php";
include "../../../configurasi/library.php";
include "../../../configurasi/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus background
if ($module=='background' AND $act=='hapus'){
  mysql_query("DELETE FROM background WHERE id_background='$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

// Input background
elseif ($module=='background' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    Uploadbackground($nama_file);
    mysql_query("INSERT INTO background(judul,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  }
  else{
    mysql_query("INSERT INTO background(judul,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang')");
  }
  header('location:../../media_admin.php?module='.$module);
}

// Update background
elseif ($module=='background' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE background SET judul     = '$_POST[judul]'
                             WHERE id_background = '$_POST[id]'");
  }
  else{
    Uploadbackground($nama_file);
    mysql_query("UPDATE background SET judul     = '$_POST[judul]',
                                   gambar    = '$nama_file'   
                             WHERE id_background = '$_POST[id]'");
  }
  header('location:../../media_admin.php?module='.$module);
}
?>
