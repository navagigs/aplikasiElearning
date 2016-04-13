<?php
include "../configurasi/koneksi.php";

if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
      echo "<span class='judulhead'><b>Selamat Datang Admin</b></span>";
  }
  elseif ($_SESSION['leveluser']=='pengajar'){
      echo "<span class='judulhead'><b>Selamat Datang Pengajar</b></span>";
  }
}
elseif ($_GET['module']=='modul'){
      echo "<span class='judulhead'><b>Manajeman Modul</b></span>";
  }
elseif ($_GET['module']=='admin'){
      echo "<span class='judulhead'><b>Manajeman Admin</b></span>";
  }
elseif ($_GET['module']=='siswa'){
      echo "<span class='judulhead'><b>Manajeman Siswa</b></span>";
  }
elseif ($_GET['module']=='kelas'){
      echo "<span class='judulhead'><b>Manajeman Kelas</b></span>";
  }
elseif ($_GET['module']=='matapelajaran'){
      echo "<span class='judulhead'><b>Manajeman Mata Pelajaran</b></span>";
  }
elseif ($_GET['module']=='materi'){
      echo "<span class='judulhead'><b>Manajeman Materi</b></span>";
  }
elseif ($_GET['module']=='quiz'){
      echo "<span class='judulhead'><b>Manajeman Quiz</b></span>";
  }

elseif ($_GET['module']=='templates'){
      echo "<span class='judulhead'><b>Manajeman Template</b></span>";
  }

elseif($_GET['module']=='detailpengajar'){
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_GET[id]'");
        $p=mysql_fetch_array($pengajar);
	echo "<span class='judulhead'><b>Manajeman Admin &#187; Detail Pengajar &#187; $p[nama_lengkap]</b></span>";
}
elseif($_GET['module']=='detailsiswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
        $s=mysql_fetch_array($siswa);
	echo "<span class='judulhead'><b>Manajeman Kelas &#187; Detail Siswa &#187; $s[nama_lengkap]</b></span>";
}

elseif($_GET['module']=='detailsiswapengajar'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
        $s=mysql_fetch_array($siswa);
	echo "<span class='judulhead'><b>Manajeman Kelas &#187; Daftar Siswa &#187; Detail Siswa</b></span>";
}

elseif($_GET['module']=='daftarsiswa'){
        $siswa = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]'");
        $s=mysql_fetch_array($siswa);
	echo "<span class='judulhead'><b>Manajeman Kelas &#187; Daftar Siswa</b></span>";
}

elseif($_GET['module']=='buatquiz'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz</b></span>";
}

elseif($_GET['module']=='buatquizesay'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz &#187; Buat Quiz Esay</b></span>";
}

elseif($_GET['module']=='buatquizpilganda'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz &#187; Buat Quiz Pilihan Ganda</b></span>";
}

elseif($_GET['module']=='daftarquiz'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz</b></span>";
}

elseif($_GET['module']=='daftarquizesay'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz &#187; Daftar Quiz Esay</b></span>";
}

elseif($_GET['module']=='daftarquizpilganda'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz &#187; Daftar Quiz Pilihan Ganda</b></span>";
}
?>
