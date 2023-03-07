<?php
if (!isset($_POST['submit'])){

$id_dosen=$_GET['id_dosen'];
$qry_dsn=mysql_query("select * from dosen where id_dosen='$id_dosen'");
$data_dsn=mysql_fetch_array($qry_dsn);
if ($data_dsn[30]!="") {
unlink("foto/$data_dsn[30]");
}
mysql_query("delete from dosen where id_dosen='$id_dosen'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.dosen" />';

} else {

if (isset($_POST['cek'])){
$cek=$_POST['cek'];
$jum = count($cek);

for ($i = 0; $i < $jum; ++$i) {

	$qry_dsn=mysql_query("select * from dosen where id_dosen='$cek[$i]'");
	$data_dsn=mysql_fetch_array($qry_dsn);
	if ($data_dsn[30]!="") {
		unlink("foto/$data_dsn[30]");
	}

	$qry=mysql_query("delete from dosen where id_dosen='$cek[$i]'");
}

	echo "<script>alert ('Data Telah Dihapus')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.dosen" />';

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.dosen" />';
}

}
?>