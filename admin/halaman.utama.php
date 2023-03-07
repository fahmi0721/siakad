<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SimpleAdmin - Full width page</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style.table.css">
	<link rel="stylesheet" href="css/style.form.css">
	<link rel="stylesheet" href="css/style.search.css"/>
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="js/script.js"></script>  
	
	<link rel="stylesheet" href="css/base/jquery.ui.all.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="css/demos.css">
	<script>
	$(function() {
		$('#datepicker1').datepicker({
		      changeMonth: true,
		      changeYear: true,
			  dateFormat: 'yy-mm-dd',
			  yearRange:'1950:<?php echo date("Y")+10;?>'
	    });
	});
	</script>
</head>
<body>

	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<?php
				include "menu.php";
			?>	
			
		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
			<img src="../images/algazali.png" width=40 align=left>
			<h1 style="padding-top:12px;margin-left:50px;">Dashboard Sistem Informasi Akademik STIA Al Gazali</h1>
			<br>
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
			<?php
				include "content.php";
			?>
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">
	<?php
	$thn=date("Y");
	?>
		<p>&copy; Copyright <?php echo $thn; ?> <a href="#">Siakad STIA Al Gazali</a>. All rights reserved.</p>
		<p><strong>SimpleAdmin</strong> theme by <a href="#">Admin STIA Al Gazali</a></p>
	
	</div> <!-- end footer -->

</body>
</html>