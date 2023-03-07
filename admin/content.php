<?php 
	if (!isset($_GET['target'])){
			include "include/home.php";
	}else{
		$target=$_GET['target'];
		$filename='include/'.$target.'.php';
		
		if (file_exists($filename)) {
			include "include/$target.php";
		} else {
			include "include/404.error.php";
		}
	}
?>