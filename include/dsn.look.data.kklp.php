<?php
	if(isset($_POST['submit'])){
		$id_nilai=$_POST['id_nilai'];
		$id_kklp=$_POST['id_kklp'];
		$nim=$_POST['nim'];
		$kd_mk=$_POST['kd_mk'];
		$nilai=$_POST['nilai'];
		
		$qry_sks=mysql_query("select sks from mata_kuliah where kd_mk='$kd_mk'");
		$data_sks=mysql_fetch_array($qry_sks);
		$sks=$data_sks[0];

		if($nilai>=85){
			$huruf="A";
			$angka=4*$sks;
		} else if($nilai>=75){
			$huruf="B";
			$angka=3*$sks;
		} else if($nilai>=65){
			$huruf="C";
			$angka=2*$sks;	
		} else if($nilai>=55){
			$huruf="D";
			$angka=1*$sks;	
		} else if($nilai<55){
			$huruf="E";
			$angka=0*$sks;
		}
		
		$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
		$data_ta=mysql_fetch_array($qry_ta);
		$id_ta=$data_ta[0];
		
		$jum_nilai=mysql_num_rows(mysql_query("select * from nilai where nim='$nim' and kd_mk='$kd_mk'"));
		if($jum_nilai==0){
			mysql_query("insert into nilai values('','$id_ta','$nim','$kd_mk','$nilai','$huruf','$angka')");
			echo "<script>alert ('Thank You Success For Saving Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=dsn.look.data.kklp&nim=$nim' />";
		} else {
			mysql_query("update nilai set total_nilai='$nilai', nilai_huruf='$huruf', nilai_angka='$angka' where id_nilai='$id_nilai' and nim='$nim' and kd_mk='$kd_mk'");
			echo "<script>alert ('Thank You Success For Saving Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=dsn.look.data.kklp&nim=$nim' />";
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
	if(isset($_GET['nim'])){	
		$nim=$_GET['nim'];
	} else {
		$nim=$_POST['nim'];
	}	
		$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
		$data_mhs=mysql_fetch_array($qry_mhs);
		$qry_kklp=mysql_query("select * from kklp where nim='$nim'");
		$data_kklp=mysql_fetch_array($qry_kklp);
		$jum_kklp=mysql_num_rows($qry_kklp);		
		
		$qry_nilai=mysql_query("select * from nilai where nim='$nim' and kd_mk='$data_kklp[7]'");
		$data_nilai=mysql_fetch_array($qry_nilai);
	?>
<table>
	<tr>
		<td width=200>Nim</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[0]; ?></td>
	</tr>
	<tr>
		<td width=200>Nama Mahasiswa</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[1]; ?></td>
	</tr>
	<tr>
		<td width=200>Angkatan</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[9]; ?></td>
	</tr>
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
		<td>Laporan :</td>
	</tr>
	<?php 
		if ($data_kklp[5]=="" and $data_kklp[6]==""){
	?>
	<tr>
		<td><b style="color:#f00;">Data Belum Ada</b>
		</td>
	</tr>	
	<?php	
		} else {
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
	<form action="index.php?target=dsn.look.data.kklp" method="post">
	<tr>
		<td>Input Nilai</td>
		<td>:</td>
		<td>
			<input type="hidden" name="id_kklp" value="<?php echo $data_kklp[0]; ?>">
			<input type="hidden" name="nim" value="<?php echo $data_kklp[1]; ?>">
			<input type="hidden" name="kd_mk" value="<?php echo $data_kklp[7]; ?>">
			<input type="hidden" name="id_nilai" value="<?php echo $data_nilai[0]; ?>">
			<input type="text" name="nilai" value="<?php echo $data_nilai[4]; ?>" placeholder="Masukkan Nilai" required>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<input type="submit" name="submit" value="Simpan">
		</td>
	</tr>
	</form>
	<?php
		}
	?>	
</table>
</div>