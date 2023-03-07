<?php
if (isset($_POST['CekMk'])){
$nim=$_POST['nim'];
$id_ta=$_POST['id_ta'];
$batas_sks=$_POST['batas_sks'];
$cek = $_POST['CekMk'];
$jum = count($cek);
$jum_sks = 0;

for ($i = 0; $i < $jum; ++$i) {
	$qry_sks=mysql_query("select * from mata_kuliah where kd_mk='$cek[$i]'");
	$data_sks=mysql_fetch_array($qry_sks);
	
	$amount = $data_sks[2];
	$jum_sks += $amount;
}

if ($jum_sks > $batas_sks){
	echo "<script>alert ('Maaf anda mengambil jumlah sks melebihi batas')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.krs" />';
} else {
	mysql_query("update konfirmasi_bayar set status_ulang='no' where nim='$nim' and id_ta='$id_ta'");
for ($i = 0; $i < $jum; ++$i) {
	$qry=mysql_query("insert into krs values('','$nim','$cek[$i]','$id_ta','acc','')");
}
	//mysql_query("update konfirmasi_bayar set status='sudah' where nim='$nim' and id_ta='$id_ta'");

	echo "<script>alert ('Terima Kasih Telah Mengisi KRS Anda')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.krs" />';
	
}	

} else {
	echo "<script>alert ('Data Belum Dipilih')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.krs" />';
}
?>