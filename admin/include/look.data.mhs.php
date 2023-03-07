<?php
error_reporting(0);
?>
<style>
.tabel td,th{
padding:10px;
}
</style>
<?php
	$user=$_GET['nim'];	
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	$data_user=mysql_fetch_array($qry);
	
	if ($data_user[0]==""){
		$nim="[ Belum Ada Data ]";
	} else {
		$nim="$data_user[0]";
	}
	
	if ($data_user[1]==""){
		$nama="[ Belum Ada Data ]";
	} else {
		$nama="$data_user[1]";
	}
	
	if ($data_user[6]==""){
		$jenkel="[ Belum Ada Data ]";
	} else {	
		$jenkel="$data_user[6]";
	}
	
	if ($data_user[4]==""){
		$tmp_lahir="[ Belum Ada Data ]";
	} else 	{
		$tmp_lahir="$data_user[4]";
	}

	if ($data_user[3]=="0000-00-00"){
		$tgl_lahir="[ Belum Ada Data ]";
	} else {	
		$tgl_lahir="$data_user[3]";
	}

	if ($data_user[5]==""){
		$agama="[ Belum Ada Data ]";	
	} else {	
		$agama="$data_user[5]";
	}

	if ($data_user[2]==""){
		$alamat="[ Belum Ada Data ]";
	} else {	
		$alamat="$data_user[2]";
	}

	if ($data_user[7]==""){
		$no_telpon="[ Belum Ada Data ]";
	} else {	
		$no_telpon="$data_user[7]";
	}

	if ($data_user[8]==""){
		$email="[ Belum Ada Data ]";
	} else {	
		$email="$data_user[8]";
	}

	if ($data_user[12]==""){
		$asal_sekolah="[ Belum Ada Data ]";
	} else {	
		$asal_sekolah="$data_user[12]";
	}	
	
	if ($data_user[9]==""){
		$tahun_masuk="[ Belum Ada Data ]";
	} else {	
		$tahun_masuk="$data_user[9]";
	}

	if ($data_user[10]==""){
		$prodi="[ Belum Ada Data ]";
	} else {	
		$prodi="$data_user[10]";
	}

	if ($data_user[11]==""){
		$status="[ Belum Ada Data ]";
	} else {	
		$status="$data_user[11]";
	}

	if ($data_user[13]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_user[13]";
	}
?>
<br>
<center>
<div style="width:70%;align:center">
<div style="float:left;width:15%;margin-left:50px;">
	<img src="foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;">	
</div>	
<div style="float:right;width:70%">
<table width=100%>
	<tr>
		<td style="width:15%;">Nim</td>
		<td style="width:2%;">:</td>
		<td style="width:50%;"><?php echo $nim; ?></td>
	</tr>
	<tr>
		<td>Nama Lengkap</td>
		<td>:</td>
		<td><?php echo $nama; ?></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php echo $jenkel; ?></td>
	</tr>
	<tr>
		<td>Tempat/Tanggal Lahir</td>
		<td>:</td>
		<?php
		if ($data_user[3]!="0000-00-00"){
		$date = new DateTime($tgl_lahir);
		}
		?>
		<td><?php echo $tmp_lahir;?> / <?php if($data_user[3]=="0000-00-00"){ echo $tgl_lahir; } else { echo $date->format('d-m-Y');} ?></td>
	</tr>
	<tr>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $agama; ?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $alamat; ?></td>
	</tr>
	<tr>
		<td>Nomor Telpon</td>
		<td>:</td>
		<td><?php echo $no_telpon; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<td>Asal Sekolah</td>
		<td>:</td>
		<td><?php echo $asal_sekolah; ?></td>
	</tr>
	<tr>
		<td>Tahun Masuk</td>
		<td>:</td>
		<td><?php echo $tahun_masuk; ?></td>
	</tr>
	<tr>
		<td>Program Studi</td>
		<td>:</td>
		<?php
			$qry_prodi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_user[10]'");
			$data_prodi=mysql_fetch_array($qry_prodi);
		?>
		<td><?php echo $data_prodi[2]; ?></td>
	</tr>
	<tr>
		<td>Status Akademik</td>
		<td>:</td>
		<?php
			if ($status=="Aktif") {
				$warna="#00f044";
			} else if($status=="Cuti"){
				$warna="#f00";
			} else {
				$warna="#888888";
			}
		?>
		<td><font color="<?php echo $warna; ?>"><?php echo $status; ?></font></td>
	</tr>
</table>
</div>
<div style="clear:both;">
</div>
<br>
<?php
 echo "<h2>Transkrip Nilai :</h2>";
 echo "<br>";
 $no=1;
 $jum_sks_krs=0;
 $total_angka=0;
 $qry_program_krs=mysql_query("select * from krs where nim='$nim'");
 ?>
 <table width=70% border=1 class="tabel" style="border-collapse:collapse;">
 <tr>
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
</div>
<br>
<br>
<br>
</center>