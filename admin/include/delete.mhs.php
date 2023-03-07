<?php
if (!isset($_POST['submit'])){

$nim=$_GET['nim'];
$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
$data_mhs=mysql_fetch_array($qry_mhs);
if ($data_mhs[13]!="") {
unlink("foto/$data_mhs[13]");
}
mysql_query("delete from mahasiswa where nim='$nim'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mhs" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {

	$qry_mhs=mysql_query("select * from mahasiswa where nim='$cek[$i]'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	if ($data_mhs[13]!="") {
		unlink("foto/$data_mhs[13]");
	}

	$qry=mysql_query("delete from mahasiswa where nim='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mhs" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mhs" />';
}

}
?>