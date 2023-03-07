<?php
$nim=$_POST['nim'];
$id_ta=$_POST['id_ta'];

$qry_ta=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
$data_ta=mysql_fetch_array($qry_ta);

$qry_kelas_kuliah=mysql_query("select * from kelas_kuliah where nim='$nim' and id_ta='$id_ta'");
$data_kelas_kuliah=mysql_fetch_array($qry_kelas_kuliah);

$qry_kelas=mysql_query("select * from ruang_kelas where id_kelas='$data_kelas_kuliah[1]' and id_ta='$id_ta'");
$data_kelas=mysql_fetch_array($qry_kelas);

$no=1;
$qry_jadwal=mysql_query("select * from jadwal_kuliah where id_kelas='$data_kelas_kuliah[1]' and id_ta='$id_ta'");
$jum_jadwal=mysql_num_rows($qry_jadwal);
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
	<td style="width:100px;text-align:center;padding:10px;"><img src="http://localhost/PROJECT/Siakad-Revolusi/images/algazalikop.png" height=70 width=85></td>
	<td style="width:475px;text-align:right;padding:10px;">Kampus : Jl. Jl. Jend. Sudirman No.41 Kab. Barru<br>
		Telp / Fax : (0427) 21871<br>
		Website : http://www.algazali.ac.id<br>
		Email : info@algazali.ac.id
	</td>
 </tr>
 </table>
 </div>
 <div style="width:660px;
	margin:0 auto;
	height:auto;
	padding:10px;">
 <h2 align=center>Jadwal Kuliah</h2>
 <br>
	<?php
	$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	$qry_konsentrasi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_mhs[10]'");
	$data_konsentrasi=mysql_fetch_array($qry_konsentrasi);
	$qry_prodi=mysql_query("select * from jurusan where kd_jurusan='$data_konsentrasi[1]'");
	$data_prodi=mysql_fetch_array($qry_prodi);
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
			<td style="padding:5px;"><?php echo $data_ta[1]; ?></td>
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
		<tr>
			<td style="padding:5px;">Kelas</td>
			<td style="padding:5px;">:</td>
			<td style="padding:5px;"><?php echo $data_kelas[4]; ?></td>
		 </tr>	
	 </table>
 </td>
 </tr>
 </table>	
 <br>
 <table align=center border=1 style="border-collapse:collapse;">
 <tr>
	<th style="padding:5px;width:50px;text-align:center;">No</th>
	<th style="padding:5px;width:150px;text-align:center;">Matakuliah</th>
	<th style="padding:5px;width:200px;text-align:center;">Dosen</th>
	<th style="padding:5px;width:150px;text-align:center;">Jadwal</th>
 </tr>
 <?php
 while($data_jadwal=mysql_fetch_array($qry_jadwal)){
	$qry_krs=mysql_query("select * from krs where id_kelas='$data_jadwal[2]' and kd_mk='$data_jadwal[3]' and nim='$nim'");
	$data_krs=mysql_fetch_array($qry_krs);
	$jum_krs=mysql_num_rows($qry_krs);
	
	$qry_dosen=mysql_query("select * from dosen where id_dosen='$data_jadwal[4]'");
	$data_dosen=mysql_fetch_array($qry_dosen);
	
	$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$data_krs[2]'");
	$data_mk=mysql_fetch_array($qry_mk);
	
	$qry_ruangan=mysql_query("select * from ruangan where id_ruangan='$data_jadwal[5]'");
	$data_ruangan=mysql_fetch_array($qry_ruangan);
	
	$qry_ruangan2=mysql_query("select * from ruangan where id_ruangan='$data_jadwal[8]'");
	$data_ruangan2=mysql_fetch_array($qry_ruangan2);
	
	if ($jum_krs>0){
	echo "<tr style='border-bottom:1px solid #aaa;'>";
		echo "<td style='padding:5px;' align=center>$no</td>";
		echo "<td style='padding:5px;'>$data_mk[1]</td>";
		echo "<td style='padding:5px;'>$data_dosen[2]</td>";
		if ($data_jadwal[8]=="" and $data_jadwal[9]=="" and $data_jadwal[10]==""){
			echo "<td align=left style='padding:5px;'>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7]."</td>";
		} else {
			echo "<td align=left style='padding:5px;'>".$data_ruangan[1].", " .$data_jadwal[6].", " .$data_jadwal[7] . " <br> " .$data_ruangan2[1].", " .$data_jadwal[9].", " .$data_jadwal[10] ."</td>";
		}
	echo "</tr>";
 $no++;		
 }
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
Sekolah Tinggi Ilmu Administrasi Al-Gazali Tahun <?php echo $tahun; ?>
</div>
</div>