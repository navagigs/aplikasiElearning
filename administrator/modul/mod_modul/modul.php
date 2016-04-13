<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    if ($_SESSION[leveluser]=='admin'){
    echo "<div id='title'>Manajemen Modul</div>
		  <div id='content'>
          <input class='button blue' type=button value='Tambah Module' onclick=\"window.location.href='?module=modul&act=tambahmodul';\"><br /><br />
          <div class='information msg'>
          Apabila Publish = Y, maka Modul ditampilkan di halaman pengunjung.<br>
          Apabila Aktif = Y, maka Modul ditampilkan di halaman administrator pada daftar menu yang berada di bagian kiri.</div>

          <br>
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Nama Modul</th>
			<th><center>Link</th>
			<th><center>Publish</th>
			<th><center>Aktif</th>
			<th><center>Status</th>
			<th><center>Aksi</th>
		</tr></thead>";
    $tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr>
	  		<td align='center'>$r[urutan]</td>
            <td>$r[nama_modul]</td>
            <td><a href=$r[link]>$r[link]</a></td>
            <td align=center>$r[publish]</td>
            <td align=center>$r[aktif]</td>";
            if ($r[status]=='admin'){
                echo "<td align='center'>Administrator</td>";
            }else{
                echo "<td align='center'>Teacher</td>";
            }
            echo"<td><a href='?module=modul&act=editmodul&id=$r[id_modul]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                <a href=javascript:confirmdelete('$aksi?module=modul&act=hapus&id=$r[id_modul]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
            </td></tr>";
    }
    echo "</table></div>";
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

  case "tambahmodul":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form id='alumniForm'  class='uniform' method=POST action='$aksi?module=modul&act=input'>
          <div id='title'>Tambah Module</div>
		  <div id='content'>  
	 	 <table  class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Nama Modul</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_modul' class='required' title='Nama Modul harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Link</td>
				<td width='1'>:</td>
				<td><input type=text name='link' size=30 class='required' title='Link Modul harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Publish</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='publish' value='Y' checked>Y </label>
					<label><input type=radio name='publish' value='N'> N</label></td>
		    </tr>
		 	<tr>
				<td width='140'>Aktif</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='aktif' value='Y' checked>Y</label>
                    <label><input type=radio name='aktif' value='N'> N</label></td>
		    </tr>
		 	<tr>
				<td width='140'>Status</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='status' value='admin' checked>Administrator</label>
                   <label><input type=radio name='status' value='pengajar'>Pengajar</label></dd></td>
		    </tr></table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>";
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
       echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;
 
  case "editmodul":
    if ($_SESSION[leveluser]=='admin'){
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<form class='uniform' method='POST' action='$aksi?module=modul&act=update'>
          <input type=hidden name=id value='$r[id_modul]'>
           <div id='title'>Edit Module</div>
		   <div id='content'>   <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Nama Modul</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_modul' value='$r[nama_modul]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Link</td>
				<td width='1'>:</td>
				<td><input type=text name='link' size=30 value='$r[link]'></td>
		    </tr>";
    if ($r[publish]=='Y'){
      echo "<tr>
				<td width='140'>Publish</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='publish' value='Y' checked>Y </label>
					<label><input type=radio name='publish' value='N'> N</label></td>
		    </tr>";
    }
    else{
      echo "<tr>
				<td width='140'>Publish</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='publish' value='Y' >Y </label>
					<label><input type=radio name='publish' value='N' checked> N</label></td>
		    </tr>";
    }
    if ($r[aktif]=='Y'){
      echo "
		 	<tr>
				<td width='140'>Aktif</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='aktif' value='Y' checked>Y</label>
                    <label><input type=radio name='aktif' value='N'> N</label></td>
		    </tr>";
    }
    else{
       echo "
		 	<tr>
				<td width='140'>Aktif</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='aktif' value='Y' >Y</label>
                    <label><input type=radio name='aktif' value='N'  checked> N</label></td>
		    </tr>";
    }
    if ($r[status]=='pengajar'){
      echo "<tr>
				<td width='140'>Status</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='status' value='pengajar' checked>Pengajar</label>
                   <label><input type=radio name='status' value='admin'>Administrator</label></td>
		    </tr>";
    }
    else{
      echo "<tr>
				<td width='140'>Status</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='status' value='pengajar'>Pengajar</label>
                   <label><input type=radio name='status' value='admin'  checked>Administrator</label></td>
		    </tr>";
    }
    echo "<tr>
				<td width='140'>Order</td>
				<td width='1'>:</td>
				<td><input type=text name='urutan' size=1 value='$r[urutan]'></td>
		    </tr></table>
			
          <div class='buttons'>
          <input class='button blue' type=submit value=Update>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></div></form>";
    }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;  
}
}
?>
