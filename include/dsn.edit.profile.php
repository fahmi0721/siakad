<?php
if (isset($_GET['aksi'])){
$aksi=$_GET['aksi'];
}

if (isset($_POST['aksi'])){
$aksi=$_POST['aksi'];
}

if ($aksi=="ubah profile"){
	$user=$_SESSION['sesiusername'];	
	$qry=mysql_query("select * from dosen where id_dosen='$user'");
	$data_user=mysql_fetch_array($qry);
	
		$id_dosen="$data_user[0]";
		$kota_asal="$data_user[17]";
		$kode_pos="$data_user[18]";
		$alamat="$data_user[3]";
		$no_telpon="$data_user[8]";
		$email="$data_user[9]";
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
$id_dosen=$_POST['id_dosen'];
$alamat=$_POST['alamat'];
$no_telpon=$_POST['no_telpon'];
$email=$_POST['email'];
$kota_asal=$_POST['kota_asal'];
$kode_pos=$_POST['kode_pos'];

mysql_query("update dosen set alamat='$alamat',no_telp='$no_telpon',email='$email',kota_asal='$kota_asal',kode_pos='$kode_pos' where id_dosen='$id_dosen'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=dsn.profile" />';
} else {
echo '<meta http-equiv="refresh" content="0;url=index.php?target=dsn.profile" />';
}
}
?>
<h3>Anda hanya bisa mengubah data isian form dibawah ini!</h3>
<br>
<form method="post" action="index.php?target=dsn.edit.profile&aksi=ubah profile">
Kota Asal :
<br>
<input type="text" name="kota_asal" value="<?php echo $kota_asal; ?>" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;">
<input type="hidden" name="id_dosen" value="<?php echo $id_dosen; ?>">
<br>
Kode Pos :
<br>
<input type="text" name="kode_pos" value="<?php echo $kode_pos; ?>" style="padding:10px;border-radius:5px;border:1px solid #aaa;width:500px;">
<br>
Alamat :
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
					mysql_query("update user set password='$password_baru' where username='$username' and level='dosen'");
					echo "<script>alert ('Password Anda Telah Berubah')</script>";
					echo '<meta http-equiv="refresh" content="0;url=index.php?target=dsn.profile" />';
				}
			
		}
	}
?>
<br>
<h2>Ubah Password</h2>
<br>
<form method="post" action="index.php?target=dsn.edit.profile&aksi=ubah password">
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