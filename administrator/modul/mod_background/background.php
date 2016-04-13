   
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_background/aksi_background.php";
switch($_GET[act]){
  // Tampil background
  default:
    echo "<div id='title'>Background User</div>
		  <div id='content'>    
		<input type=button  class=tombol value='Tambah' onclick=location.href='?module=background&act=tambahbackground'>
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
			  <th>No</th>
			  <th>Judul</th>
			  <th>Tgl. Posting</th>
			  <th>Aksi</th>
		  </tr></thead>";
    $tampil=mysql_query("SELECT * FROM background ORDER BY id_background DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td>$tgl</td>
                <td><a title='Edit' href=?module=background&act=editbackground&id=$r[id_background]><img src='images/icons/edit.png' alt='Edit' /></a>
<a title='Delete' href=$aksi?module=background&act=hapus&id=$r[id_background]><img src='images/icons/cross.png' alt='Delete' /></a>
		        </tr>";
    $no++;
    }
    echo "</table></div>";
    break;
  
  case "editbackground":
    $edit = mysql_query("SELECT * FROM background WHERE id_background='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div id='title'>Edit background</div>
          <form  method=POST enctype='multipart/form-data' action=$aksi?module=background&act=update>
          <input type=hidden name=id value=$r[id_background]>
		  <div id='content'>           
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><input type=text name='judul' size=30 value='$r[judul]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Gambar</td>
				<td width='1'>:</td>
				<td> <img src='../foto_background/$r[gambar]' height=150 width=220></td>
		    </tr>
		 	<tr>
				<td width='140'>Ganti Gambar</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=30> *)
				*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
		    </tr>
          </table>
		  <input type=submit class='button blue' value=Update>
                    <input type=button class='button blue' value=Batal onclick=self.history.back()></div></form>";
    break;  
  case "tambahbackground":
    echo "<div id='title'>Tambah Background</div>
		  <div id='content'>
          <form id='alumniForm' method=POST action='$aksi?module=background&act=input' enctype='multipart/form-data'>
           
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Judul</td>
				<td width='1'>:</td>
				<td><input type=text name='judul' class='required' title='Judul harus diisi'  size=30 ></td>
		    </tr>
		 	<tr>
				<td width='140'>Gambar</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40></td>
		    </tr>
			</table>
          <input type=submit class=tombol value=Simpan>
          <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </form></div>";
     break;
}
}
?>
