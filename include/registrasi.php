<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>e-Learning | Daftar</title>
	<link href="assets/images/favicon.PNG" rel="shortcut icon" type="image/x-icon" />
	<style>@import "assets/css/login_user.css";</style>
	<meta name="author" content="Nava Gia Ginasta" />
	<script type="text/javascript" src="administrator/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="administrator/js/cufon-yui.js"></script>
    <script type="text/javascript" src="administrator/js/Delicious_500.font.js"></script>
	<script>
	$(document).ready(function(){
   $("#nis").change(function(){
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html(' <img src="administrator/images/icons/loading.gif" width="20" height="20"> checking ...');
    var nis = $("#nis").val();

    $.ajax({
     type:"POST",
     url:"checking_nis.php",
     data: "nis=" + nis,
     success: function(data){
       if(data==0){
          $("#pesan").html('<img src="administrator/images/icons/tick.png">');
 	        $('#nis').css('border', '3px #090 solid');
       }
       else{
          $("#pesan").html('<img src="administrator/images/icons/cross.png"> Nis sudah digunakan!');
 	        $('#nis').css('border', '3px #C33 solid');
                $("#nis").val('');
       }
     }
    });
	})
});
</script>
<script>
$(document).ready(function(){
   $("#email").change(function(){
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan_email').html(' <img src="administrator/images/icons/loading.gif" > checking ...');
    var email = $("#email").val();

    $.ajax({
     type:"POST",
     url:"checking_email.php",
     data: "email=" + email,
     success: function(data){
       if(data==0){
          $("#pesan_email").html('<img src="administrator/images/icons/tick.png">');
 	        $('#email').css('border', '3px #090 solid');
       }
       else{
          $("#pesan_email").html('<img src="administrator/images/icons/cross.png"> Email sudah digunakan!');
 	        $('#email').css('border', '3px #C33 solid');
                $("#email").val('');
       }
     }
    });
	})
});
</script>
<script language="javascript">
function check_radio(radio)
    {
	// memeriksa apakah radio button sudah ada yang dipilih
	for (i = 0; i < radio.length; i++)
	{
		if (radio[i].checked === true)
		{
			return radio[i].value;
		}
	}
	return false;
    }
    
function validasi(form){
  if (form.nis.value == ""){
      alert('Nis Masih Kosong!');
      form.nis.focus();
      return (false);
  }
  if (form.nama.value == ""){
      alert('Nama Masih Kosong!');
      form.nama.focus();
      return (false);
  }
  
  if (form.username_login.value == ""){
      alert('Username Masih Kosong!');
      form.username_login.focus();
      return (false);
  }
  if (form.password_login.value == ""){
      alert('Password Masih Kosong!');
      form.password_login.focus();
      return (false);
  }
  if (form.email.value == ""){
      alert('Email Masih Kosong!');
      form.email.focus();
      return (false);
  }
  pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!pola_email.test(form.email.value)){
        alert ('Penulisan Email tidak valid');
        form.email.focus();
        return false;
        }  
  if (form.kelas.value == "pilih"){
      alert('Kelas Masih Kosong!');
      return (false);
  }
  if (form.alamat.value == ""){
      alert('Alamat Masih Kosong!');
      form.alamat.focus();
      return (false);
  }
  if (form.tempat_lahir.value == ""){
      alert('Tempat Lahir Masih Kosong!');
      form.tempat_lahir.focus();
      return (false);
  }
  var radio_val = check_radio(form.jk);
	if (radio_val === false)
	{
		alert("Anda belum memilih Jenis Kelamin!");
                return false;
	}
 
  if (form.agama.value == "pilih"){
      alert('Anda belum memilih Agama!');
      return (false);
  }
  if (form.nama_ayah.value == ""){
      alert('Nama Ayah/Wali Masih Kosong!');
      form.nama_ayah.focus();
      return (false);
  }
  

   return (true);
}
</script>
</head>
<body><div id="containerDaftar">
	<div id="wrap">
		<div id="main">
			<div id="title">Form Daftar</div>
				<div id="content">
			<table width="374"> 
			<form method="POST"action="input_registrasi.php" onSubmit="return validasi(this)">
            <tr>
            	<td>Nis :</td>
            </tr>
			<tr>
                <td width="291"><input type="text" class="input"  name="nis" size="20" id="nis"/><span id="pesan"></span></td>
            </tr>
            <tr>
            	<td>Nama Lengkap :</td>
            </tr>
            <tr>
                <td><input type="text" name="nama" class="input"size="40"/></td>
            </tr>
            <tr>
            	<td>Username :</td>
            </tr>
            <tr>
                <td><input type="text" name="username_login" class="input"size="40"/></td>
            </tr>
            <tr>
            	<td>Password :</td>
            </tr>
            <tr>
                <td><input type="password" name="password_login" class="input"size="40"/></td>
            </tr>
            <tr>
            	<td>E-mail :</td>
            </tr>
            <tr>
                <td><input type="text" name="email" class="input" size="40" id="email"/><span id="pesan_email"></span></td>
            </tr>
            <tr>
            	<td>Kelas :</td>
            </tr>
            <tr>
                <?php
                             include "configurasi/koneksi.php";
                           $kelas = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
                          echo "<td><select name='kelas' class='input'>
                                      <option value='pilih' selected>--Pilih--</option>";
                         while ($k=mysql_fetch_array($kelas)){
                                     echo "<option value='$k[id_kelas]'>$k[nama]</option>";
                            }
                         echo "</select></td>";
                   ?>
            </tr>
           <!-- <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" class="textarea" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
				<td><input type="text" name="tempat_lahir" class="input" size="40"/></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td> <?php
                            include "configurasi/fungsi_combobox.php";
                            include "configurasi/library.php";
							include "configurasi/fungsi_thumb.php";
                            combotgl(1,31,'tgl_lahir',$tgl_skrg);
                     		combonamabln(1,12,'bln_lahir',$bln_sekarang);
                            combothn(1950,$thn_sekarang,'thn_lahir',$thn_sekarang);
                            echo "</td><class='input'>";
                     ?>
                </td>
             </tr>
             <tr>
               	<td>Jenis kelamin</td>
               	<td><input type="radio" name="jk" value="L">Laki - Laki
                   <input type="radio" name="jk" value="P">Perempuan</td>
             </tr>
                <td>Agama</td>
                <td><select name="agama" class="input">
                    <option value="pilih" selected>--Pilih--</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="katolik">Katolik</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option></td>
            </tr>
            <tr>
                <td>Nama Ayah/Wali</td>
				<td><input type="text" name="nama_ayah" class="input" size="40"/></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
				<td><input type="text" name="nama_ibu" class="input" size="40"/></td>
            </tr>-->
            <tr>
            	<td>Tahun Masuk :</td>
            </tr>
            <tr>
                <td><?php combothn(2000,$thn_sekarang,'thn_masuk',$thn_sekarang); echo "</td>"; ?>
             </tr>
             <tr>
                <td><input type="submit" class="buttonKirim" value="Daftar"></input></td>
              </tr>
              <tr>
                </td><div id="link"><a href="login.php">Login »</a></div><td width="71"></td>
            </tr>
		</form>
       </table>           
		</div>
	</div>
</div>
</body>
</html>
 