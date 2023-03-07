<?php
if (!isset($_POST['submit'])){

$kode_jurusan=$_GET['kode_jurusan'];
mysql_query("delete from jurusan where kd_jurusan='$kode_jurusan'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.jurusan" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("delete from jurusan where kd_jurusan='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.jurusan" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.jurusan" />';
}

}
?>