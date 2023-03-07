<?php
 $nim=$_POST['nim'];
 
 $no=1;
 $jum_sks_krs=0;
 $total_angka=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim'");
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
 <table align=center>
 <tr>
	<td style="width:600px;text-align:center;padding:10px;"><img src="http://localhost/PROJECT/Siakad-Revolusi/images/algazalikop.png" height=70 width=85></td>
 </tr>
 <tr> 
	<td style="width:600px;text-align:center;padding:10px;">
	Sekolah Tinggi Ilmu Administrasi Al-Gazali
	</td>
 </tr>
 </table>
 </div>
 <div style="width:660px;
	margin:0 auto;
	height:auto;
	padding:10px;">
 <br>
 <?php
	$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	$qry_konsentrasi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_mhs[10]'");
	$data_konsentrasi=mysql_fetch_array($qry_konsentrasi);
	$qry_prodi=mysql_query("select * from jurusan where kd_jurusan='$data_konsentrasi[1]'");
	$data_prodi=mysql_fetch_array($qry_prodi);
 ?>
 <h2 align=center>TRANSKRIP NILAI</h2>
 <br>
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
 <br style="margin-top:-25px;">
 <table align=center border=1 style="border-collapse:collapse;">
 <tr>
	<th style="padding:5px;width:30px;text-align:center;">No</th>
	<th style="padding:5px;width:100px;text-align:center;">Kode</th>
	<th style="padding:5px;width:150px;text-align:center;">Matakuliah</th>
	<th style="padding:5px;width:30px;text-align:center;">SKS</th>
	<th style="padding:5px;width:70px;text-align:center;">N. Angka</th>
	<th style="padding:5px;width:70px;text-align:center;">N. Huruf</th>
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
	echo "<tr>";
		echo "<td style='padding:5px;' align=center>$no</td>";
		echo "<td style='padding:5px;' align=center>$data_mk[0]</td>";
		echo "<td style='padding:5px;'>$data_mk[1]</td>";
		echo "<td style='padding:5px;' align=center>$data_mk[2]</td>";
		echo "<td style='padding:5px;' align=center>";
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
		echo "<td style='padding:5px;' align=center>";
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
		echo "<td colspan=5 style='padding:5px;' align=right>Jumlah SKS :</td>";
		echo "<td align=center style='padding:5px;'>$jum_sks_krs SKS</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td colspan=5 align=right style='padding:5px;'>Indeks Prestasi Kumulatif (IPK) :</td>";
		echo "<td align=center style='padding:5px;'>";
		$ipk=$total_angka/$jum_sks_krs_b;
		echo "$ipk";
		echo "</td>";
	echo "</tr>";
	echo "</table>";

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
<br>
<p align=center>Makassar, <?php echo TanggalIndo($date); ?></p>
<br>
<table align=center>
<tr>
<td style="width:200px;text-align:center;">
Ketua
<br>
<br>
<br>
<br>
<br>
<br>
<u>[ Nama Ketua ]</u>
</td>
<td style="border:1px solid #ccc;width:80px;text-align:center;">
<br>
<br>
<br>
Photo
<br>
<br>
<br>
</td>
<td style="width:200px;text-align:center;">
Wakil Ketua Bidang Akademik
<br>
<br>
<br>
<br>
<br>
<br>
<u>[ Nama Wakil Ketua ]</u>
</td>
</tr>
</table>
</div>
<br>
<br>
<div style="border-top: 1px solid #ccc;
	bottom: 0;
	height: 20px;
	padding: 10px;
	position: fixed;
	top: auto;
	width: 662px;
	z-index: 101;text-align:center;">
	<?php
	$tahun=date("Y");
	?>
Sekolah Tinggi Ilmu Administrasi Al-Gazali Tahun <?php echo $tahun; ?>
</div>
</div>