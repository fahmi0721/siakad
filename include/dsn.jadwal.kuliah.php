<?php
$id_dosen=$_SESSION['sesiusername'];
$qry_tahun=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_tahun=mysql_fetch_array($qry_tahun);

$no=1;
$qry_jadwal=mysql_query("select * from jadwal_kuliah where id_dosen='$id_dosen' and id_ta='$data_tahun[0]'");
$jum_jadwal=mysql_num_rows($qry_jadwal);
if ($jum_jadwal==0){
	echo "<br><br><br><br><br><center><h3>Maaf Jadwal Mengajar Anda Belum Ada<br>
	Silahnkan Anda Cek Jadwal Mengajar Anda Secara Berkala<br>
	Terima Kasih
	</h3></center>";
} else {	
?>
<br>
 <h2>Jadwal Mengajar <br>Tahun Ajaran <?php echo $data_tahun[1]; ?> :</h2>
 <br>
 <table width=100%>
 <tr style="border-bottom:3px solid #aaa;">
	<th>No</th>
	<th>Matakuliah</th>
	<th>Kelas</th>
	<th>Jadwal</th>
 </tr>
 <?php
 while($data_jadwal=mysql_fetch_array($qry_jadwal)){

	$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_jadwal[3]'");
	$data_mk=mysql_fetch_array($qry_mk);
	
	$qry_kelas=mysql_query("select * from ruang_kelas where id_kelas='$data_jadwal[2]'");
	$data_kelas=mysql_fetch_array($qry_kelas);
	
	$qry_ruangan=mysql_query("select * from ruangan where id_ruangan='$data_jadwal[5]'");
	$data_ruangan=mysql_fetch_array($qry_ruangan);
	
	$qry_ruangan2=mysql_query("select * from ruangan where id_ruangan='$data_jadwal[8]'");
	$data_ruangan2=mysql_fetch_array($qry_ruangan2);
	
	echo "<tr style='border-bottom:1px solid #aaa;'>";
		echo "<td align=center>$no</td>";
		echo "<td>$data_mk[1]</td>";
		echo "<td align=center>$data_kelas[4]</td>";
		if ($data_jadwal[8]=="" and $data_jadwal[9]=="" and $data_jadwal[10]==""){
			echo "<td align=center>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7]."</td>";
		} else {
			echo "<td align=center>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7] . " <br> " .$data_ruangan2[1].", " .$data_jadwal[9].", " .$data_jadwal[10] ."</td>";
		}
	echo "</tr>";
 $no++;		
 }
	echo "</table>";
	?>
<table>
<tr>
<td>Save As to : </td>
</tr>
<form method="post" action="include/dsn.export.jadwal.php">
<input type="hidden" name="id_dosen" value="<?php echo $id_dosen; ?>">
<input type="hidden" name="id_ta" value="<?php echo $data_tahun[0]; ?>">
<td width=18%><button type="submit" name="pdf" style="background:none;border:none;"><img src="images/pdf.png" width=150></button></td>
<td width=18%><button type="submit" name="word" style="background:none;border:none;"><img src="images/word.png" width=150></button></td>
<td>
</td>
</tr>
</table>	
<?php	
}	
?>	
	<br>
	<br>
	<br>
	<br>