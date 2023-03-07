<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
$nim=$_SESSION['sesiusername'];
if (isset($_GET['id_ta'])){
	$id_ta=$_GET['id_ta'];
} else {	
	$id_ta="";
}
echo "<br>";
echo "<h2>Halaman Histori KRS program mata kuliah yang telah anda ambil</h2>";
 echo "<br>";
?>
<form action="index.php?target=mhs.history.krs" method="post">
<select name="id_ta" onChange="MM_jumpMenu('parent',this,0)">
	<option value="index.php?target=mhs.history.krs">[ -- Pilih Tahun Ajaran -- ]</option>
	<?php
	$qry_krs_thn=mysql_query("select * from krs where nim='$nim' GROUP BY id_ta HAVING count(*) > 0");
	while($data_krs_thn=mysql_fetch_array($qry_krs_thn)){
	$qry_thn_ajaran=mysql_query("select * from thn_ajaran where id_ta='$data_krs_thn[3]'");	
	$data_thn_ajaran=mysql_fetch_array($qry_thn_ajaran);
	?>
	<option value="index.php?target=mhs.history.krs&id_ta=<?php echo $data_thn_ajaran[0]; ?>" <?php if ($id_ta==$data_thn_ajaran[0]) {echo "selected";} ?>>Tahun Ajaran <?php echo $data_thn_ajaran[1]; ?></option>
	<?php
	}
	?>
</select>
</form>
<?php
echo "<br>";
if (!isset($_GET['id_ta'])){
echo "<center>";
echo "<h3>Silahkan Anda memilih tahun ajaran untuk melihat daftar mata kuliah yang telah diprogramkan sebelumnya hingga sekarang, Terima Kasih</h3>";
echo "<br>";
echo "<br>";
echo "</center>";
}

if (isset($_GET['id_ta'])){
 $no=1;
 $jum_sks_krs=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim' and id_ta='$id_ta'");
 ?>
 <h3>Daftar Matakuliah yang Anda Programkan :
 <br>
 Tahun Ajaran : 
<?php
	$qry_th=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
	$data_th=mysql_fetch_array($qry_th);
	echo "$data_th[1]";
?>
 </h3>
 <br style="margin-top:-25px;">
 <table width=100%>
 <tr style="border-bottom:3px solid #aaa;">
	<th>No</th>
	<th>Kode</th>
	<th>Matakuliah</th>
	<th>SKS</th>
 </tr>
 <?php
 while($data_program_krs=mysql_fetch_array($qry_program_krs)){
 $qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_program_krs[2]'");
 $data_mk=mysql_fetch_array($qry_mk);
	$amount = $data_mk[2];
	$jum_sks_krs += $amount;
	echo "<tr style='border-bottom:1px solid #aaa;'>";
		echo "<td align=center>$no</td>";
		echo "<td align=center>$data_mk[0]</td>";
		echo "<td>$data_mk[1]</td>";
		echo "<td align=center>$data_mk[2]</td>";
	echo "</tr>";
 $no++;		
 }
	echo "<tr>";
		echo "<td colspan=3 align=right>Total SKS yang diprogramkan :</td>";
		echo "<td align=center>$jum_sks_krs SKS</td>";
	echo "</tr>";
	echo "</table>";
?>
<table>
<tr>
<td>Save As to : </td>
</tr>
<form method="post" action="include/mhs.export.krs.php">
<input type="hidden" name="nim" value="<?php echo $nim; ?>">
<input type="hidden" name="id_ta" value="<?php echo $id_ta; ?>">
<td width=18%><button type="submit" name="pdf" style="background:none;border:none;"><img src="images/pdf.png" width=150></button></td>
<td width=18%><button type="submit" name="word" style="background:none;border:none;"><img src="images/word.png" width=150></button></td>
<td>
</td>
</tr>
</table>
<?php	
}	
?>	