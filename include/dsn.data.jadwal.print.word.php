<?php
$id_dosen=$_POST['id_dosen'];
$id_ta=$_POST['id_ta'];

$qry_ta=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
$data_ta=mysql_fetch_array($qry_ta);

$no=1;
$qry_jadwal=mysql_query("select * from jadwal_kuliah where id_dosen='$id_dosen' and id_ta='$id_ta'");	
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
	<td style="width:100px;text-align:center;padding:10px;"><img src="http://localhost/PROJECT/Siakad-Revolusi/images/akba.png" height=70 width=85></td>
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
 <h2 align=center>Jadwal Mengajar</h2>
 <br>
	<?php
	$qry_mhs=mysql_query("select * from dosen where id_dosen='$id_dosen'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	?>
 	 <table>
		 <tr>
			<td style="padding:5px;">Id Dosen</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_mhs['id_dosen']; ?></td>
		 </tr>
		<tr>
			<td style="padding:5px;">Nama</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_mhs['nama']; ?></td>
		 </tr> 
		 <tr>
			<td style="padding:5px;">Tahun Ajaran</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_ta[1]; ?></td>
		 </tr>
	 </table>	
 <br>
 <table border=1 align=center style="border-collapse:collapse;">
 <tr>
	<th style="padding:5px;width:30px;text-align:center;">No</th>
	<th style="padding:5px;width:250px;text-align:center;">Matakuliah</th>
	<th style="padding:5px;width:50px;text-align:center;">Kelas</th>
	<th style="padding:5px;width:200px;text-align:center;">Jadwal</th>
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
	
	echo "<tr>";
		echo "<td style='padding:5px;' align=center>$no</td>";
		echo "<td style='padding:5px;'>$data_mk[1]</td>";
		echo "<td style='padding:5px;' align=center>$data_kelas[4]</td>";
		if ($data_jadwal[8]=="" and $data_jadwal[9]=="" and $data_jadwal[10]==""){
			echo "<td style='padding:5px;' align=left>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7]."</td>";
		} else {
			echo "<td style='padding:5px;' align=left>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7] . " <br> " .$data_ruangan2[1].", " .$data_jadwal[9].", " .$data_jadwal[10] ."</td>";
		}
	echo "</tr>";
 $no++;		
 }
	echo "</table>";
	?>
</div>	
<br>
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
Sekolah Tinggi Manajemen Informatika dan Komputer Akba Makassar Tahun <?php echo $tahun; ?>
</div>
</div>