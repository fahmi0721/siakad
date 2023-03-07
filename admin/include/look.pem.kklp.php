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
	$id_ta=$_POST['id_ta'];
	
	if (isset($_POST['cek'])){
	$cek=$_POST['cek'];
	$jum = count($cek);
	
	//$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
	$qry_mhs = mysql_query("SELECT 
		 mahasiswa.nim,
		 mahasiswa.nama,
		 konsentrasi.nm_konsentrasi
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='BB510282' or
		 krs.kd_mk='BB410282' or
		 krs.kd_mk='BB110262' or
		 krs.kd_mk='BB310262' or
		 krs.kd_mk='BB210262') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$id_ta' and
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi order by(konsentrasi.kd_konsentrasi) asc
		 ");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
	
	$qry_pa=mysql_query("select * from pembimbing_kklp where nim='$data_mhs[0]' and id_dosen='$id_dosen'");
	$jum_pa=mysql_num_rows($qry_pa);
		if ($jum_pa>0){
			mysql_query("delete from pembimbing_kklp where nim='$data_mhs[0]'");
		}	
	}	
		for ($i = 0; $i < $jum; ++$i) {
			$qry=mysql_query("insert into pembimbing_kklp values('','$cek[$i]','$id_dosen','$id_ta')");
		}

		echo "<script>alert ('Data Bimbingan Telah Disimpan')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.pem.kklp&dosen=$id_dosen' />";

	} else {
		echo "<script>alert ('Data Belum Dipilih')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.pem.kklp&dosen=$id_dosen' />";
	}

}


if (!isset($_GET['dosen'])){
	$dosen = "";
} else {
	$dosen = $_GET['dosen'];
}
?>
<div class="content-module-heading cf">
	<h3 class="fl">Look Data Pembimbing KKLP</h3>
</div> <!-- end content-module-heading -->
<div class="content-module-main">
<center>
<form>
<table width=50% class=tab>
	<tr>
		<td><b>Dosen</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_besar">
				<option value="index.php?target=look.pem.kklp">[ -- Pilih Dosen -- ]</option>
				<?php
					$qry_dosen=mysql_query("select * from dosen");
					while($data_dosen=mysql_fetch_array($qry_dosen)){
				?>
					<option value="index.php?target=look.pem.kklp&dosen=<?php echo $data_dosen[0]; ?>" <?php if ($dosen=="$data_dosen[0]"){ echo "selected"; }?>><?php echo $data_dosen[2]; ?></option>
				<?php
					}
				?>
			</select>	
		</td>
	</tr>
</table>
</form>
<br>
<form name='myform' action="index.php?target=look.pem.kklp" method="post">
<table width=50% class="tabel">
	<tr>
		<th align=center width=8%><input type='checkbox' name='pilih' onclick='pilihan()' /></th>
		<th align=center width=10%><b>No</b></th>
		<th align=center width=20%><b>Nim</b></th>
		<th align=center><b>Nama Mahasiswa</b></th>
		<th align=center><b>Prodi</b></th>
	</tr>
	<?php
		if (isset($_GET['dosen'])){
		$no=1;
		$warnaGenap = "warnagenap"; 
		$warnaGanjil = "warnaganjil";
		//$qry_mhs=mysql_query("select * from mahasiswa where thn_msk='$angkatan' and kd_konsentrasi='$prodi'");
		$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
		$data_thn=mysql_fetch_array($qry_thn);
		$ta=$data_thn[0];
		$qry_mhs = mysql_query("SELECT 
		 mahasiswa.nim,
		 mahasiswa.nama,
		 konsentrasi.nm_konsentrasi
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='BB510282' or
		 krs.kd_mk='BB410282' or
		 krs.kd_mk='BB110262' or
		 krs.kd_mk='BB310262' or
		 krs.kd_mk='BB210262') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$ta' and
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi order by(konsentrasi.kd_konsentrasi) asc
		 ");
	while($data_mhs=mysql_fetch_array($qry_mhs)){
		if ($no % 2 == 0) $warna = $warnaGenap;
		else $warna = $warnaGanjil;
		
		$qry_pa=mysql_query("select * from pembimbing_kklp where nim='$data_mhs[0]' and id_dosen='$dosen'");
		$jum_pa=mysql_num_rows($qry_pa);
		if ($jum_pa>0){
			$checked="checked";
		} else {	
			$checked="";
		}
		
		$qry_t=mysql_query("select * from pembimbing_kklp where nim='$data_mhs[0]' and id_dosen!='$dosen'");
		$jum_t=mysql_num_rows($qry_t);
		$jum_kklp=mysql_num_rows(mysql_query("select * from kklp where nim='$data_mhs[0]'"));
		if ($jum_t==0 and $jum_kklp>0){
	?>
	<tr class="<?php echo $warna; ?>">
		<td align=center><input type="checkbox" name="cek[]" value="<?php echo $data_mhs[0]; ?>" <?php echo $checked; ?>></td>
		<td align=center><?php echo $no; ?></td>
		<td><?php echo $data_mhs[0]; ?></td>
		<td><?php echo $data_mhs[1]; ?></td>
		<td align=center><?php echo $data_mhs[2]; ?></td>
	</tr>
	<?php 
	$no++;
	}
	}
	?>
	<tr>
		<td colspan=5>
		<input type="hidden" name="id_dosen" value="<?php echo $dosen; ?>">
		<input type="hidden" name="id_ta" value="<?php echo $ta; ?>">
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