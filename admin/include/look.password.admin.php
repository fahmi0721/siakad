<link rel="stylesheet" media="all" type="text/css" href="css/tabel_style.css" />
<?php
$username=$_SESSION['logusername'];
$password=$_SESSION['logpassword'];
$level=$_SESSION['loglevel'];

if (isset($_POST['submit'])){
$level=$_POST['level'];

$user=$_POST['TxtUser'];
$pass=$_POST['Txtpass'];
$passlama=md5($_POST['Txtpasslama']);
$passbaru=md5($_POST['Txtpassbaru']);
$ulangpass=md5($_POST['Txtulangpass']);

if ($pass==$passlama){
	if ($passbaru==$ulangpass){
		$query=mysql_query("update user set password='$passbaru' where username='$user' and level='$level'");
		echo "<script>alert ('Password Telah Diubah')</script>";
	} else {
		echo "<script>alert ('Password Tidak Valid')</script>";
}
}else {
	echo "<script>alert ('Password Lama Tidak Sama')</script>";
}
}
?>
<center>
<br>
<br>
<br>
<br>
<br>
<fieldset style="width:450px; border:solid #999 1px;">
 <legend><strong>Ganti Password</strong></legend> 
 <div style="width:430px; padding:10px;">
 <table class="tabel">
 <form action="index.php?target=look.password.admin" method="post">
	<tr>
		<td  >Password Lama</td><td>:</td>
		<td ><input type="password" value="" name="Txtpasslama" placeholder="Masukkan Password Lama" required autofocus class="textbox1"></td>
	</tr>
	<tr>
		<td  >Password Baru</td><td>:</td>
		<td ><input type="password" value="" name="Txtpassbaru" placeholder="Masukkan Password Baru" required class="textbox1"></td>
	</tr>
	<tr>
		<td  >Ulang Password</td><td>:</td>
		<td ><input type="password" value="" name="Txtulangpass" placeholder="Ulangi Password Baru" required class="textbox1"></td>
	</tr>
	<tr>
		<td colspan=3 align=center>
		<input type="hidden" value="<?php echo "$username";?>" name="TxtUser">
		<input type="hidden" value="<?php echo "$password";?>" name="Txtpass">
		<input type="hidden" value="<?php echo "$level";?>" name="level">
		<input type="submit" name="submit" value="Ganti Password" class="tombol">
		</td>
	</tr>
	</form>
 </table>
 </div> 
 </fieldset>
 <br>
 <br>
 <br>
 </center>