<?php
session_start();
include "../connect.php";
$username=$_POST["username"];
$password=md5($_POST["password"]);
$sql="select * from user where username='$username' and password='$password' and (level='admin' or level='baak' or level='bauk' or level='prodi' or level='ketua')";
$kueri=mysql_query($sql);
$jumlah=mysql_num_rows($kueri);
$data=mysql_fetch_array($kueri);
if ($jumlah==1 ){
	$_SESSION["logusername"] = $data["username"];
	$_SESSION["logpassword"] = $data["password"];
	$_SESSION["loglevel"] = $data["level"];
	header("Location:index.php");
}else{
	echo "<script>alert ('Incorrect Username or Password')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php" />';
}
?>