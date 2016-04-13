<?php
    session_start();
    if(isset($_SESSION['username_login'])){
	    header("Location: page.php");
	}
	
include ('database_connection.php');
if (isset($_POST['formsubmitted'])) {
    $error = array();//buat array untuk menampung pesan eror  
    if (empty($_POST['username_login'])) {//jika variabel nama kosong 
        $error[] = 'Silahkan masukkan nama ';//tambahkan ke array sebagai pesan error
    } else {
        $username_login = $_POST['username_login'];//jika ada maka masukan isi dari variabel nama
    }

    if (empty($_POST['email'])) {
        $error[] = 'Please Enter your Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
           //regular expression untuk validasi email
            $email = $_POST['email'];
        } else {
             $error[] = 'Email tidak valid';
        }


    }


    if (empty($_POST['password_login'])) {
        $error[] = 'Silahkan masukkan password ';
    } else {
        $password_login = $_POST['password_login'];
    }


    if (empty($error)) //kirim ke database jika tidak ada eror

    { 

        // memastikan apakah email sudah ada di database atau belum
        $query_verify_email = "SELECT * FROM siswa  WHERE email ='$email'";
        $result_verify_email = mysqli_query($dbc, $query_verify_email);
        if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)
            echo ' Terjadi eror pada database ';
        }

        if (mysqli_num_rows($result_verify_email) == 0) { // Jika tidak ada user lain yang teregistrasi telah menggunakan email ini


            // membuat kode aktivasi
            $activation = md5(uniqid(rand(), true));
            $pass=md5($_POST[password]);


            $query_insert_user = "INSERT INTO `siswa` ( `username_login`, `email`, `password_login`, `Aktivasi`) VALUES ( '$username_login', '$email', '$pass', '$activation')";


            $result_insert_user = mysqli_query($dbc, $query_insert_user);
            if (!$result_insert_user) {
                echo 'Query Failed ';
            }

            if (mysqli_affected_rows($dbc) == 1) { //Jika data yang dimasukan ke database sukses


                // kirim email
				$message = "Terimakasih sudah mencoba demo \"Membuat aplikasi registrasi dengan aktivasi email menggunakan PHP.\" \n\n";
                $message .= " Untuk aktivasi contoh akun anda, silahkan klik link di bawah ini:\n\n";
                $message .= WEBSITE_URL . '/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Konfirmasi Registrasi', $message, 'From: elearning@xrb04.net');

                


                // Jika registrasi berhasil dan email telah terkirim
                echo '<div class="success">Terimakasih telah melakukan registrasi di demo ini, sebuah email telah dikirim ke '.$email.' Silahkan klik pada link aktivasi untuk mengaktivkan account anda </div>';


            } else { // Jika terjadi kesalahan maka : 
                echo '<div class="errormsgbox">Tidak dapat melakukan registrasi karena kesalahan system</div>';
            }

        } else { // email addres telah terdaftar
            echo '<div class="errormsgbox" >email yang anda masukkan telah teregistrasi
</div>';
        }

    } else {//Jika terdapat kesalahan pada array error maka tampilkan
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            
            echo '	<li>'.$values.'</li>';


       
        }
        echo '</ol></div>';

    }
  
    mysqli_close($dbc);//Tutup koneksi database

}



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>


    
    
    
<style type="text/css">
body {
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
.registration_form {
	margin:0 auto;
	width:500px;
	padding:14px;
}
label {
	width: 10em;
	float: left;
	margin-right: 0.5em;
	display: block
}
.submit {
	float:right;
}
fieldset {
	background:#EBF4FB none repeat scroll 0 0;
	border:2px solid #B7DDF2;
	width: 500px;
}
legend {
	color: #fff;
	background: #80D3E2;
	border: 1px solid #781351;
	padding: 2px 6px
}
.elements {
	padding:10px;
}
p {
	border-bottom:1px solid #B7DDF2;
	color:#666666;
	font-size:11px;
	margin-bottom:20px;
	padding-bottom:10px;
}
a{
    color:#0099FF;
font-weight:bold;
}

/* Box Style */


 .success, .warning, .errormsgbox, .validation {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 50px;
	background-repeat: no-repeat;
	background-position: 10px center;
     font-weight:bold;
     width:450px;
     
}

.success {
   
	color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('images/success.png');
}
.warning {

	color: #9F6000;
	background-color: #FEEFB3;
	background-image: url('images/warning.png');
}
.errormsgbox {
 
	color: #D8000C;
	background-color: #FFBABA;
	background-image: url('images/error.png');
	
}
.validation {
 
	color: #D63301;
	background-color: #FFCCBA;
	background-image: url('images/error.png');
}



</style>

</head>
<body>


<form action="index.php" method="post" class="registration_form">
  <fieldset>
    <legend>From Registrasi </legend>

    <p>Buat akun baru <span style="background:#EAEAEA none repeat scroll 0 0;line-height:1;margin-left:210px;;padding:5px 7px;">Apakah sudah terdaftar? <a href="login.php">Log in</a></span> </p>
    
    <div class="elements">
      <label for="username_login">Nama :</label>
      <input type="text" id="username_login" name="username_login" size="25" />
    </div>
    <div class="elements">
      <label for="email">E-mail :</label>
      <input type="text" id="email" name="email" size="25" />
    </div>
    <div class="elements">
      <label for="password_login">Password:</label>
      <input type="password" id="password_login" name="password_login" size="25" />
    </div>
    <div class="submit">
     <input type="hidden" name="formsubmitted" value="TRUE" />
      <input type="submit" value="Register" />
    </div>
  </fieldset>
</form>
</body>
</html>
