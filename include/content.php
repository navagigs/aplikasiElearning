<?php
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='siswa'){
  echo "<div id='title'></div>
		<div id='content'><div class='information msg'>Selamat datang di <b>E-Learning SMAN 3 Ciamis, Sarana Pembelajaran Siswa dengan menggunakan Teknologi Online.</div>	
          	<table class='data' cellpadding='5' >
            	<tr>
                   <td><center><a href='media.php?module=kelas'>
						<img src='assets/icon/Student-id-icon copy.png' width='48' height='48'/>
						<br />Kelas</a></center>
                   </td>
                   <td><center><a href='media.php?module=matapelajaran'>
						<img src='assets/icon/Graduate-male-icon.png' width='48' height='48'/>
						<br />Mata Pelajaran</a></center>
                   </td>
                   <td><center><a href='media.php?module=materi'>
						<img src='assets/icon/materi.png' width='48' height='48'/>
						<br />Materi</a></center>
                   </td>
                   <td><center><a href='media.php?module=quiz'>
						<img src='assets/icon/quiz.png' width='48' height='48'/>
						<br />Tugas / Quiz</a></center>
                   </td>
                   <td><center><a href='media.php?module=siswa&act=detailprofilsiswa&id=$_SESSION[idsiswa]'>
						<img src='assets/icon/admin.png' width='48' height='48'/>
						<br />Edit Profil</a></center>
                   </td>
                   <td><center><a href='media.php?module=siswa&act=detailaccount'>
						<img src='assets/icon/keluar.png' width='48' height='48'/>
						<br />Edit Password</a></center>
                   </td>
				   
                 </tr>
           </table></div>	";
				
  }
}
// Bagian kelas
elseif ($_GET['module']=='kelas'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_kelas/kelas.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_siswa/siswa.php";
  }
}

// Bagian admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_admin/admin.php";
  }
}

// Bagian mapel
elseif ($_GET['module']=='matapelajaran'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_matapelajaran/matapelajaran.php";
  }
}

// Bagian materi
elseif ($_GET['module']=='materi'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_materi/materi.php";
  }
}

// Bagian quiz
elseif ($_GET['module']=='quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/quiz.php";
  }
}

// Bagian kerjakan_quiz
elseif ($_GET['module']=='kerjakan_quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/soal.php";
  }
}

// Bagian niali
elseif ($_GET['module']=='nilai'){
  if ($_SESSION['leveluser']=='siswa'){
      include "daftarnilai.php";
  }
}

?>
