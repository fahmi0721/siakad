<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
$id_dosen=$_SESSION['sesiusername'];
$qry_tahun=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_tahun=mysql_fetch_array($qry_tahun);

$no=1;
$qry_jadwal=mysql_query("select * from jadwal_kuliah where id_dosen='$id_dosen' and id_ta='$data_tahun[0]' GROUP BY kd_mk HAVING count(*) > 0");
$jum_jadwal=mysql_num_rows($qry_jadwal);
if ($jum_jadwal==0){
	echo "<br><br><br><br><br><center><h3>Maaf Anda Tidak Dapat Menginput Nilai<br>
	Anda Tidak Memiliki Mata kuliah yang di Ajarkan<br>
	Terima Kasih
	</h3></center>";
} else {

if (isset($_GET['mk'])){
	$mk=$_GET['mk'];
} else {	
	$mk="";
}

if (isset($_GET['kelas'])){
	$kelas=$_GET['kelas'];
} else {	
	$kelas="";
}

if(isset($_POST['submit'])){
$submit=$_POST['submit'];

$id_nilai=$_POST['id_nilai'];
$id_ta=$_POST['id_ta'];
$nim=$_POST['nim'];
$kd_mk=$_POST['kd_mk'];
$kelas=$_POST['kelas'];
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

	if ($submit=="Save"){
		mysql_query("insert into nilai values('','$id_ta','$nim','$kd_mk','$nilai','$huruf','$angka')");	
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=dsn.input.nilai&mk=$kd_mk&kelas=$kelas' />";
	} else {
		mysql_query("update nilai set total_nilai='$nilai', nilai_huruf='$huruf', nilai_angka='$angka' where id_nilai='$id_nilai' and nim='$nim' and kd_mk='$kd_mk'");
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=dsn.input.nilai&mk=$kd_mk&kelas=$kelas' />";	
	}	
}	
?>
<br>
 <h2>Halaman Input Nilai <br>Tahun Ajaran <?php echo $data_tahun[1]; ?> :</h2>
 <br>
 <table width=100%>
 <tr>
	<td width=20%>Mata Kuliah</td>
	<td width=5%>:</td>
	<td>
		<select name="mk" onChange="MM_jumpMenu('parent',this,0)">
			<option value="index.php?target=dsn.input.nilai">Mata Kuliah</option>
			<?php
				while($data_jadwal=mysql_fetch_array($qry_jadwal)){
					$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_jadwal[3]' GROUP BY kd_mk HAVING count(*) > 0");
					$data_mk=mysql_fetch_array($qry_mk);
			?>
				<option value="index.php?target=dsn.input.nilai&mk=<?php echo $data_mk[0]; ?>" <?php if ($mk==$data_mk[0]) {echo "selected";} ?>><?php echo $data_mk[0]. " - " .$data_mk[1]; ?></option>
			<?php	
				}
			?>
		</select>
	</td>
 </tr>
 <tr>
	<td width=20%>Kelas</td>
	<td width=5%>:</td>
	<td>
		<select name="kelas" onChange="MM_jumpMenu('parent',this,0)">
			<option value="index.php?target=dsn.input.nilai&mk=<?php echo $mk; ?>">Kelas</option>
			<?php
				$qry_jd=mysql_query("select * from jadwal_kuliah where id_dosen='$id_dosen' and kd_mk='$mk'");
				while($data_jd=mysql_fetch_array($qry_jd)){
					$qry_kelas=mysql_query("select * from ruang_kelas where id_kelas='$data_jd[2]'");
					$data_kelas=mysql_fetch_array($qry_kelas);
			?>
				<option value="index.php?target=dsn.input.nilai&mk=<?php echo $mk; ?>&kelas=<?php echo $data_kelas[0]; ?>" <?php if ($kelas==$data_kelas[0]) {echo "selected";} ?>><?php echo $data_kelas[4]; ?></option>
			<?php	
				}
			?>
		</select>
	</td>
 </tr>
 </table>
 <?php
 if (isset($_GET['mk']) and isset($_GET['kelas'])){
 ?>
 <table>
	<tr style="border-bottom:3px solid #aaa;">
		<th>No</th>
		<th>Mahasiswa</th>
		<th>Nilai</th>
		<th>Huruf</th>
		<th>Aksi</th>
	</tr>
	<?php
		$no=1;
		$qry_kls=mysql_query("select * from kelas_kuliah where id_kelas='$kelas'");
		while($data_kls=mysql_fetch_array($qry_kls)){
			$qry_mhs=mysql_query("select * from mahasiswa where nim='$data_kls[2]'");
			$data_mhs=mysql_fetch_array($qry_mhs);
			$qry_nilai=mysql_query("select * from nilai where nim='$data_mhs[0]' and kd_mk='$mk'");
			$jum_nilai=mysql_num_rows($qry_nilai);
			$data_nilai=mysql_fetch_array($qry_nilai);
	?>
	<form method="post" action="index.php?target=dsn.input.nilai">
	<tr style="border-bottom:1px solid #aaa;">
		<td align=center><?php echo $no; ?></td>
		<td>
		<input type="hidden" name="id_nilai" value="<?php echo $data_nilai[0]; ?>">
		<input type="hidden" name="kd_mk" value="<?php echo $mk; ?>">
		<input type="hidden" name="kelas" value="<?php echo $kelas; ?>">
		<input type="hidden" name="id_ta" value="<?php echo $data_tahun[0]; ?>">
		<input type="hidden" name="nim" value="<?php echo $data_mhs[0]; ?>">
		<?php echo $data_mhs[0]. " - " .$data_mhs[1]; ?></td>
		<td align=center><input type="text" name="nilai" value="<?php echo $data_nilai[4];?>" style="width:70px;text-align:center;">
		<td align=center><?php echo $data_nilai[5]; ?></td>
		<td align=center><input type="submit" name="submit" <?php if ($jum_nilai==0){ echo "value='Save'"; } else { echo "value='Update'"; } ?>></td>
	</tr>
	</form>
	<?php	
		$no++;
		}
	?>
 </table>
 <?php
 }
 }
 ?>
<br>
<br>
<br>
<br>