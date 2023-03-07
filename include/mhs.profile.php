<style>
.tabel td{
padding:10px;
}
</style>
<script type="text/javascript">
	function showIt() {
	  document.getElementById("alert").style.display = "none";
	}
	setTimeout("showIt()", 5000);
</script>

<?php
	$user=$_SESSION['sesiusername'];	
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	$data_user=mysql_fetch_array($qry);
	
	if ($data_user[0]==""){
		$nim="[ Belum Ada Data ]";
	} else {
		$nim="$data_user[0]";
	}
	
	if ($data_user[1]==""){
		$nama="[ Belum Ada Data ]";
	} else {
		$nama="$data_user[1]";
	}
	
	if ($data_user[6]==""){
		$jenkel="[ Belum Ada Data ]";
	} else {	
		$jenkel="$data_user[6]";
	}
	
	if ($data_user[4]==""){
		$tmp_lahir="[ Belum Ada Data ]";
	} else 	{
		$tmp_lahir="$data_user[4]";
	}

	if ($data_user[3]=="0000-00-00"){
		$tgl_lahir="[ Belum Ada Data ]";
	} else {	
		$tgl_lahir="$data_user[3]";
	}

	if ($data_user[5]==""){
		$agama="[ Belum Ada Data ]";	
	} else {	
		$agama="$data_user[5]";
	}

	if ($data_user[2]==""){
		$alamat="[ Belum Ada Data ]";
	} else {	
		$alamat="$data_user[2]";
	}

	if ($data_user[7]==""){
		$no_telpon="[ Belum Ada Data ]";
	} else {	
		$no_telpon="$data_user[7]";
	}

	if ($data_user[8]==""){
		$email="[ Belum Ada Data ]";
	} else {	
		$email="$data_user[8]";
	}

	if ($data_user[12]==""){
		$asal_sekolah="[ Belum Ada Data ]";
	} else {	
		$asal_sekolah="$data_user[12]";
	}	
	
	if ($data_user[9]==""){
		$tahun_masuk="[ Belum Ada Data ]";
	} else {	
		$tahun_masuk="$data_user[9]";
	}

	if ($data_user[10]==""){
		$prodi="[ Belum Ada Data ]";
	} else {	
		$prodi="$data_user[10]";
	}

	if ($data_user[11]==""){
		$status="[ Belum Ada Data ]";
	} else {	
		$status="$data_user[11]";
	}

	if ($data_user[13]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_user[13]";
	}
?>
<br>
<header>
	<h2 class="alt">My Profile</h2>
</header>
<div style="float:left;width:25%;">
<?php
$pesan="";
if (isset($_POST['submit'])){
$nim=$_POST['nim'];
$fotolama=$_POST['fotolama'];
$fotoSem=$_FILES ["foto"]["tmp_name"];

$foto=$_FILES ["foto"]["name"];
$info = pathinfo($foto);
if($info['extension'] == 'jpg' || $info['extension'] == 'gif' || $info['extension'] == 'png' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg'){

if ($fotolama!=""){
unlink("admin/foto/$fotolama");
}

$lokasi="admin/foto/$foto";
copy ($fotoSem,$lokasi);
mysql_query("update mahasiswa set foto='$foto' where nim='$nim'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";

} else {
echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa Gambar')</script>";
$pesan="Gagal Tersimpan";
$foto=$fotolama;
}
}
?>
<form action="index.php?target=mhs.profile" method="post" enctype="multipart/form-data">
	<img src="admin/foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;">
	<input type="hidden" name="fotolama" value="<?php echo $data_user[13]; ?>">
	<input type="hidden" name="nim" value="<?php echo $data_user[0]; ?>">
	<input type="file" name="foto" size="30" multiple style="overflow:hidden;width:230px;border:1px solid #ccc;width:100%;" required> 
	<br>
	<input type="submit" name="submit" value="Upload" style="width:100%">
</form>
<?php
if ($pesan=="Sukses Tersimpan") {
?>
<div id="alert" style="text-align:left;color:green;display: block;" >Thank You, Your Data Success Saving.</div>
<?php
} elseif ($pesan=="Gagal Tersimpan") {
?>
<div id="alert" style="text-align:left;color:#f00;display: block;">Oops Sorry! Your Data Missed Saving, Please Try Again</div>
<?php
}
?>	
</div>	
<div style="float:right;width:70%">
<table width=100%>
	<tr>
		<td style="width:45%;">Nim</td>
		<td style="width:5%;">:</td>
		<td style="width:50%;"><?php echo $nim; ?></td>
	</tr>
	<tr>
		<td>Nama Lengkap</td>
		<td>:</td>
		<td><?php echo $nama; ?></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php echo $jenkel; ?></td>
	</tr>
	<tr>
		<td>Tempat/Tanggal Lahir</td>
		<td>:</td>
		<?php
		if ($data_user[3]!="0000-00-00"){
		$date = new DateTime($tgl_lahir);
		}
		?>
		<td><?php echo $tmp_lahir;?> / <?php if($data_user[3]=="0000-00-00"){ echo $tgl_lahir; } else { echo $date->format('d-m-Y');} ?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $agama; ?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $alamat; ?></td>
	</tr>
	<tr>
		<td>Nomor Telpon</td>
		<td>:</td>
		<td><?php echo $no_telpon; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<td>Asal Sekolah</td>
		<td>:</td>
		<td><?php echo $asal_sekolah; ?></td>
	</tr>
	<tr>
		<td>Tahun Masuk</td>
		<td>:</td>
		<td><?php echo $tahun_masuk; ?></td>
	</tr>
	<tr>
		<td>Program Studi</td>
		<td>:</td>
		<?php
			$qry_prodi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_user[10]'");
			$data_prodi=mysql_fetch_array($qry_prodi);
		?>
		<td><?php echo $data_prodi[2]; ?></td>
	</tr>
	<tr>
		<td>Status Akademik</td>
		<td>:</td>
		<?php
			if ($status=="Aktif") {
				$warna="#00f044";
			} else if($status=="Cuti"){
				$warna="#f00";
			} else {
				$warna="#888888";
			}
		?>
		<td><font color="<?php echo $warna; ?>"><?php echo $status; ?></font></td>
	</tr>
	<tr>
		<td  style="padding-top:30px;"><a href="index.php?target=mhs.edit.profile&aksi=ubah profile" class="button scrolly">Perbaharui Profile</a></td>
		<td  colspan=2 style="padding-top:30px;"><a href="index.php?target=mhs.edit.profile&aksi=ubah password" class="button scrolly">Ubah Password</a></td>
	</tr>
</table>
</div>
<div style="clear:both;">
	
<br>

</div>

<br>