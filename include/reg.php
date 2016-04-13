<?php
    session_start();
    if(isset($_SESSION['username_login'])){
	    header("Location: media.php");
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>e-Learning | Daftar</title>
	<link href="assets/images/favicon.PNG" rel="shortcut icon" type="image/x-icon" />
	<style>@import "assets/css/login_user.css";</style>
	<meta name="author" content="Nava Gia Ginasta" />

</head>
<body><div id="containerDaftar">
	<div id="wrap"><span>Form Daftar</span>
    	<ul class="cont"><a title="Log in" href="login.php">Log in</a></ul><br />
		<div id="main">
				<div id="content">
               <table>
                	<form action="reg.php" method="post" class="registration_form">
                     <tr>
                     	<td><img title="username" src="assets/images/user.png" /></td>
                        <td><input type="text" placeholder="Username" id="username_login" class="input" name="username_login" /></td>
                    </tr>
                     <tr>
                     	<td><img title="password" src="assets/images/keluar.png" /></td>
                        <td><input type="password" placeholder="Password" id="password_login" class="input" name="password_login"/></td>
                     </tr>
                    <tr>                    
                     	<td><img title="email" src="assets/images/mail.png" /></td>
                        <td><input type="text" placeholder="Email" id="email" class="input" name="email" /></td>
                     </tr>
                      <tr>
                      	 <td colspan="2"><input type="hidden" name="formsubmitted" value="TRUE" /></td>
                      </tr>
                      <tr>
                       	 <td colspan="2"><input type="submit" title="Daftar" class="buttonKirim" value="Daftar" /></td>
                      </tr>
                     </form>  
                   </table>
	<?php
	include ('configurasi/database_connection.php');
	if (isset($_POST['formsubmitted'])) {
    $error = array();//buat array untuk menampung pesan eror  
    if (empty($_POST['username_login'])) {//jika variabel nama kosong 
        $error[] = 'Silahkan Masukan  Username ';//tambahkan ke array sebagai pesan error
    } else {
        $username_login = $_POST['username_login'];//jika ada maka masukan isi dari variabel nama
    }

    if (empty($_POST['password_login'])) {
        $error[] = 'Silahkan Masukan Password ';
    } else {
        $password_login = $_POST['password_login'];
    }
	
    if (empty($_POST['email'])) {
        $error[] = 'Silahkan Masukan Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
           //regular expression untuk validasi email
            $email = $_POST['email'];
        } else {
             $error[] = 'Email tidak valid';
        }


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


            $query_insert_user = "INSERT INTO `siswa` 
			( `username_login`, `email`, `password_login`, `Aktivasi`) VALUES ( '$username_login', '$email', '$pass', '$activation')";


            $result_insert_user = mysqli_query($dbc, $query_insert_user);
            if (!$result_insert_user) {
                echo 'Query Failed ';
            }

            if (mysqli_affected_rows($dbc) == 1) { //Jika data yang dimasukan ke database sukses


                // kirim email
				$message = "Terimakasih sudah melakukan Registrasi\"di E-learning.\" \n\n";
                $message .= " Untuk aktivasi contoh akun anda, silahkan klik link di bawah ini:\n\n";
                $message .= WEBSITE_URL . '/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Konfirmasi Registrasi', $message, 'From: elearning@xrb04.net');

                


                // Jika registrasi berhasil dan email telah terkirim
                echo '<div class="success">Terimakasih telah melakukan registrasi di E-learning, Sebuah email telah dikirim ke <u>'.$email.'</u> Silahkan klik pada link aktivasi untuk mengaktivkan account anda </div>';


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



?>
		</div>
	</div>
</div>
</body>
</html>
 