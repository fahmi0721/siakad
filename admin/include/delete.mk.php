<?php
if (!isset($_POST['submit'])){

$kode_mk=$_GET['kode_mk'];
mysql_query("delete from mata_kuliah where kd_mk='$kode_mk'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mk" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("delete from mata_kuliah where kd_mk='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mk" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mk" />';
}

}
?>