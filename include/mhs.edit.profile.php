<?php
if (isset($_GET['aksi'])){
$aksi=$_GET['aksi'];
}

if (isset($_POST['aksi'])){
$aksi=$_POST['aksi'];
}

if ($aksi=="ubah profile"){
	$user=$_SESSION['sesiusername'];	
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	$data_user=mysql_fetch_array($qry);
	
	$nim="$data_user[0]";
	$alamat="$data_user[2]";
	$no_telpon="$data_user[7]";
	$email="$data_user[8]";
?>
<br>
<header>
	<h2 class="alt">Ubah Profile</h2>
</header>
<?php
$pesan="";
if (isset($_POST['submit'])){
$submit=$_POST['submit'];
if($submit=="Simpan Perubahan"){
$nim=$_POST['nim'];
$alamat=$_POST['alamat'];
$no_telpon=$_POST['no_telpon'];
$email=$_POST['email'];

mysql_query("update mahasiswa set alamat='$alamat',no_telp='$no_telpon',email='$email' where nim='$nim'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.profile" />';
} else {
echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.profile" />';
}
}
?>	
<h3>Anda hanya bisa mengubah data isian form dibawah ini!</h3>
<br>
<form method="post" action="index.php?target=mhs.edit.profile&aksi=ubah profile">
Alamat :<input type="hidden" name="nim" value="<?php echo $nim; ?>">
		<textarea name="alamat"><?php echo $alamat; ?></textarea>
Nomor Telpon : 
<br>
<input type="text" name="no_telpon" value="<?php echo $no_telpon; ?>" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;">
<br>
Email : 
<br>
<input type="text" name="email" value="<?php echo $email; ?>" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;">
<br>
<br>
<input type="submit" name="submit" class="button scrolly" value="Simpan Perubahan">
<input type="submit" name="submit" class="button scrolly" value="Batal">
</form>
<?php
} else if($aksi=="ubah password"){
	$user=$_SESSION['sesiusername'];
	$qry_user=mysql_query("select * from user where username='$user'");
	$data_user=mysql_fetch_array($qry_user);
	
	if(isset($_POST['submit'])){
		$submit=$_POST['submit'];
		if ($submit=="Simpan Password"){
			$username=$_POST['username'];
			$pass_lama=$_POST['pass_lama'];
			
			$password_lama=md5($_POST['password_lama']);
			$password_baru=md5($_POST['password_baru']);
			$ulang_password_baru=md5($_POST['ulang_password_baru']);
			
			if ($pass_lama != $password_lama){
				echo "<script>alert ('Maaf password lama yang anda inputkan salah')</script>";
				} else if ($password_baru != $ulang_password_baru){
					echo "<script>alert ('Maaf password baru anda salah')</script>";				
				} else {
					mysql_query("update user set password='$password_baru' where username='$username' and level='mahasiswa'");
					echo "<script>alert ('Password Anda Telah Berubah')</script>";
					echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.profile" />';
				}
			
		}
	}
?>
<br>
<h2>Ubah Password</h2>
<br>
<form method="post" action="index.php?target=mhs.edit.profile&aksi=ubah password">
<input type="hidden" name="username" value="<?php echo $data_user[0]; ?>">
<input type="hidden" name="pass_lama" value="<?php echo $data_user[1]; ?>">
<input type="password" name="password_lama" value="" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;" placeholder="Masukkan Password Lama" required>
<br>
<br>
<input type="password" name="password_baru" value="" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;" placeholder="Masukkan Password Baru" required>
<br>
<br>
<input type="password" name="ulang_password_baru" value="" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;" placeholder="Masukkan Ulang Password Baru" required>
<br>
<br>
<br>
<input type="submit" name="submit" class="button scrolly" value="Simpan Password">
</form>
<?php
}
?>
<br>
<br>
<br>