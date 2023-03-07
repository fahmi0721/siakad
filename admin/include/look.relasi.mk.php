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
	$id_rel=$_POST['id_rel'];
	$prodi=$_POST['prodi'];
	
	if (isset($_POST['cek'])){
	$cek=$_POST['cek'];
	$jum = count($cek);
	
			mysql_query("delete from rel_kon_ma where kd_konsentrasi='$prodi'");
	
		for ($i = 0; $i < $jum; ++$i) {
			$qry=mysql_query("insert into rel_kon_ma values('','$cek[$i]','$prodi')");
		}

		echo "<script>alert ('Data Relasi Matakuliah Telah Disimpan')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.relasi.mk&prodi=$prodi' />";

	} else {
		echo "<script>alert ('Data Belum Dipilih')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.relasi.mk&prodi=$prodi' />";
	}

}

if (!isset($_GET['prodi'])){
	$prodi = "";
} else {
	$prodi = $_GET['prodi'];
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
		<td><b>Program Studi</b></td>
		<td><b>:</b></td>
		<td>
			<select onChange="MM_jumpMenu('parent',this,0)" class="round text_medium">
				<option value="index.php?target=look.relasi.mk">[ -- Pilih Program Studi -- ]</option>
				<?php
					$qry_prodi=mysql_query("select * from konsentrasi");
					while($data_prodi=mysql_fetch_array($qry_prodi)){
				?>
					<option value="index.php?target=look.relasi.mk&prodi=<?php echo $data_prodi[0]; ?>" <?php if ($prodi=="$data_prodi[0]"){ echo "selected"; } ?>><?php echo $data_prodi[2]; ?></option>
				<?php		
					}
				?>
			</select>
		</td>
	</tr>
</table>
</form>
<br>
<form name='myform' action="index.php?target=look.relasi.mk" method="post">
<table width=50% class="tabel">
	<tr>
		<th align=center width=8%><input type='checkbox' name='pilih' onclick='pilihan()' /></th>
		<th align=center width=10%><b>No</b></th>
		<th align=center width=20%><b>Kode</b></th>
		<th align=center><b>Mata Kuliah</b></th>
		<th align=center><b>SKS</b></th>
	</tr>
	<?php
		if (isset($_GET['prodi'])){
		$no=1;
		$warnaGenap = "warnagenap"; 
		$warnaGanjil = "warnaganjil";
		$qry_mk=mysql_query("select * from mata_kuliah");
	while($data_mk=mysql_fetch_array($qry_mk)){
		if ($no % 2 == 0) $warna = $warnaGenap;
		else $warna = $warnaGanjil;
		
		$qry_rel=mysql_query("select * from rel_kon_ma where kd_konsentrasi='$prodi' and kd_mk='$data_mk[0]'");
		$data_rel=mysql_fetch_array($qry_rel);
		$jum_rel=mysql_num_rows($qry_rel);
		
		$qry_kos=mysql_query("select * from rel_kon_ma where kd_mk='$data_mk[0]'");
		$data_kos=mysql_fetch_array($qry_kos);
		$jum_kos=mysql_num_rows($qry_kos);
		
		if ($jum_rel>0){
			$checked="checked";
		} else {	
			$checked="";
		}
		
		//$qry_t=mysql_query("select * from mata_kuliah where kd_mk='$data_mhs[0]' and id_kelas!='$kelas'");
		//$jum_t=mysql_num_rows($qry_t);
		if($jum_rel>0 or $jum_kos==0){
		?>
	<tr class="<?php echo $warna; ?>">
		<td align=center><input type="checkbox" name="cek[]" value="<?php echo $data_mk[0]; ?>" <?php echo $checked; ?>></td>
		<td align=center><?php echo $no; ?></td>
		<td><?php echo $data_mk[0]; ?></td>
		<td><?php echo $data_mk[1]; ?></td>
		<td><?php echo $data_mk[2]; ?></td>
	</tr>
	<?php 
	$no++;
	}
	}
	}
	?>
	<tr>
		<td colspan=5>
		<input type="hidden" name="id_rel" value="<?php echo $data_rel[0]; ?>">
		<input type="hidden" name="prodi" value="<?php echo $prodi; ?>">
		<input type="submit" class="round blue ic-right-arrow" value="Simpan" name="submit">
		</td>
	</tr>
</table>
</form>
</center>
<br>
<br>
</div>