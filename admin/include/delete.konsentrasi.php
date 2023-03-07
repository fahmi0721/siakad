<?php
if (!isset($_POST['submit'])){

$kode_konsentrasi=$_GET['kode_konsentrasi'];
mysql_query("delete from konsentrasi where kd_konsentrasi='$kode_konsentrasi'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.konsentrasi" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("delete from konsentrasi where kd_konsentrasi='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.konsentrasi" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.konsentrasi" />';
}

}
?>