<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

include "../../../configurasi/class_paging.php";

$aksi="modul/mod_siswa/aksi_siswa.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil Siswa
  default:
    if ($_SESSION[leveluser]=='admin'){

     $p      = new paging_paging;
     $batas  = 20;
     $posisi = $p->cariPosisi($batas);

      $tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas LIMIT $posisi,$batas");
      echo "<div id='title'>Manajemen Siswa</div>
          <div id='content'>
          <input class='button blue' type=button value='Tambah Siswa' onclick=\"window.location.href='?module=siswa&act=tambahsiswa';\">";
      echo "<br><br><div class='information msg'>Siswa tidak bisa di hapus, tapi bisa di non aktifkan.</div>";
      echo "<br>
		 <table id='table1' class='gtable sortable''><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Nis</th>
			<th><center>Username</th>
			<th><center>Kelas</th>
			<th><center>Jenis Kelamin</th>
            <th><center>Blokir</th>
			<th><center>Aksi</th>
		</tr></thead>";
      $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil_siswa)){
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[nis]</td>
             <td>$r[username_login]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</a></td>";
             }
             echo"<td><p align='center'>$r[jenis_kelamin]</p></td>             
             <td><p align='center'>$r[blokir]</p></td>
             <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> 			 <a href='?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a>
 </td></tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM siswa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "</div></div>";
    }
    break;

case "lihatmurid":
    if ($_SESSION[leveluser]=='admin'){
    $p      = new paging_lihatmurid;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo "<div id='title'>Daftar Siswa</div>
          <div id='content'>
		 <table id='table1' class='gtable sortable''><thead>
          <tr>	
		  	<th><center>No</th>
			<th><center>Nis</th>
			<th><center>Nama</th>
			<th><center>Kelas</th>
			<th><center>Jenis Kelamin</th>
            <th><center>Blokir</th>
			<th><center>Aksi</th>
		</tr></thead>";
     $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
	   		  <td align='center'>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>
             ";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$k[id_kelas]>$k[nama]</a></td>";
             }
             echo "<td><p align='center'>$r[jenis_kelamin]</p></td>             
             <td><p align='center'>$r[blokir]</p></td>
             <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> <a href='?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a>
        </td></tr>";
      $no++;
    }
    echo "</table>";
    
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM siswa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

   // echo "<br><div id=paging>$linkHalaman</div><br>";
    echo "<input class='button blue' type=button value=Kembali onclick=self.history.back()></dl></div>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
    $p      = new paging_lihatmurid;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo "<div id='title'>Daftar Siswa</div>
          <div id='content'>";
    echo "<table id='table1' class='gtable sortable'><thead>
          <tr>
	
		  	<th><center>No</th>
			<th><center>Nis</th>
			<th><center>Nama</th>
			<th><center>Kelas</th>
			<th><center>Jenis Kelamin</th>
           <th><center>Aksi</th>
		 </tr></thead>";
     $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[nis]</td>
             <td>$r[nama_lengkap]</td>";
             $kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
             while($k=mysql_fetch_array($kelas)){
             echo"<td><a href=?module=kelas&act=detailkelas&id=$k[id_kelas]>$k[nama]</a></td>";
             }
             echo "<td><p align='center'>$r[jenis_kelamin]</p></td>                       
             <td><center><a href='?module=detailsiswa&act=detailsiswa&id=$r[id_siswa]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a></center>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM siswa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br><div id=paging>$linkHalaman</div><br>
    <input type=button class='button blue' value=Kembali onclick=self.history.back()></div>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    else{
    $p      = new paging_lihatmurid;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
    $cek_siswa = mysql_num_rows($tampil);
    if(!empty($cek_siswa)){
    echo"<div id='title'>Daftar Teman</div><div id='content'>";
    echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th><center>No</th><th><center>Nis</th><th><center>Nama</th><th><center>Jenis Kelamin</th><th><center>Th Masuk</th>
           <th><center>Aksi</th></tr></thead>";
     $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
	   			 <td align='center'>$no</td>
				 <td>$r[nis]</td>
				 <td>$r[nama_lengkap]</td>             
				 <td>$r[jenis_kelamin]</td>
				 <td>$r[th_masuk]</td>
             	 <td><input type=button class='tombol' value='Detail Siswa'
                 onclick=\"window.location.href='?module=siswa&act=detailsiswa&id=$r[id_siswa]';\">";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM siswa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>$linkHalaman</div><br><input type=button title='Kembali' class='tombol' value='Kembali'
          onclick=self.history.back()></ul></div>";
    }else{
        echo "<script>window.alert('Tidak ada siswa dikelas ini');
            window.location=(href='?module=kelas')</script>";
    }
    }
    break;

case "tambahsiswa":
    if ($_SESSION[leveluser]=='admin'){
        $tampil = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
       
        echo "
          <form id='alumniForm'  method=POST action='$aksi?module=siswa&act=input_siswa' enctype='multipart/form-data'>
          <div id='title'>Tambah Siswa</div>
		  <div id='content'>          
	 	  <table class='data' cellpadding='5'  width='250'>		  
		 	<tr>
				<td width='140'>NIS</td>
				<td width='1'>:</td>
				<td><input type=text name='nis' class='required' title='Nis harus diisi'></td>
		    </tr>		  
		 	<tr>
				<td width='140'>Nama Lengkap</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_lengkap' class='required' title='Nama harus diisi' size=30></td>
		    </tr>	  
		 	<tr>
				<td width='140'>Username Login</td>
				<td width='1'>:</td>
				<td><input type=text name='username' class='required' title='Username harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Password Login</td>
				<td width='1'>:</td>
				<td><input type=password name='password' class='required' title='Password harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><select name='id_kelas'>
                                           <option value=0 selected>--pilih--</option>";
                                           $tampil=mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                                           while($r=mysql_fetch_array($tampil)){
                                           echo "<option value=$r[id_kelas]>$r[nama]</option>";
                                           }echo "</select>
				</td>
		    </tr>
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td><input type=text name='jabatan' size=50></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=90></td>
		    </tr>
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td><input type=text name='tempat_lahir' size=50></td>
		    </tr>
		 	<tr>
				<td width='140'>Tanggal Lahir</td>
				<td width='1'>:</td>
				<td>: ";
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);

    echo "</td></tr>
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='jk' value='L'>Laki - Laki</input></label>
                    <label><input type=radio name='jk' value='P'>Perempuan</input></label></td>
		    </tr>
		 	<tr>
				<td width='140'>Agama</td>
				<td width='1'>:</td>
				<td><select name=agama>
                                           <option value='0' selected>--pilih--</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select>
				</td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ayah/Wali</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_ayah' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ibu</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_ibu' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Tahun Masuk</td>
				<td width='1'>:</td>
				<td><input type=text name='th_masuk' size=10></td>
		    </tr>
		 	<tr>
				<td width='140'>Email</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=20></td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40>
                    <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
			    </td>
		    </tr>
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'> Y</label>
                    <label><input type=radio name='blokir' value='N' checked> N </label>
			    </td>
		    </tr>
          </table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form></div>";
    }
    break;

  case "nis_ada":
     if ($_SESSION[leveluser]=='admin'){
         echo "<span class='judulhead'><p class='garisbawah'>NIS SUDAH PERNAH DIGUNAKAN<br>
               <input type=button value=Kembali onclick=self.history.back()></p></span>";
     }
     break;

  case "editsiswa":
    $edit=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
    $kelas = mysql_fetch_array($get_kelas);

    if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action=$aksi?module=siswa&act=update_siswa enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_siswa]'>
		  <div id='title'>Edit Siswa</div>
		  <div id='content'>   
	 	  <table class='data' cellpadding='5'  width='250'>		  
		 	<tr>
				<td width='140'>NIS</td>
				<td width='1'>:</td>
				<td><input type=text name=nis value='$r[nis]'></td>
		    </tr>	  
		 	<tr>
				<td width='140'>Nama</td>
				<td width='1'>:</td>
				<td> <input type=text name='nama' value='$r[nama_lengkap]' size=70></td>
		    </tr>	
		 	<tr>
				<td width='140'>Username Login</td>
				<td width='1'>:</td>
				<td><input type=text name='username' value='$r[username_login]'></td>
		    </tr>	
		 	<tr>
				<td width='140'>Password Login</td>
				<td width='1'>:</td>
				<td> <input type=password name='password' size=30>
				<small>Apabila password tidak diubah, dikosongkan saja</small></td>
		    </tr>	
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td> <select name='id_kelas'>
                     <option value=$kelas[id_kelas] selected>$kelas[nama]</option>"; 
					 					$tampil=mysql_query("SELECT * FROM kelas ORDER BY nama");
                                           while($k=mysql_fetch_array($tampil)){
                                           echo "<option value=$k[id_kelas]>$k[nama]</option>";
                                           }echo "</select></td>
		    </tr>	
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td> <input type=text name='jabatan' size=50 value='$r[jabatan]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70 value='$r[alamat]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td><input type=text name='tempat_lahir' size=50 value='$r[tempat_lahir]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Tanggal Lahir</td>
				<td width='1'>:</td>
				<td>";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</td></tr>";
          if ($r[jenis_kelamin]=='L'){
              echo "<tr>
						<td width='140'>Jenis Kelamin</td>
						<td width='1'>:</td>
						<td><input type=radio name='jk' value='L' checked>Laki - Laki</label>
                            <input type=radio name='jk' value='P'>Perempuan</td>
					</tr>";
          }else{
              echo "<tr>
						<td width='140'>Jenis Kelamin</td>
						<td width='1'>:</td>
						<td><input type=radio name='jk' value='L'>Laki - Laki</label>
                           <input type=radio name='jk' value='P' checked>Perempuan</td>
					</tr>";
          }      
          echo "
		 	<tr>
				<td width='140'>Agama</td>
				<td width='1'>:</td>
				<td><select name=agama>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ayah</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_ayah' size=30 value='$r[nama_ayah]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ibu</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_ibu' size=30 value='$r[nama_ibu]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Tahun Masuk</td>
				<td width='1'>:</td>
				<td><input type=text name='th_masuk' size=10 value='$r[th_masuk]'></td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30 value='$r[email]'></td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp / HP</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=20 value='$r[no_telp]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td>";  if ($r[foto]!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_siswa/medium_$r[foto]'>
                    <div class='links'>
                    <a href='../foto_siswa/medium_$r[foto]' rel='facebox'>View</a>
		    <div>
                    </li>
                    </ul></td>";
          
          }echo "</tr>
		 	<tr>
				<td width='140'>Ganti Foto</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40>
                                                <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
                                                <small>Apabila foto tidak diganti, dikosongkan saja</small></td>
		    </tr>";
    if ($r[blokir]=='N'){
      echo "<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><input type=radio name='blokir' value='Y'> Y
                   <input type=radio name='blokir' value='N' checked> N</td>
		   </tr>";
    }
    else{
      echo "<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><input type=radio name='blokir' value='Y' checked> Y
                   <input type=radio name='blokir' value='N'> N </td>
			</tr>";
    }

    echo "</table>
          <div class='buttons'>
          <input class='button blue' type=submit value=Update>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div></div>
          ";
    }
    elseif ($_SESSION[leveluser]=='siswa') {
     echo"<div id='title'>Edit Profil </div><div id='content'>";
     echo"<form method=POST action=$aksi_siswa?module=siswa&act=update_profil_siswa enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_siswa]'>
      	 <table id='table1' class='gtable sortable'>
          <tr><td>Nis</td>     <td> : <input type=text name=nis value='$r[nis]' ></td></tr>
          <tr><td>Nama</td>     <td> : <input type=text name='nama' value='$r[nama_lengkap]' size=40></td></tr>          
          <tr><td>Alamat</td>       <td> : <input type=text name='alamat' size=80 value='$r[alamat]'></td></tr>
          <tr><td>Tempat Lahir</td> <td> : <input type=text name='tempat_lahir' size=60 value='$r[tempat_lahir]'></td></tr>
          <tr><td>Tanggal Lahir</td><td> : ";
          $get_tgl=substr("$r[tgl_lahir]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_lahir]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_lahir]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</td></tr>";
          if ($r[jenis_kelamin]=='L'){
              echo "<tr><td>Jenis Kelamin</td><td> : <input type=radio name='jk' value='L' checked>Laki - Laki
                                           <input type=radio name='jk' value='P'>Perempuan</tr></tr>";
          }else{
              echo "<tr><td>Jenis Kelamin</td><td> : <input type=radio name='jk' value='L'>Laki - Laki
                                           <input type=radio name='jk' value='P' checked>Perempuan</tr></tr>";
          }
          echo "<tr><td>Agama</td>        <td> : <select name=agama>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></td></tr>
          <tr><td>Nama Ayah/Wali</td> <td> : <input type=text name='nama_ayah' size=40 value='$r[nama_ayah]'></td></tr>
          <tr><td>Nama Ibu</td>     <td> : <input type=text name='nama_ibu' size=40 value='$r[nama_ibu]'></td></tr>
          <tr><td>Tahun Masuk</td>  <td> : <input type=text name='th_masuk' size=5 value='$r[th_masuk]'> *) Harus Angka</td></tr>
          <tr><td>Email</td>        <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No Telp/HP</td>   <td> : <input type=text name='no_telp' size=20 value='$r[no_telp]'></td></tr>
          <tr><td>Foto</td>   <td> : ";
            if ($r[foto]!=''){
              echo "<img src='foto_siswa/medium_$r[foto]'>";
          }echo "</td></tr>
          <tr><td>Ganti Foto</td>       <td> : <input type=file name='fupload' size=40>
                                           <br>**) Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px<br>
                                                ***) Apabila foto tidak diganti, dikosongkan saja</td></tr>";   
    echo "<tr><td>Jabatan</td>      <td> : <input type=text name='jabatan' size=70 value='$r[jabatan]'></td></tr>
          </table><input type=submit class='tombol' value='Update'>
                            <input type=button class='tombol' value='Batal'
                            onclick=self.history.back()>
          </div>";
    }
    break;

    
 case "detailsiswa":
    if ($_SESSION[leveluser]=='admin'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);
       
       echo "<div id='title'>Detail Siswa</div>
		  <div id='content'>    
	 	  <table class='data' cellpadding='5'  width='250'>		  
		 	<tr>
				<td width='140'>NIS</td>
				<td width='1'>:</td>
				<td>$siswa[nis]</td>
		    </tr>		  
		 	<tr>
				<td width='140'>Nama</td>
				<td width='1'>:</td>
				<td>$siswa[nama_lengkap]</td>
		    </tr>
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td>$siswa[username_login]</td>
		    </tr>
		 	<tr>
				<td width='140'>Kelas</td>
				<td width='1'>:</td>
				<td><a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas]>$kelas[nama]</a></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td>$siswa[alamat]</a></td>
		    </tr>
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td>$siswa[jabatan]</td>
		    </tr>
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td>$siswa[tempat_lahir]</td>
		    </tr>
		 	<tr>
				<td width='140'>Tanggal Lahir</td>
				<td width='1'>:</td>
				<td>$tgl_lahir</td>
		    </tr>";
          if ($siswa[jenis_kelamin]=='P'){
           echo "<td>Jenis Kelamin</td> <td width='1'>:</td> <td>Perempuan</td>";
            }
            else{
           echo "<td>Jenis kelamin</td> <td width='1'>:</td> <td>Laki - Laki </td>";
            }echo"
		 	<tr>
				<td width='140'>Agama</td>
				<td width='1'>:</td>
				<td> $siswa[agama]</td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ayah</td>
				<td width='1'>:</td>
				<td>$siswa[nama_ayah]</td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Ibu</td>
				<td width='1'>:</td>
				<td>$siswa[nama_ibu]</td>
		    </tr>
		 	<tr>
				<td width='140'>Tahun Masuk</td>
				<td width='1'>:</td>
				<td>$siswa[th_masuk]</td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><a href=mailto:$siswa[email]>$siswa[email]</a></td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td> $siswa[no_telp]</td>
		    </tr>
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td>$siswa[blokir]</td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td> <ul class='photos sortable'>
              <li>";if ($siswa[foto]!=''){
              echo "<img src='../foto_siswa/medium_$siswa[foto]'>
              <div class='links'>
                    <a href='../foto_siswa/medium_$siswa[foto]' rel='facebox'>View</a>
              <div>
              </li>
              </ul></td>";
          }
          echo "</table>
          <div class='buttons'>
          <input class='button blue' type=button value=Kembali onclick=self.history.back()>
          </div>
          </div>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

       echo "<div id='title'>Detail Siswa</div>
	   	<div id='content'>
       <table id='table1' class='gtable sortable'>
          <tr><td rowspan='15'>";if ($siswa[foto]!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_siswa/medium_$siswa[foto]'>
                    <div class='links'>
                    <a href='../foto_siswa/medium_$siswa[foto]' rel='facebox'>View</a>
                    <div>
                    </li>
                    </ul>";
          }echo "</td><td>Nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>          
          <tr><td>Kelas</td>              <td> : <a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas]>$kelas[nama]</td></tr>
          <tr><td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($siswa[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><td>Aksi</td>               <td> : <input type=button class='button blue' value=Kembali onclick=self.history.back()></td></tr>";
          echo"</table></div>";
    }
    elseif ($_SESSION[leveluser]=='siswa'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

      echo"<div id='title'>Detail Siswa</div><div id='content'>
       		<table id='table1' class='gtable sortable'>
             <tr><td rowspan='14'>";if ($siswa[foto]!=''){
              echo "<img src='foto_siswa/medium_$siswa[foto]'>";
          }echo "</td><td>Nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>          
          <tr><td>Kelas</td>              <td> : $kelas[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($siswa[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><Td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>";
          echo"</table><input type=button class='tombol' value='Kembali'
          onclick=self.history.back()></div>";

    }
    break;

case "detailprofilsiswa":
    if ($_SESSION[leveluser]=='siswa'){
       $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
       $siswa=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

       $get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
       $kelas = mysql_fetch_array($get_kelas);

      echo"<div id='title'>Detail Siswa</div>
	  	<div id='content'>
       		<table id='table1' class='gtable sortable'>
             <tr><td rowspan='14'>";if ($siswa[foto]!=''){
              echo "<img src='foto_siswa/medium_$siswa[foto]'>";
          }echo "</td><td>Nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>
          <tr><td>Kelas</td>              <td> : $kelas[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($siswa[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>";
          echo"</table><input type=button class='tombol' value='Edit Profil' onclick=\"window.location.href='?module=siswa&act=editsiswa&id=$siswa[id_siswa]';\"></div>";
    }
    break;

case "detailaccount":
    if ($_SESSION[leveluser]=='siswa'){
        $detail=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
        $siswa=mysql_fetch_array($detail);
        echo"<form method=POST action=$aksi_siswa?module=siswa&act=update_account_siswa>";
        echo"<div id='title'>Edit Akun</div>
		<div id='content'>
     	<table id='table1' class='gtable sortable'>
        <tr><td>Username</td><td>:<input type=text name='username' size='40'></td></tr>
        <tr><td>Password</td><td>:<input type=password name='password' size='40'></td></tr>
        <tr><td colspan=2>*) Apabila Username tidak diubah di kosongkan saja.</td></tr>
        <tr><td colspan=2>**) Apabila Password tidak diubah di kosongkan saja.</td></tr>
        </table><input type=submit class='tombol' value='Update'></div>";
    }
    break;
}
}
?>
