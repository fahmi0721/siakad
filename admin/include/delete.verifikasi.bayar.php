<?php

$kode_bayar=$_GET['kode_bayar'];
mysql_query("delete from konfirmasi_bayar where id_bayar='$kode_bayar'");
echo "<script>alert ('Data Telah Dihapus')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.verifikasi.bayar" />';

?>