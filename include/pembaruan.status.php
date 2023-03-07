<?php
include "../connect.php";
$qry_post=mysql_query("select * from status_post where baca='t'");
$jum_post=mysql_num_rows($qry_post);
if ($jum_post==0){
	echo "Tidak Ada Pembaruan";
} else {	
	echo "<a href=''>";
	echo $jum_post ; 
	echo " Post Pembaruan";
	echo "</a>";
}	
?>
