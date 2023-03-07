<?php
$nim=$_SESSION['sesiusername'];
$qry_tahun=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_tahun=mysql_fetch_array($qry_tahun);

$qry_bayar=mysql_query("select * from konfirmasi_bayar where nim='$nim' and id_ta='$data_tahun[0]'");
$data_bayar=mysql_fetch_array($qry_bayar);
$jum_bayar=mysql_num_rows($qry_bayar);
if (($data_bayar[4]=="pending") or ($jum_bayar==0)){
include "mhs.krs.konfirmasi.bayar.php";
} else if (($data_bayar[4]=="acc")){
$qry_krs=mysql_query("select * from krs where nim='$nim' and id_ta='$data_tahun[0]'");
$jum_krs=mysql_num_rows($qry_krs);
if ($jum_krs==0){
include "mhs.krs.input.php";
} else if ($jum_krs>0){
if(isset($_POST['submit_batal'])){
	include "mhs.krs.input.php";
	mysql_query("delete from krs where nim='$nim' and id_ta='$data_tahun[0]'");
} else {	
echo "<br>";
echo "<h2>Anda Telah Melakukan Pengisian KRS <br>Tahun Ajaran $data_tahun[1] <br>
 Terima Kasih</h2>";
 echo "<br>";
 $no=1;
 $jum_sks_krs=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim' and id_ta='$data_tahun[0]'");
 ?>
 <h3>Daftar Matakuliah yang Anda Programkan :</h3>
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
<input type="hidden" name="id_ta" value="<?php echo $data_tahun[0]; ?>">
<td width=18%><button type="submit" name="pdf" style="background:none;border:none;"><img src="images/pdf.png" width=150></button></td>
<td width=18%><button type="submit" name="word" style="background:none;border:none;"><img src="images/word.png" width=150></button></td>
<td>
</td>
</form>
</tr>
</table>
 <?php 
	if ($data_bayar[6]=="yes"){
	?>
	<h3>Anda dapat mengisi ulang atau membatalkan krs yang telah diambil sebelum jadwal pengisian krs berakhir, klik tombol dibawah ini!</h3>
	<br style="margin-top:-20px;">
	<form action="" method="post">
	<input type="submit" name="submit_batal" value="Isi Ulang/Batalkan KRS" class="button scrolly">
	</form>
	<?php
	}
	?>
	<br>
	<br>
<?php	
	}
	}
}
?>