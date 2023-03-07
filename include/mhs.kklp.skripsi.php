<?php
	if(isset($_POST['submit'])){
		$id_kklp=$_POST['id_kklp'];
		$judul=$_POST['judul'];
		$fotoSem=$_FILES ["foto"]["tmp_name"];
		$nim=$_SESSION['sesiusername'];
		
		$foto=$_FILES ["foto"]["name"];
		$info = pathinfo($foto);
		$filetype= $info['extension'];
		$rname="kklp-$nim.$filetype";
		if($info['extension'] == 'pdf'){
			$lokasi="admin/file_kklp/$rname";
			copy ($fotoSem,$lokasi);
			mysql_query("update kklp set file_laporan='$rname', laporan_kklp='$judul' where nim='$_SESSION[sesiusername]' and id_kklp='$id_kklp'");
			echo "<script>alert ('Thank You Success For Update Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi' />";
			} else {
			echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa PDF')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi&aksi=input_kklp' />";
		}
	}
	
	if(isset($_POST['submit_skripsi'])){
		$id_skripsi=$_POST['id_skripsi'];
		$judul=$_POST['judul'];
		$fotoSem=$_FILES ["foto"]["tmp_name"];
		$nim=$_SESSION['sesiusername'];
		
		$foto=$_FILES ["foto"]["name"];
		$info = pathinfo($foto);
		$filetype= $info['extension'];
		$rname="skripsi-$nim.$filetype";
		
		$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
		$data_ta=mysql_fetch_array($qry_ta);
		
		if($info['extension'] == 'pdf'){
			$lokasi="admin/file_skripsi/$rname";
			copy ($fotoSem,$lokasi);
			mysql_query("insert into skripsi values('$id_skripsi','$nim','$data_ta[0]','$judul','$rname','pending','')");
			echo "<script>alert ('Thank You Success For Update Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi' />";
			} else {
			echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa PDF')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi' />";
		}
	}
	
	if(isset($_POST['update_skripsi'])){
		$id_skripsi=$_POST['id_skripsi'];
		$judul=$_POST['judul'];
		$fotolama=$_POST['fotolama'];
		
		$fotoSem=$_FILES ["foto"]["tmp_name"];
		$nim=$_SESSION['sesiusername'];
		
		$foto=$_FILES ["foto"]["name"];
		$info = pathinfo($foto);
		$filetype= $info['extension'];
		$rname="skripsi-$nim.$filetype";
		
		$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
		$data_ta=mysql_fetch_array($qry_ta);
		
		if($info['extension'] == 'pdf'){
			
			unlink("admin/file_skripsi/$fotolama");
			$lokasi="admin/file_skripsi/$rname";
			copy ($fotoSem,$lokasi);
			mysql_query("update skripsi set judul_skripsi='$judul', file_skripsi='$rname', status='pending' where id_skripsi='$id_skripsi' and nim='$nim'");
			echo "<script>alert ('Thank You Success For Update Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi' />";
			} else {
			echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa PDF')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=mhs.kklp.skripsi' />";
		}
	}
?>
<br>
<header>
	<h2 class="alt">Data KKLP</h2>
	<hr>	
</header>
<div style="width:100%;margin-top:-20px;">
	<?php
		$qry_kklp=mysql_query("select * from kklp where nim='$_SESSION[sesiusername]'");
		$data_kklp=mysql_fetch_array($qry_kklp);
		$jum_kklp=mysql_num_rows($qry_kklp);
		$qry_pem=mysql_query("select * from pembimbing_kklp where nim='$_SESSION[sesiusername]'");
		$data_pem=mysql_fetch_array($qry_pem);
		$qry_dosen=mysql_query("select * from dosen where id_dosen='$data_pem[2]'");
		$data_dosen=mysql_fetch_array($qry_dosen);
		if($jum_kklp==0){
			echo "<center><br>";
			echo "<h3 style='color:#f00;'>Maaf Data KKLP Anda Belum Terdaftar</h3>";
			echo "<br><br></center>";
		} else {
	?>
<table>
	<tr>
		<td width=200>Nama Instansi</td>
		<td width=15>:</td>
		<td><?php echo $data_kklp[3]; ?></td>
	</tr>
	<tr>
		<td>Alamat Instansi</td>
		<td>:</td>
		<td><?php echo $data_kklp[4]; ?></td>
	</tr>
	<tr>
		<td>Pembimbing</td>
		<td>:</td>
		<td><?php echo $data_dosen[2]; ?></td>
	</tr>
	<tr>
		<td>Laporan :</td>
	</tr>
	<?php 
		if (!isset($_GET['aksi']) and $data_kklp[5]=="" and $data_kklp[6]==""){
	?>
	<tr>
		<td><b style="color:#f00;">Data Belum Ada</b> <br>
		<a href="index.php?target=mhs.kklp.skripsi&aksi=input_kklp">Input Laporan</a>
		</td>
	</tr>	
	<?php	
		} else if(!isset($_GET['aksi'])){
	?>
	<tr>
		<td>Judul Laporan</td>
		<td>:</td>
		<td><?php echo $data_kklp[5]; ?></td>
	</tr>
	<tr>
		<td>File Laporan</td>
		<td>:</td>
		<td><a href="admin/file_kklp/<?php echo $data_kklp[6]; ?>">Download Laporan</a></td>
	</tr>
	<?php
		}
		
		if (isset($_GET['aksi'])){
			$aksi=$_GET['aksi'];
			if ($aksi=="input_kklp"){
	?>
	
		<form action="index.php?target=mhs.kklp.skripsi" method="post" enctype="multipart/form-data">
	<tr>	
		<td colspan=3 style="padding-top:5px;">
			<input type="text" name="judul" style="width:700px;" required placeholder="Masukkan Judul Laporan KKLP">
			<input type="hidden" name="id_kklp" value="<?php echo $data_kklp[0]; ?>">
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="file" name="foto" size="30" multiple style="overflow:hidden;width:330px;" required>
			<br>
			*Upload File PDF	
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="submit" name="submit" value="Simpan">
			<input type="submit" name="submit" value="Cancel">
		</td>
		</form>
	</tr>
	<?php
			}
		}
	?>
</table>
<?php
}
?>
</div>
<header>
	<h2 class="alt">Data Skripsi</h2>
	<hr>	
</header>
<div style="width:100%;margin-top:-10px;">
<table>
	<form action="index.php?target=mhs.kklp.skripsi" method="post" enctype="multipart/form-data">
	<?php
		$qry_skripsi=mysql_query("select * from skripsi where nim='$_SESSION[sesiusername]'");
		$data_skripsi=mysql_fetch_array($qry_skripsi);
		$jum_skripsi=mysql_num_rows($qry_skripsi);
		if($jum_skripsi>0){
	?>
	<tr>
		<td width=200>Judul Skripsi</td>
		<td width=15>:</td>
		<td><?php echo $data_skripsi[3]; ?></td>
	</tr>
	<tr>
		<td>File Skripsi</td>
		<td>:</td>
		<td><a href="admin/file_skripsi/<?php echo $data_skripsi[4]; ?>">Download Skripsi</a></td>
	</tr>
	<tr>
		<td width=200>Status</td>
		<td width=15>:</td>
		<td><?php if ($data_skripsi[5]=="pending"){ echo "<b style='color:blue;'>Dalam Proses</b>"; } else if ($data_skripsi[5]=="acc"){ echo "<b style='color:green;'>Di Terima</b>"; } else if ($data_skripsi[5]=="tolak"){ echo "<b style='color:#f00;'>Maaf Judul Skripsi Di Tolak</b>"; } ?></td>
	</tr>
	<?php
		if($data_skripsi[5]=="acc"){
		$qry_pem=mysql_query("select * from pembimbing_skripsi where nim='$_SESSION[sesiusername]'");
		$data_pem=mysql_fetch_array($qry_pem);
		$jum_pem=mysql_num_rows($qry_pem);
		$qry_dosen1=mysql_query("select * from dosen where id_dosen='$data_pem[2]'");
		$qry_dosen2=mysql_query("select * from dosen where id_dosen='$data_pem[3]'");
		$data_dosen1=mysql_fetch_array($qry_dosen1);
		$data_dosen2=mysql_fetch_array($qry_dosen2);
	?>
	<tr>
		<td>Pembimbing</td>
	</tr>
	<?php
	if($jum_pem==0){
	?>
	<tr>
		<td><b style='color:#f00;'>Data Belum Ada</b></td>
	</tr>
	<?php
	} else {	
	?>
	<tr>
		<td>Pembimbing 1</td>
		<td>:</td>
		<td><?php echo $data_dosen1[2]; ?></td>
	</tr>
	<tr>
		<td>Pembimbing 2</td>
		<td>:</td>
		<td><?php echo $data_dosen2[2]; ?></td>
	</tr>
	<?php
		}
	} if($data_skripsi[5]=="tolak"){
	?>
	<tr>
		<td colspan=3>Masukkan Judul Skripsi Anda Yang Baru</td>
	</tr>
	<tr>	
		<td colspan=3 style="padding-top:5px;">
			<input type="text" name="judul" style="width:700px;" required placeholder="Masukkan Judul Skripsi Anda">
			<input type="hidden" name="id_skripsi" value="<?php echo $data_skripsi[0]; ?>">
			<input type="hidden" name="fotolama" value="<?php echo $data_skripsi[4]; ?>">
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="file" name="foto" size="30" multiple style="overflow:hidden;width:330px;" required>
			<br>
			*Upload File PDF	
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="submit" name="update_skripsi" value="Simpan">
			<input type="submit" name="update_skripsi" value="Cancel">
		</td>
		</form>
	</tr>
	<?php
	}
		} else {
	?>
	<tr>	
		<td colspan=3 style="padding-top:5px;">
			<input type="text" name="judul" style="width:700px;" required placeholder="Masukkan Judul Skripsi Anda">
			<input type="hidden" name="id_skripsi" value="<?php echo $data_skripsi[0]; ?>">
			<input type="hidden" name="fotolama" value="<?php echo $data_skripsi[4]; ?>">
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="file" name="foto" size="30" multiple style="overflow:hidden;width:330px;" required>
			<br>
			*Upload File PDF	
		</td>
	</tr>
	<tr>
		<td colspan=3 style="padding-top:5px;">
			<input type="submit" name="submit_skripsi" value="Simpan">
			<input type="submit" name="submit_skripsi" value="Cancel">
		</td>
		</form>
	</tr>
	<?php
		}
	?>
</table>
</div>