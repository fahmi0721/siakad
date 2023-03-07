<?php
$user=$_GET['user'];
$use=$_GET['use'];
if ($use=="mahasiswa"){
mysql_query("update user set password=md5('$user') where username='$user' and level='mahasiswa'");
echo "<script>alert ('Password telah direset')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.mhs" />';
} else if($use=="dosen"){
mysql_query("update user set password=md5('$user') where username='$user' and level='dosen'");
echo "<script>alert ('Password telah direset')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.dosen" />';
}
?>