<page backtop="10mm" backbottom="5mm" backleft="10mm" backright="10mm">
<?php
 include "../connect.php";
 $no=1;
 $nim=$_POST['nim'];
 $id_ta=$_POST['id_ta'];
 $jum_sks_krs=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim' and id_ta='$id_ta'");
 $jum_mk_krs=mysql_num_rows($qry_program_krs);
 $qry_pa=mysql_query("select * from pembimbing where nim='$nim'");
 $data_pa=mysql_fetch_array($qry_pa);
 $qry_dosen=mysql_query("select * from dosen where id_dosen='$data_pa[1]'");
 $data_dosen=mysql_fetch_array($qry_dosen);
 ?>
 <div style="margin:auto;
     width:682px;">
 <div style="bottom: auto;     
	position: fixed;     
	top: 0;     
	z-index: 100;     
	height:80px;     
	width:662px;     
	padding:10px; 
	border-bottom:1px solid #ccc;">
 <table>
 <tr>
	<td style="width:100px;text-align:center;padding:10px;"><img src="../images/akba.png" width=85></td>
	<td style="width:475px;text-align:right;padding:10px;">Kampus : Jl. Perintis Kemerdekaan Km. 9 No. 75<br>
		Telp / Fax : (0411) 588371<br>
		Website : http://www.akba.ac.id<br>
		Email : support@akba.ac.id
	</td>
 </tr>
 </table>
 </div>
 <div style="width:660px;
	margin:0 auto;
	height:auto;
	padding:10px;">
 <h2 align=center>KARTU RENCANA STUDI</h2>
 <br>
 <?php
	$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	$qry_konsentrasi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_mhs[10]'");
	$data_konsentrasi=mysql_fetch_array($qry_konsentrasi);
	$qry_prodi=mysql_query("select * from jurusan where kd_jurusan='$data_konsentrasi[1]'");
	$data_prodi=mysql_fetch_array($qry_prodi);
	$qry_th=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
	$data_th=mysql_fetch_array($qry_th);
 ?>
 <table>
 <tr>
 <td style="width:345px;">
	 <table>
		 <tr>
			<td style="padding:5px;">Nim</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_mhs['nim']; ?></td>
		 </tr>
		<tr>
			<td style="padding:5px;">Nama</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_mhs['nama']; ?></td>
		 </tr> 
		 <tr>
			<td style="padding:5px;">Tahun Ajaran</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_th[1]; ?></td>
		 </tr>
	 </table>
 </td>
 <td style="width:300px;">
	<table>
		 <tr>
			<td style="padding:5px;">Program Studi</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_prodi[1]; ?></td>
		 </tr>
		<tr>
			<td style="padding:5px;">Konsentrasi</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_konsentrasi[2]; ?></td>
		 </tr> 
	 </table>
 </td>
 </tr>
 </table>
 <br style="margin-top:-25px;">
 <table border=1 style="border-collapse:collapse;width:645px;" align=center>
 <tr>
	<th style="padding:5px;text-align:center;width:50px;">No</th>
	<th style="padding:5px;text-align:center;width:100px;">Kode MK</th>
	<th style="padding:5px;text-align:center;width:320px;">Nama Mata Kuliah</th>
	<th style="padding:5px;text-align:center;width:50px;">SKS</th>
 </tr>
 <?php
 while($data_program_krs=mysql_fetch_array($qry_program_krs)){
 $qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_program_krs[2]'");
 $data_mk=mysql_fetch_array($qry_mk);
	$amount = $data_mk[2];
	$jum_sks_krs += $amount;
	echo "<tr>";
		echo "<td style='padding:5px;' align=center>$no</td>";
		echo "<td style='padding:5px;' align=center>$data_mk[0]</td>";
		echo "<td style='padding:5px;'>$data_mk[1]</td>";
		echo "<td style='padding:5px;' align=center>$data_mk[2]</td>";
	echo "</tr>";
 $no++;		
 }
	echo "<tr>";
		echo "<td colspan=3 align=right style='padding:5px;'>Jumlah Mata Kuliah :</td>";
		echo "<td align=center style='padding:5px;'>$jum_mk_krs</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td colspan=3 align=right style='padding:5px;'>Jumlah SKS yang diprogramkan :</td>";
		echo "<td align=center style='padding:5px;'>$jum_sks_krs SKS</td>";
	echo "</tr>";
	echo "</table>";
?>
<br>
<?php
$date=date("Y-m-d");
function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);

	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}
?>
<p align=right>Makassar, <?php echo TanggalIndo($date); ?></p>
<br>
<h3 align=center>TANDA TANGAN</h3>
<br>
<table align=center>
<tr>
	<td style="width:110px;padding:10px;border:solid 1px #ccc;text-align:center;font-size:8px;">
	BAAK,
	<br>
	<br>
	<br>
	<br>
	<br>
	<hr style="border:1px solid #ccc;">
	</td>
	<td style="width:110px;padding:10px;border:solid 1px #ccc;text-align:center;font-size:8px;">
	KETUA JURUSAN,
	<br>
	<br>
	<br>
	<br>
	<br>
	<hr style="border:1px solid #ccc;">
	</td>
	<td style="width:110px;padding:10px;border:solid 1px #ccc;text-align:center;font-size:8px;">
	PENASEHAT AKADEMIK,
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php echo $data_dosen['nama']; ?>
	</td>
	<td style="width:110px;padding:10px;border:solid 1px #ccc;text-align:center;font-size:8px;">
	MAHASISWA YBS,
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php echo $data_mhs['nama']; ?>
	</td>
</tr>
</table>
<br>
</div>
<div style="border-top: 1px solid #ccc;
	bottom: 0;
	height: 20px;
	padding: 10px;
	position: fixed;
	top: auto;
	width: 662px;
	z-index: 101;">
<table style="width:500px;border-collapse:collapse;">
<tr>
	<td style="width:500px;">Catatan : </td>
</tr>
<tr>
	<td>Formulir dibuat 4 rangkap sesuai warna jurusan masing-masing</td>
</tr>
<tr>
	<td>Lembar 1 Untuk Mahasiswa, <br>Lembar 2 Untuk Penasehat Akademik, <br>Lembar 3 Untuk Ketua Jurusan, <br>Lembar 4 Untuk BAAK</td>
</tr>
</table>
</div>
</div>
</page>