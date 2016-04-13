<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showsiswa()
 {
	 <!-- <input type=button class='tombol' value='Edit Kelas'
          //onclick=\"window.location.href='?module=kelas&act=editkelas&id=$r[id]';\"> -->
 <?php

 // membaca semua kelas
 $query = "SELECT * FROM kelas";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkelas = $data['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_kelas.kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM siswa WHERE id_kelas = '$idkelas'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('siswa').innerHTML = \"<select name='ketua'><option value='0' selected>--Pilih--</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_siswa']."'>".$data2['nama_lengkap']."</option>";
   }
   $content .= "</select>\";";
   echo $content;
   echo "}\n";
 }

 ?>
 }
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_kelas/aksi_kelas.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil kelas
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");

      echo "<div id='title'>Manajemen Kelas</div>
          <div id='content'>
          <input type=button class='button blue' value='Tambah Kelas' onclick=\"window.location.href='?module=kelas&act=tambahkelas';\">";
      echo "<br><br>
		 <table  id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Id kelas</th>
			<th><center>Kelas</th>
			<th><center>Wali Kelas</th>
			<th><center>Ketua Kelas</th>
			<th><center>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr>
	   			<td align='center'>$no</td>
             	<td>$r[id_kelas]</td>
             	<td>$r[nama]</td>";
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
             echo "<td><a href='?module=kelas&act=editkelas&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> <a href='?module=daftarsiswa&act=lihatmurid&id=$r[id_kelas]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a> 
                 <a href=javascript:confirmdelete('$aksi?module=kelas&act=hapuskelas&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
      
    }
    echo "</table></div></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
         echo"<div id='title'>Kelas yang dipimpin</div><div id='content'>
         <input type=button class='button blue' value='Tambah Kelas' onclick=\"window.location.href='?module=kelas&act=tambahkelas';\">";

         $tampil_kelas = mysql_query("SELECT * FROM kelas WHERE id_pengajar = '$_SESSION[idpengajar]'");
         $ketemu=mysql_num_rows($tampil_kelas);
         if (!empty($ketemu)){
                echo "<br><br>
		 
		 <table id='table1' class='gtable sortable'><thead>
                <tr>
					<th><center>No</th>
					<th><center>Kelas</th>
					<th><center>Wali Kelas</th>
					<th><center>Ketua Kelas</th>
					<th><center>Aksi</th>
				</tr></thead>";

                $no=1;
                while ($r=mysql_fetch_array($tampil_kelas)){
                    echo "<tr>
					<td align='center'>$no</td>
                    <td>$r[nama]</td>";

                    $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_SESSION[idpengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
                    echo "<td><a href='?module=kelas&act=editkelas&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> 
					<a href='?module=daftarsiswa&act=lihatmurid&id=$r[id_kelas]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a>
                    <a href=javascript:confirmdelete('$aksi_kelas?module=kelas&act=hapuswalikelas&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>   
						";
                $no++;
                }
                echo "</table></div>";
                }else{
                    echo "<script>window.alert('Tidak ada kelas yang anda ampu,kembali ke home untuk menambah');
                    window.location=(href='?module=home')</script>";
                }
    }
    elseif ($_SESSION[leveluser]=='siswa'){
        echo"<div id='title'>Kelas Anda</div><div id='content'>";
        $ambil_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($ambil_siswa);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$data_siswa[id_kelas]'");

        echo "
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Kelas</th>
			<th><center>Wali Kelas</th>
			<th><center>Ketua Kelas</th>
			<th width='auto'>Aksi</th></tr></thead>";
        $no=1;
        while ($r=mysql_fetch_array($kelas)){
       echo "<tr>
             <td align='center'>$no</td>
             <td>$r[nama]</td>";
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]]'");
                    $ada_siswa = mysql_num_rows($siswa);
                    if(!empty($ada_siswa)){
                    while ($s=mysql_fetch_array($siswa)){
                            echo"<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
             echo "<td>
          <input type=button class='tombol' value='Lihat Teman'
          onclick=\"window.location.href='?module=siswa&act=lihatmurid&id=$r[id_kelas]';\">
          </td></tr>";
      $no++;
    }
    echo "</table></div>";
    }
    break;
    
    case "tambahkelas":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div id='title'>Tambah Kelas</div>
		  <div id='content'>
		  <form id=alumniForm method=POST action='$aksi?module=kelas&act=input_kelas'>
	 	 <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Id Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='id_kelas' class='required' title='Id Kelas harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' class='required' title='Nama Kelas harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Wali Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_pengajar'>
                                      <option value=0 selected>-- Pilih Pengajar --</option>";
                                      $tampil=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                      while($r=mysql_fetch_array($tampil)){
                                      echo "<option value=$r[id_pengajar]>$r[nama_lengkap]</option>";
                                      }echo "</select></td>
		    </tr>
		</table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
         </form></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $tampil=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_SESSION[idpengajar]'");
        $r=mysql_fetch_array($tampil);
        echo "<div id='title'>Tambah Kelas</div>
		  <div id='content'>
		  <form id=alumniForm method=POST action='$aksi?module=kelas&act=input_kelas'>
		  <br><div class='information msg'>Untuk Menambahkan Kelas yang Baru </div>
	 	 <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Id Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='id_kelas' class='required' title='Id Kelas harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' class='required' title='Nama Kelas harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Wali Kelas</td>
				<td width='1'>:</td>
				<td><select id='pengajar' name='id_pengajar'>
                                          <option value='".$r[id_pengajar]."' selected>".$r[nama_lengkap]."</option>
                                          </select></td>
		    </tr>
		</table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
         </form></div>";

    }
    break;

    case "editkelas":
    if ($_SESSION[leveluser]=='admin'){
    $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $niss = mysql_fetch_array($getnis);
    
    echo "<div id='title'>Edit Kelas</div>
		  <div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		  <form method=POST action='$aksi?module=kelas&act=update_kelas'>
          <input type=hidden name=id value='$r[id]'>
		 	<tr>
				<td width='140'>Id Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='id_kelas' value='$r[id_kelas]')</td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Kelas</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' value='$r[nama]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Wali Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_pengajar'>";					
                                      echo "<option value='$nipp[id_pengajar]' selected>$nipp[nama_lengkap]</option>";
                                      $tampil=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                      while($p=mysql_fetch_array($tampil)){
                                      echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                      }echo "</select></td>
		    </tr>
		 	<tr>
				<td width='140'>Ketua Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_siswa'>
                                      <option value='$niss[id_siswa]' selected>$niss[nama_lengkap]</option>";			  
                                      $tampil_siswa=mysql_query("SELECT * FROM siswa ORDER BY nama_lengkap");
                                      while($s=mysql_fetch_array($tampil_siswa)){
                                      echo "<option value=$s[id_siswa]>$s[nama_lengkap]</option>";
                                      }echo "</select></td>
		    </tr>
		  </table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Update>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </form></div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
    $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
     echo "<form method=POST action='$aksi?module=kelas&act=update_walikelas'>
    <input type=hidden name=id value='$r[id]'>
	<div id='title'>Edit Kelas</div>
	<div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='kelas' onChange='showsiswa()'>
                                      <option value='$r[id_kelas]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kelas WHERE id_pengajar ='0' ORDER BY id_kelas");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kelas]>$t[nama]</option>";
                                      }echo"</select></td>
			</tr>
		 	<tr>
				<td width='140'>Ketua Kelas</td>
				<td width='1'>:</td>
				<td><select name='ketua'>";
                                      $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
                                      $ceks=mysql_num_rows($siswa);
                                      if ($ceks != 0){
                                      $data = mysql_fetch_array($siswa);
                                      echo"<option value='$data[id_siswa]' selected>$data[nama_lengkap]</option>";
                                      }else{
                                          echo "<option value='0' selected>--Pilih--</option>";
                                      }
                                      $tampil_siswa = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$r[id_kelas]'");
                                      while($s=mysql_fetch_array($tampil_siswa)){
                                          echo "<option value=$s[id_siswa]>$s[nama_lengkap]</option>";
                                      }echo"</select>
									</td>
				</tr>
				</table>
         					<input type=submit class='button blue' value=Simpan>
                            <input type=button class='button blue' value=Batal onclick=self.history.back()></div>";
    }
    elseif ($_SESSION[leveluser]=='siswa'){
         echo"<div id='back'><ul class='back'>
			<a title='Beranda' href='?module=home'><img src='assets/images/icn_alert_error.png' /></a></ul>
		 	<br><article class='module width_full'>
			<header><h3><b class='judul'>Edit Kelas</b></h3></header>
         <form method=POST action='$aksi_siswa?module=siswa&act=update_kelas_siswa'>";
         $tampil = mysql_query("SELECT * FROM kelas WHERE id = '$_GET[id]'");
         $r = mysql_fetch_array($tampil);
         echo "<table id='table'>
          <tr><td>Kelas </td>   <td>: <select name='id_kelas'>
                                      <option value='$r[id_kelas]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kelas]>$t[nama]</option>";
                                      }echo"</select></td></tr>
        <tr><td colspan=2><input type=submit class='tombol' value='Update'>
                          <input type=button class='tombol' value='Batal'
                          onclick=self.history.back()></td></tr>
        </form></table></div>";
    }
    break;


case "detailkelas":
    $detail=mysql_query("SELECT * FROM kelas WHERE id_kelas='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin'){
    echo "<div id='title'>Detail Kelas</div>
		  <div id='content'>";
    echo "<br><table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>Id Kelas</th>
			<th><center>Kelas</th>
			<th><center>Wali Kelas</th>
			<th><center>Ketua Kelas</th>
			<th><center>Aksi</th>
		</tr></thead>";

    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$r[id_kelas]</td>
             <td>$r[nama]</td>";
             $getpengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek = mysql_num_rows($getpengajar);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getsiswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
             $cek_siswa = mysql_num_rows($getsiswa);
             if (!empty($cek_siswa)){
             while($s=mysql_fetch_array($getsiswa)){
             echo "<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td><a href='?module=kelas&act=editkelas&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?module=kelas&act=hapuskelas&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
                 <a href=?module=siswa&act=lihatmurid&id=$r[id_kelas]><img src='images/icons/user-white.png' title='Lihat Siswa'></a></td></tr>";
      }
    echo "</table>
          <br><input class='button blue' type=button value=Kembali onclick=self.history.back()>
          </dl></div>";
    }else{
        echo "<div id='title'>Detail Kelas</div>
		  <div id='content'>";
    echo "<table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Kelas</th>
			<th><center>Wali Kelas</th>
			<th><center>Ketua Kelas</th>
			<th><center>Aksi</th></tr></thead>";
    $no = 1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $getpengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek = mysql_num_rows($getpengajar);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Wali Kelas'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getsiswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
             $cek_siswa = mysql_num_rows($getsiswa);
             if (!empty($cek_siswa)){
             while($s=mysql_fetch_array($getsiswa)){
             echo "<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td><a href='?module=kelas&act=editkelas&id=$r[id]' title='Edit'> <img src='images/icons/edit.png' alt='Edit' /></a>|
                      <input type=button class='button blue' value='Lihat Siswa' onclick=\"window.location.href='?module=siswa&act=lihatmurid&id=$r[id_kelas]';\">";
       $no++;
      }
    echo "</table></div>
    <br> <input type=button class='button blue' value=Kembali onclick=self.history.back()>";
    }

    break;

 
}
}
?>
