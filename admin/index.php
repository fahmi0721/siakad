<?php
session_start();
include "../connect.php";
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Administrator Sistem Informasi Akademik - STIA Al Gazali Barru</title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
</head>
<body>
<?php
if (!isset($_SESSION['logusername']) and !isset($_SESSION['logpassword']) and !isset($_SESSION['loglevel'])){
include "form.login.admin.php";
} else {
include "halaman.utama.php";
}
?>
</body>
</html>