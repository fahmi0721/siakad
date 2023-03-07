<br>
<header>
	<?php
	$user=$_SESSION['sesiusername'];	
	if ($_SESSION['sesilevel']=="mahasiswa"){
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	} else {
	$qry=mysql_query("select * from dosen where id_dosen='$user'");
	}
	$data_user=mysql_fetch_array($qry);
	?>
	<h2 class="alt">Welcome to Sistem Informasi Akademik<br />
	<a href="#"><?php if ($_SESSION['sesilevel']=="mahasiswa"){ echo $data_user[1]; } else { echo $data_user[2]; } ?></a>.</h2>
	</header>

<h2>Info Penting!</h2>	
<?php
if ($_SESSION['sesilevel']=="mahasiswa"){
	$qry_info=mysql_query("select * from info where untuk='mahasiswa' order by(id_info) desc LIMIT 1");
} else {
	$qry_info=mysql_query("select * from info where untuk='dosen' order by(id_info) desc LIMIT 1");
}	
	$data_info=mysql_fetch_array($qry_info);
	$date="$data_info[2]";
	function TanggalIndo($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
		return($result);
	}
	
	echo "<p>Ditulis Tanggal : "; 
	echo TanggalIndo($date);
	echo "<br>";
	echo  $data_info[3];
	echo "</p>";
?>
<br>