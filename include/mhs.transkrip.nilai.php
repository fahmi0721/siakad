<?php
error_reporting(0);
?>
<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
 $nim=$_SESSION['sesiusername'];
 echo "<br>";
 echo "<h2>Halaman Transkrip Nilai</h2>";
 echo "<br>";

 echo "<br>";
 $no=1;
 $jum_sks_krs=0;
 $total_angka=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim'");
 ?>
 <table width=100%>
 <tr style="border-bottom:3px solid #aaa;">
	<th>No</th>
	<th>Kode</th>
	<th>Matakuliah</th>
	<th>SKS</th>
	<th>N. Angka</th>
	<th>N. Huruf</th>
 </tr>
 <?php
 $jum_sks_krs_b=0;
 while($data_program_krs=mysql_fetch_array($qry_program_krs)){
 $qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_program_krs[2]'");
 $data_mk=mysql_fetch_array($qry_mk);
	$qry_nilai=mysql_query("select * from nilai where kd_mk='$data_mk[0]' and nim='$nim'");
	$data_nilai=mysql_fetch_array($qry_nilai);
	$amount = $data_mk[2];
	$jum_sks_krs += $amount;
	$angka = $data_nilai[6];
	$total_angka += $angka;
	echo "<tr style='border-bottom:1px solid #aaa;'>";
		echo "<td align=center>$no</td>";
		echo "<td align=center>$data_mk[0]</td>";
		echo "<td>$data_mk[1]</td>";
		echo "<td align=center>$data_mk[2]</td>";
		echo "<td align=center>";
		if ($data_nilai[5]=="A"){
				$warna="green";
			} else if($data_nilai[5]=="B"){
				$warna="blue";
			} else if($data_nilai[5]=="C"){		
				$warna="yellow";
			} else if($data_nilai[5]=="D"){	
				$warna="orange";
			} else {
				$warna="red";
			}
		if ($data_nilai[4]==""){
			echo "<font style='color:#f00;'>[ None ]</font>";
		} else {
			echo "<font style='color:$warna;'>$data_nilai[4]</font>";
			$jum_sks_krs_b=$jum_sks_krs_b+$data_mk[2];
		}
		echo "</td>";
		echo "<td align=center>";
		if ($data_nilai[5]==""){
			echo "<font style='color:#f00;'>[ None ]</font>";
		} else {	
			echo "<font style='color:$warna;'>$data_nilai[5]</font>";
		}
		echo "</td>";
	echo "</tr>";
 $no++;		
 }
	echo "<tr>";
		echo "<td colspan=5 align=right>Total SKS yang diprogramkan :</td>";
		echo "<td align=center>$jum_sks_krs SKS</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td colspan=5 align=right>Indeks Prestasi Kumulatif (IPK) :</td>";
		echo "<td align=center>";
		$ipk=$total_angka/$jum_sks_krs_b;
		echo "$ipk";
		echo "</td>";
	echo "</tr>";
	echo "</table>";
?>	
<table>
<tr>
<td>Save As to : </td>
</tr>
<form method="post" action="include/mhs.export.transkrip.nilai.php">
<input type="hidden" name="nim" value="<?php echo $nim; ?>">
<td width=18%><button type="submit" name="pdf" style="background:none;border:none;"><img src="images/pdf.png" width=150></button></td>
<td width=18%><button type="submit" name="word" style="background:none;border:none;"><img src="images/word.png" width=150></button></td>
<td>
</td>
</tr>
</table>
<br>
<br>