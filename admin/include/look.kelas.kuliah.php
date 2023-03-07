<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }

</script>
<style>
.tab th,td{
	padding:5px;
}
</style>
<?php
if (isset($_POST['submit'])){
	$id_kelas=$_POST['id_kelas'];
	$angkatan=$_POST['angkatan'];
	$prodi=$_POST['prodi'];
	$id_ta=$_POST['id_ta'];
	
	if (isset($_POST['cek'])){
	$cek=$_POST['cek'];
	$jum = count($cek);
	
	$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
	
	$qry_kl=mysql_query("select * from kelas_kuliah where nim='$data_mhs[0]' and id_kelas='$id_kelas'");
	$jum_kl=mysql_num_rows($qry_kl);
		if ($jum_kl>0){
			mysql_query("delete from kelas_kuliah where nim='$data_mhs[0]'");
		}	
	}	
	
	$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
	$data_thn=mysql_fetch_array($qry_thn);
	
		for ($i = 0; $i < $jum; ++$i) {
			$qry1=mysql_query("update krs set id_kelas='$id_kelas' where nim='$cek[$i]' and id_ta='$id_ta'");
			$qry=mysql_query("insert into kelas_kuliah values('','$id_kelas','$cek[$i]','$id_ta')");
		}

		echo "<script>alert ('Data Kelas Kuliah Telah Disimpan')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.kelas.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$id_kelas' />";

	} else {
		echo "<script>alert ('Data Belum Dipilih')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.kelas.kuliah&angkatan=$angkatan&prodi=$prodi&kelas=$id_kelas' />";
	}

}

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
?>
<div class="content-module-heading cf">
	<h3 class="fl">Look Data Kelas Kuliah</h3>
</div> <!-- end content-module-heading -->
<div class="content-module-main">
<center>
<form>
<table width=50% class=tab>
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
		<td><b>Angkatan</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.kelas.kuliah">[ -- Pilih Angkatan -- ]</option>
				<?php
					$qry_angkatan=mysql_query("select thn_msk from mahasiswa GROUP BY thn_msk HAVING count(*) > 0 order by(thn_msk) asc");
					while($data_angkatan=mysql_fetch_array($qry_angkatan)){
				?>
				<option value="index.php?target=look.kelas.kuliah&angkatan=<?php echo $data_angkatan[0]; ?>&prodi=<?php echo $prodi; ?>" <?php if ($angkatan=="$data_angkatan[0]"){ echo "selected"; }?>><?php echo $data_angkatan[0]; ?></option>	
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
				<option value="index.php?target=look.kelas.kuliah&angkatan=<?php echo $angkatan; ?>">[ -- Pilih Program Studi -- ]</option>
				<?php
					$qry_prodi=mysql_query("select * from konsentrasi");
					while($data_prodi=mysql_fetch_array($qry_prodi)){
				?>
					<option value="index.php?target=look.kelas.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $data_prodi[0]; ?>" <?php if ($prodi=="$data_prodi[0]"){ echo "selected"; } ?>><?php echo $data_prodi[2]; ?></option>
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
				<option value="index.php?target=look.kelas.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>">[ -- Pilih Kelas -- ]</option>
				<?php
					$qry_thn_ajar=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
					$data_thn_ajar=mysql_fetch_array($qry_thn_ajar);
					$qry_kelas=mysql_query("select * from ruang_kelas where kd_konsentrasi='$prodi' and angkatan='$angkatan' and id_ta='$data_thn_ajar[0]'");
					while($data_kelas=mysql_fetch_array($qry_kelas)){
				?>
					<option value="index.php?target=look.kelas.kuliah&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>&kelas=<?php echo $data_kelas[0]; ?>" <?php if ($kelas=="$data_kelas[0]"){ echo "selected"; }?>><?php echo $data_kelas[4]; ?></option>
				<?php
					}
				?>
			</select>	
		</td>
	</tr>
</table>
</form>
<br>
<form name='myform' action="index.php?target=look.kelas.kuliah" method="post">
<table width=50% class="tabel">
	<tr>
		<th align=center width=8%><input type='checkbox' name='pilih' onclick='pilihan()' /></th>
		<th align=center width=10%><b>No</b></th>
		<th align=center width=20%><b>Nim</b></th>
		<th align=center><b>Nama Mahasiswa</b></th>
	</tr>
	<?php
		if (isset($_GET['angkatan']) and isset($_GET['prodi']) and isset($_GET['kelas'])){
		$no=1;
		$warnaGenap = "warnagenap"; 
		$warnaGanjil = "warnaganjil";
		$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
		if ($no % 2 == 0) $warna = $warnaGenap;
		else $warna = $warnaGanjil;
		
		$qry_kl=mysql_query("select * from kelas_kuliah where nim='$data_mhs[0]' and id_kelas='$kelas'");
		$jum_kl=mysql_num_rows($qry_kl);
		if ($jum_kl>0){
			$checked="checked";
		} else {	
			$checked="";
		}
		
		$qry_t=mysql_query("select * from kelas_kuliah where nim='$data_mhs[0]' and id_kelas!='$kelas'");
		$jum_t=mysql_num_rows($qry_t);
		$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
		$data_ta=mysql_fetch_array($qry_ta);
		$qry_krs=mysql_query("select * from krs where nim='$data_mhs[0]' and status='acc' and id_ta='$data_ta[0]'");
		$jum_krs=mysql_num_rows($qry_krs);
		if ($jum_t==0 and $jum_krs>0){
	?>
	<tr class="<?php echo $warna; ?>">
		<td align=center><input type="checkbox" name="cek[]" value="<?php echo $data_mhs[0]; ?>" <?php echo $checked; ?>></td>
		<td align=center><?php echo $no; ?></td>
		<td><?php echo $data_mhs[0]; ?></td>
		<td><?php echo $data_mhs[1]; ?></td>
	</tr>
	<?php 
	$no++;
	}
	}
	?>
	<tr>
		<td colspan=4>
		<input type="hidden" name="id_kelas" value="<?php echo $kelas; ?>">
		<input type="hidden" name="angkatan" value="<?php echo $angkatan; ?>">
		<input type="hidden" name="prodi" value="<?php echo $prodi; ?>">
		<input type="hidden" name="id_ta" value="<?php echo $data_ta[0]; ?>">
		<input type="submit" class="round blue ic-right-arrow" value="Simpan" name="submit">
		</td>
	</tr>
	<?php
	}
	?>
</table>
</form>
</center>
<br>
<br>
</div>