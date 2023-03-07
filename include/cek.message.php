<?php
session_start();
include "../connect.php";
$nim=$_SESSION['sesiusername'];
$pesan = mysql_query("SELECT id_message FROM message
    WHERE baca='belum' and untuk='$nim'");
$j = mysql_num_rows($pesan);
if($j>0){
    echo $j;
}
?>
