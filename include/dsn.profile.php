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
	$qry=mysql_query("select * from dosen where id_dosen='$user'");
	$data_user=mysql_fetch_array($qry);
	
	if ($data_user[0]==""){
		$id_dosen="[ Belum Ada Data ]";
	} else {
		$id_dosen="$data_user[0]";
	}
	
	if ($data_user[1]==""){
		$nidn="[ Belum Ada Data ]";
	} else {
		$nidn="$data_user[1]";
	}
	
	if ($data_user[2]==""){
		$nama="[ Belum Ada Data ]";
	} else {
		$nama="$data_user[2]";
	}
	
	if ($data_user[7]==""){
		$jenkel="[ Belum Ada Data ]";
	} else {	
		$jenkel="$data_user[7]";
	}
	
	if ($data_user[5]==""){
		$tmp_lahir="[ Belum Ada Data ]";
	} else 	{
		$tmp_lahir="$data_user[5]";
	}

	if ($data_user[4]=="0000-00-00"){
		$tgl_lahir="[ Belum Ada Data ]";
	} else {	
		$tgl_lahir="$data_user[4]";
	}

	if ($data_user[6]==""){
		$agama="[ Belum Ada Data ]";	
	} else {	
		$agama="$data_user[6]";
	}
	
	if ($data_user[17]==""){
		$kota_asal="[ Belum Ada Data ]";	
	} else {	
		$kota_asal="$data_user[17]";
	}
	
	if ($data_user[18]==""){
		$kode_pos="[ Belum Ada Data ]";	
	} else {	
		$kode_pos="$data_user[18]";
	}

	if ($data_user[3]==""){
		$alamat="[ Belum Ada Data ]";
	} else {	
		$alamat="$data_user[3]";
	}

	if ($data_user[8]==""){
		$no_telpon="[ Belum Ada Data ]";
	} else {	
		$no_telpon="$data_user[8]";
	}

	if ($data_user[9]==""){
		$email="[ Belum Ada Data ]";
	} else {	
		$email="$data_user[9]";
	}

	if ($data_user[15]==""){
		$nip_pns="[ Belum Ada Data ]";
	} else {	
		$nip_pns="$data_user[15]";
	}	
	
	if ($data_user[19]==""){
		$jabatan_struktural="[ Belum Ada Data ]";
	} else {	
		$jabatan_struktural="$data_user[19]";
	}

	if ($data_user[10]==""){
		$jabatan_fungsional="[ Belum Ada Data ]";
	} else {	
		$jabatan_fungsional="$data_user[10]";
	}

	if ($data_user[12]==""){
		$ikatan_kerja="[ Belum Ada Data ]";
	} else {	
		$ikatan_kerja="$data_user[12]";
	}
	
	if ($data_user[13]==""){
		$pt_induk="[ Belum Ada Data ]";	
	} else {	
		$pt_induk="$data_user[13]";
	}
	
	if ($data_user[14]==""){
		$homebase="[ Belum Ada Data ]";	
	} else {	
		$homebase="$data_user[14]";
	}
	
	if ($data_user[16]==""){
		$golongan="[ Belum Ada Data ]";	
	} else {	
		$golongan="$data_user[16]";
	}
	
	if ($data_user[11]==""){
		$status_ajar="[ Belum Ada Data ]";	
	} else {	
		$status_ajar="$data_user[11]";
	}
	
	if ($data_user[20]==""){
		$pt_s1="[ Belum Ada Data ]";	
	} else {	
		$pt_s1="$data_user[20]";
	}
	
	if ($data_user[21]==""){
		$prodi_s1="[ Belum Ada Data ]";	
	} else {	
		$prodi_s1="$data_user[21]";
	}
	
	if ($data_user[22]==""){
		$gelar_s1="[ Belum Ada Data ]";	
	} else {	
		$gelar_s1="$data_user[22]";
	}
	
	if ($data_user[23]==""){
		$pt_s2="[ Belum Ada Data ]";	
	} else {	
		$pt_s2="$data_user[23]";
	}
	
	if ($data_user[24]==""){
		$prodi_s2="[ Belum Ada Data ]";	
	} else {	
		$prodi_s2="$data_user[24]";
	}
	
	if ($data_user[25]==""){
		$gelar_s2="[ Belum Ada Data ]";	
	} else {	
		$gelar_s2="$data_user[25]";
	}
	
	if ($data_user[26]==""){
		$pt_s3="[ Belum Ada Data ]";	
	} else {	
		$pt_s3="$data_user[26]";
	}
	
	if ($data_user[27]==""){
		$prodi_s3="[ Belum Ada Data ]";	
	} else {	
		$prodi_s3="$data_user[27]";
	}
	
	if ($data_user[28]==""){
		$gelar_s3="[ Belum Ada Data ]";	
	} else {	
		$gelar_s3="$data_user[28]";
	}
	
	if ($data_user[29]==""){
		$pendidikan_akhir="[ Belum Ada Data ]";	
	} else {	
		$pendidikan_akhir="$data_user[29]";
	}

	if ($data_user[30]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_user[30]";
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
$id_dosen=$_POST['id_dosen'];
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
mysql_query("update dosen set foto='$foto' where id_dosen='$id_dosen'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";

} else {
echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa Gambar')</script>";
$pesan="Gagal Tersimpan";
$foto=$fotolama;
}
}
?>
<form action="index.php?target=dsn.profile" method="post" enctype="multipart/form-data">
	<img src="admin/foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;">
	<input type="hidden" name="fotolama" value="<?php echo $data_user[30]; ?>">
	<input type="hidden" name="id_dosen" value="<?php echo $data_user[0]; ?>">
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
	<tr style="border-bottom:3px solid #aaa;">
		<td colspan=3><b style="font-weight:bold;">Data Pribadi</b></td>
	</tr>
	<tr>
		<td style="width:45%;">Id Dosen</td>
		<td style="width:5%;">:</td>
		<td style="width:50%;"><?php echo $id_dosen; ?></td>
	</tr>
	<tr>
		<td>NIDN</td>
		<td>:</td>
		<td><?php echo $nidn; ?></td>
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
		if ($data_user[4]!="0000-00-00"){
		$date = new DateTime($tgl_lahir);
		}
		?>
		<td><?php echo $tmp_lahir;?> / <?php if($data_user[4]=="0000-00-00"){ echo $tgl_lahir; } else { echo $date->format('d-m-Y');} ?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $agama; ?></td>
	</tr>
	<tr>
		<td>Kota Asal</td>
		<td>:</td>
		<td><?php echo $kota_asal; ?></td>
	</tr>
	<tr>
		<td>Kode Pos</td>
		<td>:</td>
		<td><?php echo $kode_pos; ?></td>
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
		<td colspan=3></td>
	</tr>
	<tr style="border-bottom:3px solid #aaa;">
		<td colspan=3><b style="font-weight:bold;">Data Status Pekerjaan</b></td>
	</tr>
	<tr>
		<td>Nip PNS</td>
		<td>:</td>
		<td><?php echo $nip_pns; ?></td>
	</tr>
	<tr>
		<td>Jabatan Struktural</td>
		<td>:</td>
		<td><?php echo $jabatan_struktural; ?></td>
	</tr>
	<tr>
		<td>Jabatan Fungsional</td>
		<td>:</td>
		<td><?php echo $jabatan_fungsional; ?></td>
	</tr>
	<tr>
		<td>Ikatan Kerja</td>
		<td>:</td>
		<td><?php echo $ikatan_kerja; ?></td>
	</tr>
	<tr>
		<td>Perguruan Tinggi Induk</td>
		<td>:</td>
		<td><?php echo $pt_induk; ?></td>
	</tr>
	<tr>
		<td>Homebase</td>
		<td>:</td>
		<?php
			$qry_prodi=mysql_query("select * from jurusan where kd_jurusan='$data_user[14]'");
			$data_prodi=mysql_fetch_array($qry_prodi);
		?>
		<td><?php echo $data_prodi[1]; ?></td>
	</tr>
	<tr>
		<td>Status Mengajar</td>
		<td>:</td>
		<?php
			if ($status_ajar=="Aktif Mengajar") {
				$warna="#00f044";
			} else if($status_ajar=="Tidak Aktif Mengajar"){
				$warna="#f00";
			} else {
				$warna="#888888";
			}
		?>
		<td><font color="<?php echo $warna; ?>"><?php echo $status_ajar; ?></font></td>
	</tr>
	<tr>
	<td colspan=3></td>
	</tr>
	<tr style="border-bottom:3px solid #aaa;">
	<td colspan=3><b style="font-weight:bold;">Data Pendidikan</b></td>
	</tr>
	<tr>
		<td>Pendidikan Terakhir</td>
		<td>:</td>
		<td><?php echo $pendidikan_akhir; ?></td>
	</tr>
	<tr>
		<td>Asal Perguruan Tinggi S1</td>
		<td>:</td>
		<td><?php echo $pt_s1; ?></td>
	</tr>
	<tr>
		<td>Program Studi S1</td>
		<td>:</td>
		<td><?php echo $prodi_s1; ?></td>
	</tr>
	<tr>
		<td>Gelar S1</td>
		<td>:</td>
		<td><?php echo $gelar_s1; ?></td>
	</tr>
	<tr>
		<td>Asal Perguruan Tinggi S2</td>
		<td>:</td>
		<td><?php echo $pt_s2; ?></td>
	</tr>
	<tr>
		<td>Program Studi S2</td>
		<td>:</td>
		<td><?php echo $prodi_s2; ?></td>
	</tr>
	<tr>
		<td>Gelar S2</td>
		<td>:</td>
		<td><?php echo $gelar_s2; ?></td>
	</tr>
	<tr>
		<td>Asal Perguruan Tinggi S3</td>
		<td>:</td>
		<td><?php echo $pt_s3; ?></td>
	</tr>
	<tr>
		<td>Program Studi S3</td>
		<td>:</td>
		<td><?php echo $prodi_s3; ?></td>
	</tr>
	<tr>
		<td>Gelar S3</td>
		<td>:</td>
		<td><?php echo $gelar_s3; ?></td>
	</tr>
	<tr>
		<td  style="padding-top:30px;"><a href="index.php?target=dsn.edit.profile&aksi=ubah profile" class="button scrolly">Perbaharui Profile</a></td>
		<td  colspan=2 style="padding-top:30px;"><a href="index.php?target=dsn.edit.profile&aksi=ubah password" class="button scrolly">Ubah Password</a></td>
	</tr>
</table>
</div>
<div style="clear:both;">
	
<br>

</div>

<br>