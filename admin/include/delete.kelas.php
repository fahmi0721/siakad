<?php
if (!isset($_POST['submit'])){

$kode_kelas=$_GET['kode_kelas'];
mysql_query("delete from ruang_kelas where id_kelas='$kode_kelas'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.kelas" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("delete from ruang_kelas where id_kelas='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.kelas" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.kelas" />';
}

}
?>