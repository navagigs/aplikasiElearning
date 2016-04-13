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
   $query2 = "SELECT * FROM mata_pelajaran WHERE id_kelas = '$idkelas'";
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

 function showpel_pengajar()
 {
 <?php

 // membaca semua kelas
 $query1 = "SELECT * FROM kelas";
 $hasil1 = mysql_query($query1);

 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
 while ($data1 = mysql_fetch_array($hasil1))
 {
   $idkelas = $data1['id_kelas'];

   // membuat IF untuk masing-masing kelas
   echo "if (document.form_materi_pengajar.id_kelas.value == \"".$idkelas."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kelas
   $query2 = "SELECT * FROM mata_pelajaran WHERE  id_kelas = '$idkelas' AND id_pengajar ='$_SESSION[idpengajar]' ";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran_pengajar').innerHTML = \"<select name='".id_matapelajaran."'>";
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
function fsize($file){
                            $a = array("B", "KB", "MB", "GB", "TB", "PB");
                            $pos = 0;
                            $size = filesize($file);
                            while ($size >= 1024)
                            {
                            $size /= 1024;
                            $pos++;
                            }
                            return round ($size,2)." ".$a[$pos];
                            }
?>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{



$aksi="modul/mod_materi/aksi_materi.php";
switch($_GET[act]){
  // Tampil kelas
  default:
    if ($_SESSION[leveluser]=='admin'){
                
        $tampil_materi = mysql_query("SELECT * FROM file_materi ORDER BY id_kelas");
        $cek_materi = mysql_num_rows($tampil_materi);
        if(!empty($cek_materi)){
        echo "<div id='title'>Manajemen Materi</div>
          <div id='content'>
          <input class='button blue' type=button value='Tambah Materi' onclick=\"window.location.href='?module=materi&act=tambahmateri';\">";

        echo "<br><br>
          <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Judul</th>
			<th><center>Kelas</th>
			<th><center>Pelajaran</th>
			<th><center>Nama File</th>
			<th><center>Tgl Posting</th>
			<th><center>Pembuat</th>
			<th><center>Hits</th>
			<th><center>Aksi</th>
		</tr></thead>";
       $no=1;
    while ($r=mysql_fetch_array($tampil_materi)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td>$r[nama_file]</td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pengajar2 = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$p2[id_pengajar]'");
             $cek_pengajar2 = mysql_num_rows($pengajar2);
             if(!empty($cek_pengajar2)){
                 while ($p3= mysql_fetch_array($pengajar2)){
                 echo "<td><a href=?module=admin&act=detailpengajar&id=$p3[id_pengajar] title='Detail Pengajar'>$p3[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"<td>$r[hits]</td>
             <td><a href='?module=materi&act=editmateri&id=$r[id_file]' title='Edit'>
			 	 <img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?module=materi&act=hapus&id=$r[id_file]') title='Hapus'>
				 <img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table></div>";
 
    }else{
        echo "<script>window.alert('Tidak ada materi');
            window.location=(href='?module=home')</script>";
    }
    }
   
 elseif ($_SESSION[leveluser]=='pengajar'){        

    $cek_materi = mysql_query("SELECT * FROM file_materi WHERE pembuat = '$_SESSION[idpengajar]'");
    
     echo "<div id='title'>Daftar Materi Yang Anda Upload</div>
          <div id='content'>
          <input class='button blue' type=button value='Tambah Materi' onclick=\"window.location.href='?module=materi&act=tambahmateri';\">";
     echo "<br><br>		 
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Judul</th>
			<th><center>Kelas</th>
			<th><center>Pelajaran</th>
			<th><center>Nama File</th>
			<th><center>Tgl Upload</th>
			<th><center>Hits</th>
			<th><center>Aksi</th>
		</tr></thead>";

    $no=1;
    while ($r=mysql_fetch_array($cek_materi)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[judul]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             $cek_kelas = mysql_num_rows($kelas);
             if(!empty($cek_kelas)){
             while($k=mysql_fetch_array($kelas)){
                 echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$r[id_matapelajaran]'");
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=matapelajaran&act=detailpelajaran&id=$r[id_matapelajaran] title='Detail pelajaran'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td>$r[nama_file]</td>
             <td>$tgl_posting</td>             
             <td>$r[hits]</td>
             <td><a href='?module=materi&act=editmateri&id=$r[id_file]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
            <a href=javascript:confirmdelete('$aksi?module=materi&act=hapus&id=$r[id_file]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
                 

     $no++;
    }
    echo"</table></div>";   
    
    }
    
    else{
        echo"<div id='title'> Materi</div><div id='content'>";

        $ambil_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($ambil_siswa);

        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_kelas = '$data_siswa[id_kelas]'");
       echo "<table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Mata Pelajaran</th>
			<th><center>Materi</th></tr></thead>";
        $no=1;
        while ($r=mysql_fetch_array($mapel)){
        echo "<tr>
				<td align='center'>$no</td>
            	<td>$r[nama]</td>";
             echo "<td><input type=button class='tombol' value='Lihat File Materi'
                       onclick=\"window.location.href='?module=materi&act=daftarmateri&id=$r[id_matapelajaran]';\"></td></tr>";
        $no++;
        }
        echo "</table></div>";


    }
    break;


case "daftarmateri":
    if ($_SESSION[leveluser] == 'siswa'){
        
        $p      = new Paging;
        $batas  = 5;
        $posisi = $p->cariPosisi($batas);

        $mapel = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$_GET[id]'");
        $data_mapel = mysql_fetch_array($mapel);
        $materi = mysql_query("SELECT * FROM file_materi WHERE id_matapelajaran = '$_GET[id]' LIMIT $posisi,$batas ");
        $cek_materi = mysql_num_rows($materi);
        if (!empty($cek_materi)){
        echo"<div id='title'>Daftar File Materi  $data_mapel[nama]</div><div id='content'>";
        echo "<table id='table1' class='gtable sortable'>";
        $no=$posisi+1;
        while ($r=mysql_fetch_array($materi)){
        echo "<tr><td rowspan='6'>$no</td>";
             if (!empty($r[nama_file])){
             $pecah = explode(".", $r[nama_file]);
             $ekstensi = $pecah[1];
             if ($ekstensi == 'zip'){
                 echo "<td rowspan='6'><img src='images/zip.png'></td>";
             }
             elseif ($ekstensi == 'rar'){
                 echo "<td rowspan='6'><img src='images/rar.png'></td>";
             }
             elseif ($ekstensi == 'doc'){
                 echo "<td rowspan='6'><img src='images/doc.png'></td>";
             }
             elseif ($ekstensi == 'pdf'){
                 echo "<td rowspan='6'><img src='images/pdf.png'></td>";
             }
             elseif ($ekstensi == 'ppt'){
                 echo "<td rowspan='6'><img src='images/ppt.png'></td>";
             }
             elseif ($ekstensi == 'pptx'){
                 echo "<td rowspan='6'><img src='images/pptx.png'></td>";
             }
             elseif ($ekstensi == 'docx'){
                 echo "<td rowspan='6'><img src='images/doc.png'></td>";
             }
             }else{
                 echo "<td rowspan='6'><img src='images/kosong.png'></td>";
             }
             echo "<td>Judul</td><td>: $r[judul]</td></tr>
             <tr><td>Nama File</td><td>: $r[nama_file]</td></tr>
             <tr><td>Ukuran</td>";
                            if (!empty($r[nama_file])){
                            $file = "files_materi/$r[nama_file]";                            
                            echo "<td>: ". fsize($file)."</td></tr>";
                            }else{
                                echo "<td>: </td></tr>";
                            }
             echo"<tr><td>Tanggal Posting</td><td>: $r[tgl_posting]</td></tr>
             <tr><td colspan=2><input type=button class='tombol' value='Download File'
                       onclick=\"window.location.href='downlot.php?file=$r[nama_file]';\">
                       <b class='judul'>Di download : $r[hits] kali</b></td></tr>";
        $no++;
        }
        echo "</table>";
        $jmldata=mysql_num_rows(mysql_query("SELECT * FROM file_materi WHERE id_matapelajaran = '$_GET[id]'"));
        $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

        echo "<div id=paging>$linkHalaman</div><br>";

        echo "<p class='garisbawah'></p><input type=button class='tombol' value='Kembali'
          onclick=self.history.back()></ul></div>";
    }
    else{
        echo "<script>window.alert('Tidak ada file materi di mata pelajaran ini?');
            window.location=(href='media.php?module=materi')</script>";
    }
    }
    break;

case "tambahmateri":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form id=alumniForm  name='form_materi' method=POST action='$aksi?module=materi&act=input_materi' enctype='multipart/form-data'>
     <div id='title'>Tambah Materi</div>
	 <div id='content'>
	 <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><input type=text name='judul' size=50  class='required' title='Judul Materi harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";                                          
                                          $cari_kelas = mysql_query("SELECT * FROM kelas ORDER BY nama");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }                                          
                                          echo"</select>
				</td>
		    </tr>
		 	<tr>
				<td width='140'>Pelajaran</td>
				<td width='1'>:</td>
				<td><div id='pelajaran'></div></td>
		    </tr>
		 	<tr>
				<td width='140'>File</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40></td>
		    </tr>
			</table>          
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          
          </div>";
    }else{
    echo "<form id=alumniForm  name='form_materi' method=POST action='$aksi?module=materi&act=input_materi' enctype='multipart/form-data'>
     <div id='title'>Tambah Materi</div>
	 <div id='content'>
	 <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><input type=text name='judul' size=50  class='required' title='Judul Materi harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";                                          
                                          $cari_kelas = mysql_query("SELECT * FROM kelas ORDER BY nama");
                                          while ($k=mysql_fetch_array($cari_kelas)){
                                          echo"<option value='".$k[id_kelas]."'>".$k[nama]."</option>";
                                          }                                          
                                          echo"</select>
				</td>
		    </tr>
		 	<tr>
				<td width='140'>Pelajaran</td>
				<td width='1'>:</td>
				<td><div id='pelajaran'></div></td>
		    </tr>
		 	<tr>
				<td width='140'>File</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40></td>
		    </tr>
			</table>          
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          
          </div>";
    }
    break;

case "editmateri":
    if ($_SESSION[leveluser]=='admin'){
    $edit=mysql_query("SELECT * FROM file_materi WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$m[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    echo "
    <form name='form_materi' method=POST action='$aksi?module=materi&act=edit_materi' enctype='multipart/form-data'>
    <input type=hidden name=id value='$m[id_file]'>
    <div id='title'>Edit Materi</div>
	<div id='content'>
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><input type=text name='judul' value='$m[judul]'></td>
			</tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td> <select name='id_kelas' onChange='showpel()'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kelas ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></td>
			</tr>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><select id='pelajaran' name='id_matapelajaran'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></td>
			</tr>
		 	<tr>
				<td width='140'>Nama File</td>
				<td width='1'>:</td>
				<td>$m[nama_file]</td>
			</tr>
		 	<tr>
				<td width='140'>Ganti File</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40>
                                                     <small>Apabila file tidak diganti, di kosongkan saja</small>]</td>
			</tr>
	</table>
          <input class='button blue' type=submit value=Update>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>

          </div>";
    }
    else{
    $edit=mysql_query("SELECT * FROM file_materi WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$m[id_kelas]'");
    $k=mysql_fetch_array($isikelas);
    $pelajaran = mysql_query("SELECT * FROM mata_pelajaran WHERE id_matapelajaran = '$m[id_matapelajaran]'");
    $p=mysql_fetch_array($pelajaran);

    echo "<form name='form_materi_pengajar' method=POST action='$aksi?module=materi&act=edit_materi' enctype='multipart/form-data'>
    <input type=hidden name=id value='$m[id_file]'>
    <fieldset>
    <legend>Edit Materi</legend>
    <dl class='inline'>
    <dt><label>Judul</label></dt>              <dd>: <input type=text name='judul' value='$m[judul]' size=50></dd>
    <dt><label>Kelas</label></dt>              <dd>: <select name='id_kelas' onChange='showpel_pengajar()'>
                                          <option value='".$k[id_kelas]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kelas WHERE id_pengajar = '$_SESSION[idpengajar]'";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kelas]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></dd>
    <dt><label>Pelajaran</label></dt>          <dd>: <select id='pelajaran_pengajar' name='id_matapelajaran'>
                                          <option value='".$p[id_matapelajaran]."' selected>".$p[nama]."</option>
                                          </select></dd>
    <dt><label>File</label></dt>              <dd>: $m[nama_file]</dd>
    <dt><label>Ganti File</label></dt>        <dd>: <input type=file name='fupload' size=40>
    <small>Apabila file tidak diganti, di kosongkan saja</small></dd>
    <p align=center><input class='button blue' type=submit value=Simpan>
                      <input class='button blue' type=button value=Batal onclick=self.history.back()></p>
    </dl></fieldset></form>";
    }
    break;

}
}
?>
