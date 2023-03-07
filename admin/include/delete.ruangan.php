<?php
if (!isset($_POST['submit'])){

$kode_ruangan=$_GET['kode_ruangan'];
mysql_query("delete from ruangan where id_ruangan='$kode_ruangan'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.ruangan" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("delete from ruangan where id_ruangan='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.ruangan" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.ruangan" />';
}

}
?>