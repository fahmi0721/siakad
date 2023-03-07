<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<style>
.tab th,td{
	padding:5px;
}
</style>
<?php
if (!isset($_GET['angkatan'])){
	$angkatan = "";
} else {
	$angkatan = $_GET['angkatan'];
}

if (!isset($_GET['prodi'])){
	$prodi = "";
} else {
	$prodi = $_GET['prodi'];
}

if (!isset($_GET['kelas'])){
	$kelas = "";
} else {
	$kelas = $_GET['kelas'];
}

if (isset($_POST['submit'])){

	$submit=$_POST['submit'];
	$id_jadwal=$_POST['id_jadwal'];
	
	$kelas=$_POST['kelas'];
	$kd_mk=$_POST['kd_mk'];
	$id_ta=$_POST['id_ta'];
	$dosen=$_POST['dosen'];
	$ruangan=$_POST['ruangan'];
	$hari=$_POST['hari'];
	$jam=$_POST['jam'];
	$ruangan2=$_POST['ruangan2'];
	$hari2=$_POST['hari2'];
	$jam2=$_POST['jam2'];
	
	$prodi=$_POST['prodi'];
	$angkatan=$_POST['angkatan'];
		
	if ($submit=="Save"){
		if ($ruangan2=="" and $hari2=="" and $jam2==""){
		$cek_ruangan=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_ruangan='$ruangan' and hari='$hari' and jam='$jam') or (id_ruangan='$ruangan' and hari2='$hari' and jam2='$jam')"));	
		}else{
		$cek_ruangan=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_ruangan='$ruangan' and hari='$hari' and jam='$jam') or (id_ruangan='$ruangan' and hari='$hari2' and jam='$jam2') or (id_ruangan='$ruangan' and hari2='$hari' and jam2='$jam') or (id_ruangan='$ruangan' and hari2='$hari2' and jam2='$jam2')"));
		}
		if ($cek_ruangan==0 and $hari!=$hari2){
			if ($ruangan2=="" and $hari2=="" and $jam2==""){
			$cek_kelas=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_kelas='$kelas' and hari='$hari' and jam='$jam') or (id_kelas='$kelas' and hari2='$hari' and jam2='$jam')"));
			}else{
			$cek_kelas=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_kelas='$kelas' and hari='$hari' and jam='$jam') or (id_kelas='$kelas' and hari='$hari2' and jam='$jam2') or (id_kelas='$kelas' and hari2='$hari' and jam2='$jam') or (id_kelas='$kelas' and hari2='$hari2' and jam2='$jam2')"));
			}
			
		//$qry_jadwal=mysql_query("select * from jadwal_kuliah where hari='$hari' and jam='$jam' and id_dosen='$dosen' or (hari='$hari2' and jam='$jam2' and id_dosen='$dosen') or (hari2='$hari' and jam2='$jam' and id_dosen='$dosen') or (hari2='$hari2' and jam2='$jam2' and id_dosen='$dosen')");
		//$jum_jadwal=mysql_num_rows($qry_jadwal);
		
		//$qry_jadwal2=mysql_query("select * from jadwal_kuliah where (hari='$hari' and jam='$jam' and id_ruangan='$ruangan') or (hari='$hari2' and jam='$jam2' and id_ruangan='$ruangan2') or (hari2='$hari' and jam2='$jam' and ruangan2='$ruangan') or (hari2='$hari2' and jam2='$jam2' and ruangan2='$ruangan2')");
		//$jum_jadwal2=mysql_num_rows($qry_jadwal2);
		
			//if ($jum_jadwal==0){
				if ($cek_kelas==0){
					if ($ruangan2=="" and $hari2=="" and $jam2==""){
					$cek_dosen=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_dosen='$dosen' and hari='$hari' and jam='$jam') or (id_dosen='$dosen' and hari2='$hari' and jam2='$jam')"));
					}else{
					$cek_dosen=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_dosen='$dosen' and hari='$hari' and jam='$jam') or (id_dosen='$dosen' and hari='$hari2' and jam='$jam2') or (id_dosen='$dosen' and hari2='$hari' and jam2='$jam') or (id_dosen='$dosen' and hari2='$hari2' and jam2='$jam2')"));
					}
						if ($cek_dosen==0){
							mysql_query("insert into jadwal_kuliah values('','$id_ta','$kelas','$kd_mk','$dosen','$ruangan','$hari','$jam','$ruangan2','$hari2','$jam2')");
							echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
						}else{
							echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
							echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
						}
				}else{
					echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
					echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
				}
			//} else {
			//echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
			//echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
			//}
		
		} else {
			echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
		}
		
	} elseif ($submit=="Update"){
		if ($ruangan2=="" and $hari2=="" and $jam2==""){
		$cek_ruangan=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_ruangan='$ruangan' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_ruangan='$ruangan' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal')"));	
		}else{
		$cek_ruangan=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_ruangan='$ruangan' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_ruangan='$ruangan' and hari='$hari2' and jam='$jam2' and id_jadwal_kuliah!='$id_jadwal') or (id_ruangan='$ruangan' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_ruangan='$ruangan' and hari2='$hari2' and jam2='$jam2' and id_jadwal_kuliah!='$id_jadwal')"));
		}
		if ($cek_ruangan==0 and $hari!=$hari2){
			if ($ruangan2=="" and $hari2=="" and $jam2==""){
			$cek_kelas=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_kelas='$kelas' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_kelas='$kelas' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal')"));
			}else{
			$cek_kelas=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_kelas='$kelas' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_kelas='$kelas' and hari='$hari2' and jam='$jam2' and id_jadwal_kuliah!='$id_jadwal') or (id_kelas='$kelas' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_kelas='$kelas' and hari2='$hari2' and jam2='$jam2' and id_jadwal_kuliah!='$id_jadwal')"));
			}
			
		//$qry_jadwal=mysql_query("select * from jadwal_kuliah where hari='$hari' and jam='$jam' and id_dosen='$dosen' or (hari='$hari2' and jam='$jam2' and id_dosen='$dosen') or (hari2='$hari' and jam2='$jam' and id_dosen='$dosen') or (hari2='$hari2' and jam2='$jam2' and id_dosen='$dosen')");
		//$jum_jadwal=mysql_num_rows($qry_jadwal);
		
		//$qry_jadwal2=mysql_query("select * from jadwal_kuliah where (hari='$hari' and jam='$jam' and id_ruangan='$ruangan') or (hari='$hari2' and jam='$jam2' and id_ruangan='$ruangan2') or (hari2='$hari' and jam2='$jam' and ruangan2='$ruangan') or (hari2='$hari2' and jam2='$jam2' and ruangan2='$ruangan2')");
		//$jum_jadwal2=mysql_num_rows($qry_jadwal2);
		
			//if ($jum_jadwal==0){
				if ($cek_kelas==0){
					if ($ruangan2=="" and $hari2=="" and $jam2==""){
					$cek_dosen=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_dosen='$dosen' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_dosen='$dosen' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal')"));
					}else{
					$cek_dosen=mysql_num_rows(mysql_query("select * from jadwal_kuliah where (id_dosen='$dosen' and hari='$hari' and jam='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_dosen='$dosen' and hari='$hari2' and jam='$jam2' and id_jadwal_kuliah!='$id_jadwal') or (id_dosen='$dosen' and hari2='$hari' and jam2='$jam' and id_jadwal_kuliah!='$id_jadwal') or (id_dosen='$dosen' and hari2='$hari2' and jam2='$jam2' and id_jadwal_kuliah!='$id_jadwal')"));
					}
						if ($cek_dosen==0){
							mysql_query("update jadwal_kuliah set id_dosen='$dosen',id_ruangan='$ruangan',hari='$hari',jam='$jam',ruangan2='$ruangan2',hari2='$hari2',jam2='$jam2'  where id_jadwal_kuliah='$id_jadwal'");
							echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
						}else{
							echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
							echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
						}
				}else{
					echo "<script>alert ('Maaf, Jadwal Ada Yang Samaa')</script>";
					echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
				}
			//} else {
			//echo "<script>alert ('Maaf, Jadwal Ada Yang Sama')</script>";
			//echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
			//}
		
		} else {
			echo "<script>alert ('Maaf, Jadwal Ada Yang Samaaa')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.jadwal.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$kelas' />";
		}	
	}
}
?>
<div class="content-module-heading cf">
	<h3 class="fl">Look Jadwal Kuliah</h3>
</div> <!-- end content-module-heading -->
<div class="content-module-main">
<center>
<form>
<table width=100% class=tab>
	<tr>
		<td><b>Tahun Ajaran</b></td>
		<td>:</td>
		<td>
			<?php
				$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
				$data_ta=mysql_fetch_array($qry_ta);
				echo "<b>$data_ta[1]</b>";
			?>
		</td>
	</tr>
	<tr>
		<td width=10%><b>Angkatan</b></td>
		<td width=5%><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.jadwal.kuliah">[ -- Pilih Angkatan -- ]</option>
				<?php
					$qry_angkatan=mysql_query("select thn_msk from mahasiswa GROUP BY thn_msk HAVING count(*) > 0 order by(thn_msk) asc");
					while($data_angkatan=mysql_fetch_array($qry_angkatan)){
				?>
				<option value="index.php?target=look.jadwal.kuliah&angkatan=<?php echo $data_angkatan[0]; ?>&prodi=<?php echo $prodi; ?>" <?php if ($angkatan=="$data_angkatan[0]"){ echo "selected"; }?>><?php echo $data_angkatan[0]; ?></option>	
				<?php		
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>Program Studi</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.jadwal.kuliah&angkatan=<?php echo $angkatan; ?>">[ -- Pilih Program Studi -- ]</option>
				<?php
					$qry_prodi=mysql_query("select * from konsentrasi");
					while($data_prodi=mysql_fetch_array($qry_prodi)){
				?>
					<option value="index.php?target=look.jadwal.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $data_prodi[0]; ?>" <?php if ($prodi=="$data_prodi[0]"){ echo "selected"; } ?>><?php echo $data_prodi[2]; ?></option>
				<?php		
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>Kelas</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.jadwal.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>">[ -- Pilih Kelas -- ]</option>
				<?php
					$qry_thn_ajar=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
					$data_thn_ajar=mysql_fetch_array($qry_thn_ajar);
					$qry_kelas=mysql_query("select * from ruang_kelas where kd_konsentrasi='$prodi' and angkatan='$angkatan' and id_ta='$data_thn_ajar[0]'");
					while($data_kelas=mysql_fetch_array($qry_kelas)){
				?>
					<option value="index.php?target=look.jadwal.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>&kelas=<?php echo $data_kelas[0]; ?>" <?php if ($kelas=="$data_kelas[0]"){ echo "selected"; }?>><?php echo $data_kelas[4]; ?></option>
				<?php
					}
				?>
			</select>	
		</td>
	</tr>
</table>
</form>
<br>
<table width=100% class="tabel">
	<tr>
		<th align=center rowspan=2 width=5%><b>No</b></th>
		<th align=center rowspan=2 width=10%><b>Kode</b></th>
		<th align=center rowspan=2 width=27%><b>Matakuliah</b></th>
		<th align=center rowspan=2 width=25%><b>Dosen</b></th>
		<th align=center colspan=3><b>Pertemuan 1</b></th>
		<th align=center colspan=3><b>Pertemuan 2 (4 SKS atau 3 SKS)</b></th>
		<th align=center rowspan=2><b>Aksi</b></th>
	</tr>	
	<tr>
		<th align=center width=10%><b>Ruangan</b></th>
		<th align=center><b>Hari</b></th>
		<th align=center><b>Jam</b></th>
		<th align=center width=10%><b>Ruangan</b></th>
		<th align=center><b>Hari</b></th>
		<th align=center><b>Jam</b></th>
	</tr>	
	<?php
	if (isset($_GET['angkatan']) and isset($_GET['prodi']) and isset($_GET['kelas'])){
		$no=1;
			$qry_krs=mysql_query("select * from krs where id_kelas='$kelas' and status='acc' GROUP BY kd_mk HAVING count(*) > 0");
			while($data_krs=mysql_fetch_array($qry_krs)){
			$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_krs[2]'");
			$data_mk=mysql_fetch_array($qry_mk);
			
			$qry_jadwal=mysql_query("select * from jadwal_kuliah where id_kelas='$kelas' and kd_mk='$data_krs[2]'");
			$data_jadwal=mysql_fetch_array($qry_jadwal);
			$jum_jadwal=mysql_num_rows($qry_jadwal);
			
			$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
			$data_thn=mysql_fetch_array($qry_thn);
			
			if($data_mk[1]!="Skripsi" and $data_mk[1]!="Kerja Praktek" and $data_mk[1]!="Praktek Kerja Lapang"){
	?>
	<tr>
	<form method="post" action="index.php?target=look.jadwal.kuliah">
		<td align=center><?php echo $no; ?></td>
		<td align=center><?php echo $data_mk[0]; ?>
		<input type="hidden" name="id_jadwal" value="<?php echo $data_jadwal[0]; ?>">
		
		<input type="hidden" name="kd_mk" value="<?php echo $data_mk[0]; ?>">
		<input type="hidden" name="kelas" value="<?php echo $kelas; ?>">
		<input type="hidden" name="id_ta" value="<?php echo $data_thn[0]; ?>">
		
		<input type="hidden" name="prodi" value="<?php echo $prodi; ?>">
		<input type="hidden" name="angkatan" value="<?php echo $angkatan; ?>">
		</td>
		<td><?php echo $data_mk[1]; ?></td>
		<td>
		<select name="dosen" class="text_medium round" required>
		<option value="">-- Pilih Dosen --</option>
			<?php
				$qry_dosen=mysql_query("select * from dosen");
				while($data_dosen=mysql_fetch_array($qry_dosen)){
			?>
				<option value="<?php echo $data_dosen[0]; ?>" <?php if ($data_jadwal[4]=="$data_dosen[0]"){ echo "selected"; }?>><?php echo $data_dosen[2]; ?></option>
			<?php	
				}
			?>
		</select>
		</td>
		<td align=center>
		<select name="ruangan" class="text_kecil round" required>
			<option value="">-- Pilih Ruangan --</option>
			<?php
				$qry_ruangan=mysql_query("select * from ruangan");
				while($data_ruangan=mysql_fetch_array($qry_ruangan)){
			?>
				<option value="<?php echo $data_ruangan[0]; ?>" <?php if ($data_jadwal[5]=="$data_ruangan[0]"){ echo "selected"; }?>><?php echo $data_ruangan[1]; ?></option>
			<?php	
				}
			?>
		</select>
		</td>
		<td align=center>
		<select name="hari" class="round text_kecil" required>
			<option value="" <?php if ($data_jadwal[6]==""){ echo "selected"; }?>>-- Pilih Hari --</option>
			<option value="Senin" <?php if ($data_jadwal[6]=="Senin"){ echo "selected"; }?>>Senin</option>
			<option value="Selasa" <?php if ($data_jadwal[6]=="Selasa"){ echo "selected"; }?>>Selasa</option>
			<option value="Rabu" <?php if ($data_jadwal[6]=="Rabu"){ echo "selected"; }?>>Rabu</option>
			<option value="Kamis" <?php if ($data_jadwal[6]=="Kamis"){ echo "selected"; }?>>Kamis</option>
			<option value="Jumat" <?php if ($data_jadwal[6]=="Jumat"){ echo "selected"; }?>>Jumat</option>
			<option value="Sabtu" <?php if ($data_jadwal[6]=="Sabtu"){ echo "selected"; }?>>Sabtu</option>
			<option value="Minggu" <?php if ($data_jadwal[6]=="Minggu"){ echo "selected"; }?>>Minggu</option>
		</select>
		</td>
		<td align=center>
		<select name="jam" class="round text_kecil" required>
			<option value="" <?php if ($data_jadwal[7]==""){ echo "selected"; }?>>-- Pilih Jam --</option>
			<option value="08.00 - 09.40" <?php if ($data_jadwal[7]=="08.00 - 09.40"){ echo "selected"; }?>>08.00 - 09.40</option>
			<option value="09.45 - 11.25" <?php if ($data_jadwal[7]=="09.45 - 11.25"){ echo "selected"; }?>>09.45 - 11.25</option>
			<option value="11.30 - 13.10" <?php if ($data_jadwal[7]=="11.30 - 13.10"){ echo "selected"; }?>>11.30 - 13.10</option>
			<option value="13.15 - 14.55" <?php if ($data_jadwal[7]=="13.15 - 14.55"){ echo "selected"; }?>>13.15 - 14.55</option>
			<option value="15.00 - 16.40" <?php if ($data_jadwal[7]=="15.00 - 16.40"){ echo "selected"; }?>>15.00 - 16.40</option>
			<option value="16.45 - 18.25" <?php if ($data_jadwal[7]=="16.45 - 18.25"){ echo "selected"; }?>>16.45 - 18.25</option>
			<option value="18.30 - 20.10" <?php if ($data_jadwal[7]=="18.30 - 20.10"){ echo "selected"; }?>>18.30 - 20.10</option>
			<option value="20.15 - 22.00" <?php if ($data_jadwal[7]=="20.15 - 22.00"){ echo "selected"; }?>>20.15 - 22.00</option>
		</select>
		</td>
		
		<td align=center>
		<?php if($data_mk[2]=="4" or $data_mk[2]=="3"){ ?>
		<select name="ruangan2" class="text_kecil round" required>
			<option value="">-- Pilih Ruangan --</option>
			<?php
				$qry_ruangan=mysql_query("select * from ruangan");
				while($data_ruangan=mysql_fetch_array($qry_ruangan)){
			?>
				<option value="<?php echo $data_ruangan[0]; ?>" <?php if ($data_jadwal[8]=="$data_ruangan[0]"){ echo "selected"; }?>><?php echo $data_ruangan[1]; ?></option>
			<?php	
				}
			?>
		</select>
		<?php
			} else {
				echo "None";
				echo "<input type='hidden' name='ruangan2' value=''>";
			}
		?>
		</td>
		<td align=center>
		<?php if($data_mk[2]=="4" or $data_mk[2]=="3"){ ?>
		<select name="hari2" class="round text_kecil" required>
			<option value="" <?php if ($data_jadwal[9]==""){ echo "selected"; }?>>-- Pilih Hari --</option>
			<option value="Senin" <?php if ($data_jadwal[9]=="Senin"){ echo "selected"; }?>>Senin</option>
			<option value="Selasa" <?php if ($data_jadwal[9]=="Selasa"){ echo "selected"; }?>>Selasa</option>
			<option value="Rabu" <?php if ($data_jadwal[9]=="Rabu"){ echo "selected"; }?>>Rabu</option>
			<option value="Kamis" <?php if ($data_jadwal[9]=="Kamis"){ echo "selected"; }?>>Kamis</option>
			<option value="Jumat" <?php if ($data_jadwal[9]=="Jumat"){ echo "selected"; }?>>Jumat</option>
			<option value="Sabtu" <?php if ($data_jadwal[9]=="Sabtu"){ echo "selected"; }?>>Sabtu</option>
			<option value="Minggu" <?php if ($data_jadwal[9]=="Minggu"){ echo "selected"; }?>>Minggu</option>
		</select>
		<?php
			} else {
				echo "None";
				echo "<input type='hidden' name='hari2' value=''>";
			}
		?>
		</td>
		<td align=center>
		<?php if($data_mk[2]=="4" or $data_mk[2]=="3"){ ?>
		<select name="jam2" class="round text_kecil" required>
			<option value="" <?php if ($data_jadwal[10]==""){ echo "selected"; }?>>-- Pilih Jam --</option>
			<option value="08.00 - 09.40" <?php if ($data_jadwal[10]=="08.00 - 09.40"){ echo "selected"; }?>>08.00 - 09.40</option>
			<option value="09.45 - 11.25" <?php if ($data_jadwal[10]=="09.45 - 11.25"){ echo "selected"; }?>>09.45 - 11.25</option>
			<option value="11.30 - 13.10" <?php if ($data_jadwal[10]=="11.30 - 13.10"){ echo "selected"; }?>>11.30 - 13.10</option>
			<option value="13.15 - 14.55" <?php if ($data_jadwal[10]=="13.15 - 14.55"){ echo "selected"; }?>>13.15 - 14.55</option>
			<option value="15.00 - 16.40" <?php if ($data_jadwal[10]=="15.00 - 16.40"){ echo "selected"; }?>>15.00 - 16.40</option>
			<option value="16.45 - 18.25" <?php if ($data_jadwal[10]=="16.45 - 18.25"){ echo "selected"; }?>>16.45 - 18.25</option>
			<option value="18.30 - 20.10" <?php if ($data_jadwal[10]=="18.30 - 20.10"){ echo "selected"; }?>>18.30 - 20.10</option>
			<option value="20.15 - 22.00" <?php if ($data_jadwal[10]=="20.15 - 22.00"){ echo "selected"; }?>>20.15 - 22.00</option>
		</select>
		<?php
			} else {
				echo "None";
				echo "<input type='hidden' name='jam2' value=''>";
			}
		?>
		</td>
		<td>
			<input type="submit" name="submit" <?php if ($jum_jadwal==0){ echo "value='Save'"; }else{ echo "value='Update'";} ?> >
		</td>
	</tr>	
	</form>
	<?php
		$no++;
		}				
		}				
		}				
	?>
</table>	
</center>
<br>
<br>
</div>