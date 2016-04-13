
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_admin/aksi_admin.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_admin = mysql_query("SELECT * FROM admin ORDER BY username");      
      echo "<div id='title'>Manajemen Administrator</div>
            <div id='content'>
          <input class='button ' type=button value='Tambah Administrator' onclick=\"window.location.href='?module=admin&act=tambahadmin';\">";
          echo "<br><br><div class='information msg'>Account administrator tidak bisa di hapus, tapi bisa di non aktifkan.</div>";
          echo "<br>
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Username</th>
			<th><center>Nama</th>
			<th><center>Alamat</th>
			<th><center>Email</th>
			<th><center>Telp/HP</th>
			<th><center>Blokir</th>
			<th><center>Aksi</th>
		</tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_admin)){
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td>$r[alamat]</td>
		         <td><a href=mailto:$r[email]>$r[email]</a></td>
		         <td>$r[no_telp]</td>
		         <td align=center>$r[blokir]</td>
             <td><a href='?module=admin&act=editadmin&id=$r[id_session]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a></td></tr>";
      $no++;
    }
    echo "</table></div>";
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

  case "pengajar":
  if ($_SESSION[leveluser]=='admin'){
      $tampil_pengajar = mysql_query("SELECT * FROM pengajar ORDER BY username_login");
    echo "<div id='title'>Manajemen Pengajar</div>
          <div id='content'>
          <input class='button ' type=button value='Tambah Pengajar' onclick=\"window.location.href='?module=admin&act=tambahpengajar';\">";
          echo "<br><br>
		 <table id='table1' class='gtable sortable'><thead>
          <tr>
		  	<th><center>No</th>
			<th><center>Nip</th>
			<th><center>Username</th>
			<th><center>Nama</th>
			<th><center>Blokir</th>
			<th><center>Aksi</th>
		</tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pengajar)){
       echo "<tr>
	   		 <td align='center'>$no</td>
             <td>$r[nip]</td>
             <td>$r[username_login]</td>
             <td>$r[nama_lengkap]</td>             
		         <td align=center>$r[blokir]</td>
             <td><a href='?module=admin&act=editpengajar&id=$r[id_pengajar]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> <a href='?module=detailpengajar&act=detailpengajar&id=$r[id_pengajar]' title='Detail'><img src='images/icons/view.png' alt='Detail' /></a> </td></tr>";
      $no++;
    }
    echo "</table></div>";
  }else{
        echo "<link href=../css/style.css rel=stylesheet type=text/css>";
        echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
  }
  break;

  case "tambahadmin":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form id='alumniForm'  method=POST action='$aksi?module=admin&act=input_admin'>
          <div id='title'>Tambah Administrator</div>
		  <div id='content'>	 
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td><input type=text name='username' class='required' title='Username harus diisi' ></td>
		    </tr>
		 	<tr>
				<td width='140'>Password</td>
				<td width='1'>:</td>
				<td><input type=password name='password' class='required' title='Password harus diisi' ></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama</td>
				<td width='1'>:</td>
				<td> <input type=text name='nama_lengkap' class='required' title='Nama harus diisi' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70></td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td> <input type=text name='no_telp' size=20></td>
		    </tr>
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><input type=radio name='blokir' value='Y'> Y
                    <input type=radio name='blokir' value='N' checked> N</td>
		    </tr>
          </table>
          <div class='buttons'>
          <input class='button ' type=submit value=Simpan>
          <input class='button ' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>";
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;

  case "tambahpengajar":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form id='alumniForm' method=POST action='$aksi?module=admin&act=input_pengajar' enctype='multipart/form-data'>
          <div id='title'>Tambah Pengajar</div>
		  <div id='content'>	 
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>NIP</td>
				<td width='1'>:</td>
				<td><input type=text name='nip' class='required' title='NIP harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama Lengkap</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_lengkap' class='required' title='Nama harus diisi' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td><input type=text name='username' class='required' title='Username harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Password</td>
				<td width='1'>:</td>
				<td><input type=password name='password' class='required' title='Password harus diisi'></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70></td>
		    </tr>
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td><input type=text name='tempat_lahir' size=50></td>
		    </tr>
		 	<tr>
				<td width='140'>Tanggal Lahir</td>
				<td width='1'>:</td>
				<td>"; 
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);
		  echo"</td> </tr>";
		   
    echo " 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td> <label><input type=radio name='jk' value=L>Laki-laki</input></label>
                     <label><input type=radio name='jk' value=P>Perempuan</input></label></td>
		    </tr>
			<tr>
				<td width='140'>Agama</td>
				<td width='1'>:</td>
				<td><select name='agama' id='select1' class='medium required' size='1'>
                                                           <option value='0' selected>-- Pilih --</option>
                                                           <option value='Islam'>Islam</option>
                                                           <option value='Kristen'>Kristen</option>
                                                           <option value='Katolik'>Katolik</option>
                                                           <option value='Hindu'>Hindu</option>
                                                           <option value='Buddha'>Buddha</option>
                                                           </select>
				</td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=20></td>
		    </tr>
		 	<tr>
				<td width='140'>Email</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Website</td>
				<td width='1'>:</td>
				<td><input type=text name='website' size=30 value='http://'></td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td><input type='file' name='fupload' id='upload'>
                   <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small></td>
		    </tr>
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td><input type=text name='jabatan' size=30></td>
		    </tr>
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'> Y</label>
                    <label><input type=radio name='blokir' value='N' checked> N </label></td>
		    </tr>
          </table>
          <div class='buttons'>
          <input class='button ' type=submit value=Simpan>
          <input class='button ' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>";
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;

  case "editadmin":
    $edit=mysql_query("SELECT * FROM admin WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action=$aksi?module=admin&act=update_admin>
          <input type=hidden name=id value='$r[id_session]'>
		  <div id='title'>Edit Administrator</div>
            <div id='content'>	 
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td><input type=text name='username' value='$r[username]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Password</td>
				<td width='1'>:</td>
				<td><input type=password name='password'>
                    <small>Apabila password tidak diubah, dikosongkan saja.</small></td>
		    </tr>
		 	<tr>
				<td width='140'>Nama</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70  value='$r[alamat]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Email</td>
				<td width='1'>:</td>
				<td> <input type=text name='email' size=30 value='$r[email]'></td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=30 value='$r[no_telp]'></td>
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
				<td><input type=radio name='blokir' value='Y'  checked> Y
                    <input type=radio name='blokir' value='N'> N</td>
		    </tr>";
    }
    
    echo "</table>
          <div class='buttons'>
          <input class='button ' type=submit value=Update>
          <input class='button ' type=button value=Batal onclick=self.history.back()>          
          </div>
          </div></form>";
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

 case "editpengajar":
    $edit=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action=$aksi?module=admin&act=update_pengajar enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_pengajar]'>         
		  <div id='title'>Edit Pengajar > $r[nama_lengkap]</div>
          <div id='content'>	 
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Nip</td>
				<td width='1'>:</td>
				<td><input type=text name='nip' value='$r[nip]'></td>
		    </tr>	 
		 	<tr>
				<td width='140'>Nama Lengkap</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_lengkap' size=30 value='$r[nama_lengkap]'></td>
		    </tr>	 
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td><input type=text name='username' value='$r[username_login]'></td>
		    </tr>	
		 	<tr>
				<td width='140'>Password</td>
				<td width='1'>:</td>
				<td><input type=password name='password'> 
                    <small>Apabila password tidak diubah, dikosongkan saja</small></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70 value='$r[alamat]'></td>
		    </tr>		
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td> <input type=text name='tempat_lahir' size=60 value='$r[tempat_lahir]'></td>
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
              echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='jk' value='L' checked>Laki - Laki</label>
                    <label><input type=radio name='jk' value='P'>Perempuan</label></td>
		    </tr>";
          }else{
              echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='jk' value='L' >Laki - Laki</label>
                    <label><input type=radio name='jk' value='P' checked>Perempuan</label></td>
		    </tr>";
          }
     echo"	
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
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=20 value='$r[no_telp]'></td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30 value='$r[email]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Website</td>
				<td width='1'>:</td>
				<td><input type=text name='website' size=30 value='$r[website]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td>";
            if ($r[foto]!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_pengajar/medium_$r[foto]'>
                    <div class='links'>
                    <a href='../foto_pengajar/medium_$r[foto]' rel='facebox'>View</a>
		    <div>
                    </li>
                    </ul></td>";
		    
          }echo "</tr> 
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td><input type=text name='jabatan' value='$r[jabatan]' size=50></td>
		    </tr>
		 	<tr>
				<td width='140'>Ganti Foto</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40>
                   <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
				   <small>Apabila foto tidak diubah, dikosongkan saja</small></td>
		    </tr>";
          if ($r[blokir]=='N'){

           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'> Y<label>
                    <label><input type=radio name='blokir' value='N' checked> N <label></td>
		    </tr>";
            }
            else{
           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'  checked> Y<label>
                    <label><input type=radio name='blokir' value='N'> N <label></td>
		    </tr>";
            }
          echo "</table>
          <div class='buttons'>
          <input class='button ' type=submit value=Update>
          <input class='button ' type=button value=Batal onclick=self.history.back()>
          </div>
          </div></form>";
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        $edit=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_SESSION[idpengajar]'");
        $r=mysql_fetch_array($edit);
     echo "<form method=POST action=$aksi?module=admin&act=update_pengajar2 enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_pengajar]'>          
         <div id='title'>Edit Profil</div>
          <div id='content'>
		  <table class='data' cellpadding='5'  width='250'>
		 	
		 	<tr>
				<td width='140'>Nip</td>
				<td width='1'>:</td>
				<td><input type=text name='nip' value='$r[nip]'></td>
		    </tr>	 
		 	<tr>
				<td width='140'>Nama Lengkap</td>
				<td width='1'>:</td>
				<td><input type=text name='nama_lengkap' size=30 value='$r[nama_lengkap]'></td>
		    </tr>	 
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td><input type=text name='username' value='$r[username_login]'></td>
		    </tr>	
		 	<tr>
				<td width='140'>Password</td>
				<td width='1'>:</td>
				<td><input type=text name='password'> 
                    <small>Apabila password tidak diubah, dikosongkan saja</small></td>
		    </tr>
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td><input type=text name='alamat' size=70 value='$r[alamat]'></td>
		    </tr>		
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td> <input type=text name='tempat_lahir' size=60 value='$r[tempat_lahir]'></td>
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
              echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='jk' value='L' checked>Laki - Laki</label>
                    <label><input type=radio name='jk' value='P'>Perempuan</label></td>
		    </tr>";
          }else{
              echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='jk' value='L' >Laki - Laki</label>
                    <label><input type=radio name='jk' value='P' checked>Perempuan</label></td>
		    </tr>";
          }
     echo"	
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
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td><input type=text name='no_telp' size=20 value='$r[no_telp]'></td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><input type=text name='email' size=30 value='$r[email]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Website</td>
				<td width='1'>:</td>
				<td><input type=text name='website' size=30 value='$r[website]'></td>
		    </tr>
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td>";
            if ($r[foto]!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_pengajar/medium_$r[foto]'>
                    <div class='links'>
                    <a href='../foto_pengajar/medium_$r[foto]' rel='facebox'>View</a>
		    <div>
                    </li>
                    </ul></td>";
		    
          }echo "</tr> 
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td><input type=text name='jabatan' value='$r[jabatan]' size=50></td>
		    </tr>
		 	<tr>
				<td width='140'>Ganti Foto</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=40>
                   <small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
				   <small>Apabila foto tidak diubah, dikosongkan saja</small></td>
		    </tr>";
          if ($r[blokir]=='N'){

           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'> Y<label>
                    <label><input type=radio name='blokir' value='N' checked> N <label></td>
		    </tr>";
            }
            else{
           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td><label><input type=radio name='blokir' value='Y'  checked> Y<label>
                    <label><input type=radio name='blokir' value='N'> N <label></td>
		    </tr>";
            }
          echo "</table>
          <div class='buttons'>
          <input class='button ' type=submit value=Update>
          <input class='button ' type=button value=Batal onclick=self.history.back()>
          </div></div></form>";
    }
    break;

case "detailpengajar":
    $detail=mysql_query("SELECT * FROM pengajar WHERE id_pengajar='$_GET[id]'");
    $r=mysql_fetch_array($detail);
    $tgl_lahir   = tgl_indo($r[tgl_lahir]);

    if ($_SESSION[leveluser]=='admin'){
    echo "<div id='title'>Detail Pengajar > $r[nama_lengkap]</div>
          <div id='content'>	 
		  <table class='data' cellpadding='5'  width='250'>
		 	<tr>
				<td width='140'>Nip</td>
				<td width='1'>:</td>
				<td>$r[nip]</td>
		    </tr>	 
		 	<tr>
				<td width='140'>Nama Lengkap</td>
				<td width='1'>:</td>
				<td> $r[nama_lengkap]</td>
		    </tr>	
		 	<tr>
				<td width='140'>Username</td>
				<td width='1'>:</td>
				<td>$r[username_login]</td>
		    </tr>	
		 	<tr>
				<td width='140'>Alamat</td>
				<td width='1'>:</td>
				<td>$r[alamat]</td>
		    </tr>	
		 	<tr>
				<td width='140'>Tempat Lahir</td>
				<td width='1'>:</td>
				<td>$r[tempat_lahir]</td>
		    </tr>	
		 	<tr>
				<td width='140'>Tanggal Lahir</td>
				<td width='1'>:</td>
				<td>$tgl_lahir</td>
		    </tr>";
          if ($r[jenis_kelamin]=='P'){
           echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td>Perempuan</td>
		    </tr>";
            }
            else{
           echo "
		 	<tr>
				<td width='140'>Jenis Kelamin</td>
				<td width='1'>:</td>
				<td>Laki-Laki</td>
		    </tr>";
            }echo"
		 	<tr>
				<td width='140'>Agama</td>
				<td width='1'>:</td>
				<td>$r[agama]</td>
		    </tr>
		 	<tr>
				<td width='140'>No.Telp</td>
				<td width='1'>:</td>
				<td>$r[no_telp]</td>
		    </tr>
		 	<tr>
				<td width='140'>E-mail</td>
				<td width='1'>:</td>
				<td><a href=mailto:$r[email]>$r[email]</a></td>
		    </tr>
		 	<tr>
				<td width='140'>Website</td>
				<td width='1'>:</td>
				<td> <a href=http://$r[website] target=_blank>$r[website]</a></td>
		    </tr>
		 	<tr>
				<td width='140'>Jabatan</td>
				<td width='1'>:</td>
				<td>$r[jabatan]</td>
		    </tr>";
          if ($r[blokir]=='N'){
           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td>N</td>
		    </tr>";
            }
            else{
           echo "
		 	<tr>
				<td width='140'>Blokir</td>
				<td width='1'>:</td>
				<td>Y</td>
		    </tr>";
            }
          echo "
		 	<tr>
				<td width='140'>Foto</td>
				<td width='1'>:</td>
				<td>
          <ul class='photos sortable'>
                    <li>";if ($r[foto]!=''){
              echo "<img src='../foto_pengajar/medium_$r[foto]'>
              <div class='links'>
                    <a href='../foto_pengajar/medium_$r[foto]' rel='facebox'>View</a>
              <div>
              </li>
              </ul></td>
		    </tr>";
          }
          echo "</table>
          <div class='buttons'>
          <input class='button ' type=button value=Kembali onclick=self.history.back()>
          </div>
          </div></form>";
          
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
        echo "<div id='title'>Detail Pengajar</div>
          <div id='content'>
          <table id='table1' class='gtable sortable'>
          <tr><td rowspan='13'>";if ($r[foto]!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_pengajar/medium_$r[foto]'>
                    <div class='links'>
                    <a href='../foto_pengajar/medium_$r[foto]' rel='facebox'>View</a>
                    <div>
                    </li>
                    </ul>";
          }echo "</td><td>Nip</td>  <td> : $r[nip]</td><tr>
          <tr><td>Nama Lengkap</td> <td> : $r[nama_lengkap]</td></tr>          
          <tr><td>Alamat</td>       <td> : $r[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $r[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($r[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>        <td> : $r[agama]</td></tr>
          <tr><td>No.Telp/HP</td>   <td> : $r[no_telp]</td></tr>
          <tr><td>E-mail</td>       <td> : <a href=mailto:$r[email]>$r[email]</a></td></tr>
          <tr><td>Website</td>      <td> : <a href=http://$r[website] target=_blank>$r[website]</a></td></tr>
          <tr><td>Jabatan</td>      <td> : $r[jabatan]</td></tr>
          <tr><td>Aksi</td>         <td> : <input class='button ' type=button value=Kembali onclick=self.history.back()></td></tr>";
           echo"</table></div>";
    }else{
        echo"<div id='title'>Detail Guru</div><div id='content'>";
        echo "<table id='table1' class='gtable sortable'>
          <tr><td rowspan='12'>";
		  if ($r[foto]!=''){
              echo "<img src='foto_pengajar/medium_$r[foto]'>";
          }echo "</td><td>Nip</td>  <td> : $r[nip]</td><tr>
          <tr><td>Nama Lengkap</td> <td> : $r[nama_lengkap]</td></tr>          
          <tr><td>Alamat</td>       <td> : $r[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $r[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($r[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>        <td> : $r[agama]</td></tr>
          <tr><td>No.Telp/HP</td>   <td> : $r[no_telp]</td></tr>
          <tr><td>E-mail</td>       <td> : <a href=mailto:$r[email]>$r[email]</a></td></tr>
          <tr><td>Website</td>      <td> : <a href=http://$r[website] target=_blank>$r[website]</a></td></tr>
          <tr><td>Jabatan</td>      <td> : $r[jabatan]</td></tr>
          </table><input type=button class='tombol' value='Kembali'
                              onclick=self.history.back()></div>";
    }
    break;
}
}
?>
