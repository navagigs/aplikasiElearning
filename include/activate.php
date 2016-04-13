<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Aktivasi akun anda</title>
	<style>@import "assets/css/login_user.css";</style>
    <link href="assets/images/favicon.PNG" rel="shortcut icon" type="image/x-icon" />
    <meta name="author" content="Nava Gia Ginasta" />

</head>
<body>
<?php
include ('database_connection.php');

if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
{
    $key = $_GET['key'];
}


if (isset($email) && isset($key))
{

    // Update databse untuk menset isi aktivasi ke "NULL" 

    $query_activate_account = "UPDATE siswa SET Aktivasi=NULL WHERE(email ='$email' AND Aktivasi='$key')LIMIT 1";

   
    $result_activate_account = mysqli_query($dbc, $query_activate_account) ;

   
    if (mysqli_affected_rows($dbc) == 1)//Jika proses update telah berhasil
    {
    echo '<div class="success">Akun anda telah aktive, untuk masuk klik <a href="login.php">Log in</a></div>';

    } else
    {
        echo '<div class="errormsgbox">'.$email .' , ' . $key .'Akun anda tidak dapat diaktivasi. silahkan lakukan registrasi ulang atau hubungi administrator.</div>';

    }

    mysqli_close($dbc);

} else {
        echo '<div class="errormsgbox">Terjadi kesalahan.</div>';
}


?>
</body>
</html>