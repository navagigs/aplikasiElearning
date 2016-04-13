<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showpel()
 {
 <?php

 // membaca semua kelas
 $query = "SELECT * FROM kelas";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkelas = $data['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_materi.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_pelajaran WHERE id_kelas = '$idkelas' AND id_pengajar = '0'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran').innerHTML = \"<select name='".id_matapelajaran."'>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_matapelajaran']."'>".$data2['nama']."</option>";
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

$aksi="modul/mod_matapelajaran/aksi_matapelajaran.php";
switch($_GET[act]){
// Tampil Mata Pelajaran
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran ORDER BY id_kelas");
      echo " <div id='title'>Manajemen Mata Pelajaran</div>
          <div id='content'>
          <input class='button blue' type=button value='Tambah Mata Pelajaran' onclick=\"window.location.href='?module=matapelajaran&act=tambahmatapelajaran';\">";
          echo "<br><br>
          <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Id Mapel</th>
			<th><center>Nama</th>
			<th><center>Kelas</th>
			<th><center>Pengajar</th>
			<th><center>Deskripsi</th>
			<th><center>Aksi</th>
			</tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr>
	   			 <td align='center'>$no</td>
				 <td>$r[id_matapelajaran]</td>
				 <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek = mysql_num_rows($kelas);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table></div></div></form>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
     //Mata Pelajaran

  $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_pengajar = '$_SESSION[idpengajar]'");
  $cek_mapel = mysql_num_rows($tampil_pelajaran);
  if (!empty($cek_mapel)){
    echo" <div id='title'>Mata Pelajaran Yang Anda Bimbing</div>
          <div id='content'>
    <input type=button class='button blue' value='Tambah' onclick=\"window.location.href='?module=matapelajaran&act=tambahmatapelajaran';\">";
    echo "<br><br>		 
          <table id='table1' class='gtable sortable'><thead><thead>
          <tr>
		  <th><center>No</th>
		  <th><center>Nama</th>
		  <th><center>Kelas</th>
		  <th><center>Pengajar</th>
		  <th><center>Deskripsi</th>
		  <th><center>Aksi</th>
		 </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr>
	   		 <td align='center'>$no</td>             
             <td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek = mysql_num_rows($kelas);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                <a href=javascript:confirmdelete('$aksi_mapel?module=matapelajaran&act=hapus_mapel_pengajar&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>";
      $no++;
    }
    echo "</table></div></div></form>";
        }else{
            echo "<script>window.alert('Tidak ada Mata Pelajaran yang anda bimbing, Kembali ke home untuk menambah Mata Pelajaran yang di bimbing');
            window.location=(href='?module=home')</script>";
        }
    }
    elseif ($_SESSION[leveluser]=='siswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = $_SESSION[idsiswa]");
        $data_siswa = mysql_fetch_array($siswa);
        $tampil_pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
        echo"<div id='title'>Daftar Mata Pelajaran</div>";
        echo "<div id='content'>
          <table id='table1' class='gtable sortable'><thead>
          	<tr>
				<th><center>No</th>
				<th><center>Nama</th>
				<th><center>Pengajar</th>
				<th><center>Deskripsi</th></thead></tr>";
        $no=1;
        while ($r=mysql_fetch_array($tampil_pelajaran)){
        echo "<tr>
				<td align='center'>$no</td>
             	<td>$r[nama]</td>";             
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>";
        $no++;
        }
        echo "</table></div>";
    }
    break;

case "tambahmatapelajaran":
    if ($_SESSION[leveluser]=='admin'){
        echo "<form id='alumniForm' method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran'>
         <form method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran'>
		          <div id='title'>Mata Pelajaran Yang Anda Bimbing</div>
          <div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Id Matapelajaran</td>
				<td width='1'>:</td>
				<td><input type=text name='id_matapelajaran'  class='required' title='Id harus diisi' size=30></td>
		 	<tr>
		 	<tr>
				<td width='140'>Nama Matapelajaran</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' size=30  class='required' title='Nama Matapelajaran harus diisi'></td>
		 	<tr>
				<td width='140'>Pengajar</td>
				<td width='1'>:</td>
				<td><select name='id_kelas' onChange='showpel()'>
													  <option value=''>-pilih-</option>";
													  $pilih="SELECT * FROM kelas ORDER BY id_kelas";
													  $query=mysql_query($pilih);
													  while($row=mysql_fetch_array($query)){
													  echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
													  }
													  echo"</select></td>
			</tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_pengajar'>
												  <option value=''>-pilih-</option>";
                                                  $tampil_pengajar=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pengajar)){
                                                  echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                                  }echo "</select></td>
		 	</tr>
		 	<tr>
				<td width='140'>Deskripsi</td>
				<td width='1'>:</td>
				<td><textarea name='deskripsi'  id='wysiwyg'  cols='75' rows='3'></textarea></td>
		 	<tr>
          </table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $tampil=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_SESSION[idpengajar]'");
        $r=mysql_fetch_array($tampil);
        echo "<form id='alumniForm' method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran'>
		          <div id='title'>Mata Pelajaran Yang Anda Bimbing</div>
          <div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Nama</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' class='required' title='Nama harus diisi' size=30></td>
			</tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas' onChange='showpel()'>
													  <option value=''>-pilih-</option>";
													  $pilih="SELECT * FROM kelas ORDER BY id_kelas";
													  $query=mysql_query($pilih);
													  while($row=mysql_fetch_array($query)){
													  echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
													  }
													  echo"</select></td>
			</tr>
		 	<tr>
				<td width='140'>Pelajaran</td>
				<td width='1'>:</td>
				<td><select id='pengajar' name='id_pengajar'>
                                          <option value='".$r[id_pengajar]."' selected>".$r[nama_lengkap]."</option>
                                          </select>
			</tr>
		 	<tr>
				<td width='140'>Deskripsi</td>
				<td width='1'>:</td>
				<td><textarea name='deskripsi'  id='wysiwyg'  cols='75' rows='3' width='200'></textarea></td>
			</tr>
          </table><input type=submit class='button blue' value=Simpan>
                      <input type=button class='button blue' value=Batal onclick=self.history.back()>
          </div>";
    }
    break;

case "editmatapelajaran":
    if ($_SESSION[leveluser]=='admin'){
        $mapel=mysql_query("SELECT * FROM mata_pelajaran WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
        $k = mysql_fetch_array($kelas);
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$m[id_pengajar]'");
        $d = mysql_fetch_array($pengajar);
        
        echo "
          <form method=POST action='$aksi?module=matapelajaran&act=update_matapelajaran'>
          <input type=hidden name=id value='$m[id]'>
          <div id='title'>Edit Mata Pelajaran </div>
		  <div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Id Matapelajran</td>
				<td width='1'>:</td>
				<td><input type=text name='id_matapelajaran' size=10 value='$m[id_matapelajaran]'></td>
		 	</tr>
		 	<tr>
				<td width='140'>Nama Matapelajaran</td>
				<td width='1'>:</td>
				<td><input type=text name='nama' size=30 value='$m[nama]'></td>
		 	</tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas'>
                                                  <option value='$k[id_kelas]' selected>$k[nama]</option>";
                                                  $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama");
                                                  while($r=mysql_fetch_array($tampil)){
                                                  echo "<option value=$r[id_kelas]>$r[nama]</option>";
                                                  }echo "</select></td>
		 	</tr>
		 	<tr>
				<td width='140'>Pengajar</td>
				<td width='1'>:</td>
				<td><select name='id_pengajar'>
                                                  <option value='$d[id_pengajar]' selected>$d[nama_lengkap]</option>";  
                                                  $tampil_pengajar=mysql_query("SELECT * FROM pengajar ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pengajar)){
                                                  echo "<option value=$p[id_pengajar]>$p[nama_lengkap]</option>";
                                                  }echo "</select>
		 	</tr>
		 	<tr>
				<td width='140'>Deskripsi</td>
				<td width='1'>:</td>
				<td><textarea name='deskripsi'  id='wysiwyg'  cols='75' rows='3'>$m[deskripsi]</textarea></td>
		 	</tr>
        </table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Update>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>";
    }else{
        $mapel=mysql_query("SELECT * FROM mata_pelajaran WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
        $k = mysql_fetch_array($kelas);
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$m[id_pengajar]'");
        $d = mysql_fetch_array($pengajar);

        echo "<form method=POST name='form_materi' action='$aksi?module=matapelajaran&act=update_matapelajaran_pengajar'>
          <input type=hidden name=id value='$m[id]'>
          <div id='title'>Edit Mata Pelajaran</div>
		  	<div id='content'>
          <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas' onChange='showpel()'>
                                          <option value='$k[id_kelas]' selected>$k[nama]</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></td>
			</tr>
		 	<tr>
				<td width='140'>Pelajaran</td>
				<td width='1'>:</td>
               <td><select id='pelajaran' name='id_matapelajaran'>
                                          <option value='".$m[id_matapelajaran]."' selected>".$m[nama]."</option>
                                          </select></td>
			</tr>			
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
          		<td><textarea name='deskripsi'  id='wysiwyg'  cols='75' rows='3'>$m[deskripsi]</textarea></td>
			</tr>
		  </table>
         <input class='button blue' type=submit value=Simpan>
         <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>";
    }
    break;
case "detailpelajaran":
    if ($_SESSION[leveluser]=='admin'){
        $detail =mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        echo "<div id='title'>Detail Mata Pelajaran</div>
          <div id='content'>		 
          <table id='table1' class='gtable sortable'><thead><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Id Mapel</th>
			<th><center>Nama</th>
			<th><center>Kelas</th>
			<th><center>Pengajar</th>
			<th><center>Deskripsi</th>
			<th><center>Aksi</th>
		</tr></thead>";
        $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
	   			<td>$no</td>
             	<td>$r[id_matapelajaran]</td>
             	<td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>
    <br><input class='button blue' type=button value=Kembali onclick=self.history.back()></dl></div>";
    }else{
      $detail =mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        echo "<div class='information msg'>Detail Mata Pelajaran</div>
          <br>
		 <table id='datatables' class='display'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Nama</th>
			<th><center>Kelas</th>
			<th><center>Pengajar</th>
			<th><center>Deskripsi</th>
		</tr>";
                    $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
	   			<td>$no</td>             
            	<td>$r[nama]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek_pengajar = mysql_num_rows($pengajar);
             if(!empty($cek_pengajar)){
             while($p=mysql_fetch_array($pengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td></tr>";
             
      $no++;
    }
    echo "</table>
    <input type=button class='button blue' value=Kembali onclick=self.history.back()>";
    }
    break;
}
}
?>
