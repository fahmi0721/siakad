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
	
	$id_dosen=$_POST['id_dosen'];
	$angkatan=$_POST['angkatan'];
	$prodi=$_POST['prodi'];
	
	if (isset($_POST['cek'])){
	$cek=$_POST['cek'];
	$jum = count($cek);
	
	$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
	
	$qry_pa=mysql_query("select * from pembimbing where nim='$data_mhs[0]' and id_dosen='$id_dosen'");
	$jum_pa=mysql_num_rows($qry_pa);
		if ($jum_pa>0){
			mysql_query("delete from pembimbing where nim='$data_mhs[0]'");
		}	
	}	
		for ($i = 0; $i < $jum; ++$i) {
			$qry=mysql_query("insert into pembimbing values('','$id_dosen','$cek[$i]')");
		}

		echo "<script>alert ('Data Bimbingan Telah Disimpan')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.pa&angkatan=$angkatan&prodi=$prodi&dosen=$id_dosen' />";

	} else {
		echo "<script>alert ('Data Belum Dipilih')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.pa&angkatan=$angkatan&prodi=$prodi&dosen=$id_dosen' />";
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

if (!isset($_GET['dosen'])){
	$dosen = "";
} else {
	$dosen = $_GET['dosen'];
}
?>
<div class="content-module-heading cf">
	<h3 class="fl">Look Data Penasehat Akademik</h3>
</div> <!-- end content-module-heading -->
<div class="content-module-main">
<center>
<form>
<table width=50% class=tab>
	<tr>
		<td><b>Angkatan</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.pa">[ -- Pilih Angkatan -- ]</option>
				<?php
					$qry_angkatan=mysql_query("select thn_msk from mahasiswa GROUP BY thn_msk HAVING count(*) > 0 order by(thn_msk) asc");
					while($data_angkatan=mysql_fetch_array($qry_angkatan)){
				?>
				<option value="index.php?target=look.pa&angkatan=<?php echo $data_angkatan[0]; ?>&prodi=<?php echo $prodi; ?>" <?php if ($angkatan=="$data_angkatan[0]"){ echo "selected"; }?>><?php echo $data_angkatan[0]; ?></option>	
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
				<option value="index.php?target=look.pa&angkatan=<?php echo $angkatan; ?>">[ -- Pilih Program Studi -- ]</option>
				<?php
					$qry_prodi=mysql_query("select * from konsentrasi");
					while($data_prodi=mysql_fetch_array($qry_prodi)){
				?>
					<option value="index.php?target=look.pa&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $data_prodi[0]; ?>" <?php if ($prodi=="$data_prodi[0]"){ echo "selected"; } ?>><?php echo $data_prodi[2]; ?></option>
				<?php		
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>Dosen</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_besar">
				<option value="index.php?target=look.pa&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>">[ -- Pilih Dosen -- ]</option>
				<?php
					$qry_dosen=mysql_query("select * from dosen");
					while($data_dosen=mysql_fetch_array($qry_dosen)){
				?>
					<option value="index.php?target=look.pa&angkatan=<?php echo $angkatan; ?>&prodi=<?php echo $prodi; ?>&dosen=<?php echo $data_dosen[0]; ?>" <?php if ($dosen=="$data_dosen[0]"){ echo "selected"; }?>><?php echo $data_dosen[2]; ?></option>
				<?php
					}
				?>
			</select>	
		</td>
	</tr>
</table>
</form>
<br>
<form name='myform' action="index.php?target=look.pa" method="post">
<table width=50% class="tabel">
	<tr>
		<th align=center width=8%><input type='checkbox' name='pilih' onclick='pilihan()' /></th>
		<th align=center width=10%><b>No</b></th>
		<th align=center width=20%><b>Nim</b></th>
		<th align=center><b>Nama Mahasiswa</b></th>
	</tr>
	<?php
		if (isset($_GET['angkatan']) and isset($_GET['prodi']) and isset($_GET['dosen'])){
		$no=1;
		$warnaGenap = "warnagenap"; 
		$warnaGanjil = "warnaganjil";
		$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
		if ($no % 2 == 0) $warna = $warnaGenap;
		else $warna = $warnaGanjil;
		
		$qry_pa=mysql_query("select * from pembimbing where nim='$data_mhs[0]' and id_dosen='$dosen'");
		$jum_pa=mysql_num_rows($qry_pa);
		if ($jum_pa>0){
			$checked="checked";
		} else {	
			$checked="";
		}
		
		$qry_t=mysql_query("select * from pembimbing where nim='$data_mhs[0]' and id_dosen!='$dosen'");
		$jum_t=mysql_num_rows($qry_t);
		if ($jum_t==0){
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
		<input type="hidden" name="id_dosen" value="<?php echo $dosen; ?>">
		<input type="hidden" name="angkatan" value="<?php echo $angkatan; ?>">
		<input type="hidden" name="prodi" value="<?php echo $prodi; ?>">
		<input type="submit" class="round blue ic-right-arrow" value="Simpan" name="submit">
		</td>
	</tr>
	<?php
	}
	?>
</table>
</center>
<br>
<br>
</div>