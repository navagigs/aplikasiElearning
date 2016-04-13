<style>
<?php
include "configurasi/koneksi.php";
$background=mysql_query("SELECT * FROM background ORDER BY id_background DESC LIMIT 4");
while($b=mysql_fetch_array($background)){
	 echo "
		body {
			height: 100%;
			margin: 0;
			padding: 0;
			font-family:Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
			background:url('foto_background/$b[gambar]');
			background-color:#dfe3ee;
			background-attachment:fixed;
			background-size:cover;
			font-size: 12px;
}";
 }
 ?> 
</style>