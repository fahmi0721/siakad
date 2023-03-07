<?php
session_start();
include "connect.php";
$username=$_POST["username"];
$password=md5($_POST["password"]);
$sql="select * from user where username='$username' and password='$password' and (level='mahasiswa' or level='dosen')";
$kueri=mysql_query($sql);
$jumlah=mysql_num_rows($kueri);
$data=mysql_fetch_array($kueri);
if ($jumlah==1 ){
	$_SESSION["sesiusername"] = $data["username"];
	$_SESSION["sesipassword"] = $data["password"];
	$_SESSION["sesilevel"] = $data["level"];
	mysql_query("update user set aktif='1' where username='$username'");
	header("Location:index.php");
}else{
	echo "<script>alert ('Incorrect Username or Password')</script>";
	echo '<meta http-equiv="refresh" content="0;url=index.php" />';
}
?>