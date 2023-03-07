<center>
<?php
	if ($_SESSION["loglevel"]=="admin") {
?>
<br>
<br>
<br>
<br>
<h1>WELCOME TO DASHBOARD SISTEM INFORMASI AKADEMIK<h1>
<br>
<h1>LOGIN IN AS ADMINISTRATOR</h1>
<br>
<img src="images/user.png">
<br>
<br>
<br>
<?php
	} else if ($_SESSION["loglevel"]=="baak") {
?>
<br>
<br>
<br>
<br>
<h1>WELCOME TO DASHBOARD SISTEM INFORMASI AKADEMIK<h1>
<br>
<h1>LOGIN IN AS BAAK</h1>
<br>
<img src="images/user.png">
<br>
<br>
<br>
<?php
} else {
?>
<br>
<br>
<br>
<br>
<h1>WELCOME TO DASHBOARD SISTEM INFORMASI AKADEMIK<h1>
<br>
<h1>LOGIN IN AS BAUK</h1>
<br>
<img src="images/user.png">
<br>
<br>
<br>
<?php
}
?>
</center>