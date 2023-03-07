<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIAKAD STIA Al Gazali Barru</title>
<?php
if (!isset($_SESSION['sesiusername']) and !isset($_SESSION['sesipassword']) and !isset($_SESSION['sesilevel'])){
?>
<!--STYLESHEETS-->
<link href="css/style.index.css" rel="stylesheet" type="text/css" />
<link href="css/style.form.login.css" rel="stylesheet" type="text/css" />
<!--SCRIPTS-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>
<?php
} else {
?>
<link rel="stylesheet" href="css/css3-tips.css" type="text/css">
<link rel="stylesheet" href="css/gaya.css" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/message.js"></script>
<script type="text/javascript" src="js/notifikasi.js"></script>
<?php
}
?>		
</head>
<body>
<?php
if (!isset($_SESSION['sesiusername']) and !isset($_SESSION['sesipassword']) and !isset($_SESSION['sesilevel'])){
	include "form.login.php";
} else {
	include "halaman.user.php";
}	
?>

</body>
</html>