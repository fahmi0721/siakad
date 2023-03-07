<br>
<header>
	<h2 class="alt">Data Bimbingan Skripsi</h2>
	<hr>	
</header>
<div style="width:100%;margin-top:-10px;">
<table>
	<?php
		$nim=$_GET['nim'];
		$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
		$data_mhs=mysql_fetch_array($qry_mhs);
		$qry_skripsi=mysql_query("select * from skripsi where nim='$nim'");
		$data_skripsi=mysql_fetch_array($qry_skripsi);
	?>
	<tr>
		<td width=200>Nim</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[0]; ?></td>
	</tr>
	<tr>
		<td width=200>Nama Mahasiswa</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[1]; ?></td>
	</tr>
	<tr>
		<td width=200>Angkatan</td>
		<td width=15>:</td>
		<td><?php echo $data_mhs[9]; ?></td>
	</tr>
	<tr>
		<td width=200>Judul Skripsi</td>
		<td width=15>:</td>
		<td><?php echo $data_skripsi[3]; ?></td>
	</tr>
	<tr>
		<td>File Skripsi</td>
		<td>:</td>
		<td><a href="admin/file_skripsi/<?php echo $data_skripsi[4]; ?>">Download Skripsi</a></td>
	</tr>
	<?php
		$qry_pem=mysql_query("select * from pembimbing_skripsi where nim='$nim'");
		$data_pem=mysql_fetch_array($qry_pem);
		$qry_dosen1=mysql_query("select * from dosen where id_dosen='$data_pem[2]'");
		$qry_dosen2=mysql_query("select * from dosen where id_dosen='$data_pem[3]'");
		$data_dosen1=mysql_fetch_array($qry_dosen1);
		$data_dosen2=mysql_fetch_array($qry_dosen2);
	?>
	<tr>
		<td>Pembimbing</td>
	</tr>
	<tr>
		<td>Pembimbing 1</td>
		<td>:</td>
		<td><?php echo $data_dosen1[2]; ?></td>
	</tr>
	<tr>
		<td>Pembimbing 2</td>
		<td>:</td>
		<td><?php echo $data_dosen2[2]; ?></td>
	</tr>
</table>	
</div>