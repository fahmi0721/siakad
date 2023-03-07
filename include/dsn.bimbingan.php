<link rel="stylesheet" href="css/style.search.css">
<?php
	$id_dosen=$_SESSION['sesiusername'];
	$batas="10";

if (isset($_GET['batas'])) {
$batas=$_GET['batas'];
}

if (isset($_POST['batas'])) {
$batas=$_POST['batas'];
}

$limit = $batas;
// apabila ada parameter, gunakan parameter tersebut,
// sedangkan apabila belum, nomor halamannya 1.
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
// perhitungan offset
$offset = ($page - 1) * $limit;
// query SQL untuk menampilkan data perhalaman sesuai offset
$no=1;
$cari="";

$query = "SELECT 
		 pembimbing.id_pembimbing,
		 pembimbing.id_dosen,
		 pembimbing.nim,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 konsentrasi.nm_konsentrasi
		 FROM pembimbing,mahasiswa,konsentrasi 
		 where
		 pembimbing.id_dosen='$id_dosen' and 
		 pembimbing.nim=mahasiswa.nim and 
		 mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi
		 LIMIT $offset, $limit";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT
		 pembimbing.id_pembimbing,
		 pembimbing.id_dosen,
		 pembimbing.nim,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 konsentrasi.nm_konsentrasi
		 FROM pembimbing,mahasiswa,konsentrasi
		 where
		 pembimbing.id_dosen='$id_dosen' and 
		 pembimbing.nim=mahasiswa.nim and 
		 mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi and 
		 (mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 mahasiswa.thn_msk like '%$cari%' or
		 konsentrasi.nm_konsentrasi like '%$cari%')
		 LIMIT $offset, $limit";
}
$result = mysql_query($query) or die('Error');
// menampilkan data


?>
<br>
<h2>Halaman Daftar Bimbingan Mahasiswa</h2>
<br>
<form action="index.php?target=dsn.bimbingan" method="post" class="search">
<table width=100%>
<tr>
<td align=right valign=bottom>
<div style="width:100%;">
	<button type="submit" class="tombolsearch"><img src="admin/images/search.png"></button>
	<input style="height:42px;" type="search" name="cari" placeholder="Search..." value="<?php echo $cari; ?>">
	<input type="hidden" name="batas" value="<?php echo $batas; ?>">
</div>
</td>
</tr>
</table>
</form>
<table width=100% style="margin-top:-35px;">
<tr style="border-bottom:3px solid #aaa;">
	<th>No</th>
	<th>Nim</th>
	<th>Nama</th>
	<th>Program Studi</th>
	<th>Angkatan</th>
	<th>Detail</th>
</tr>
<?php		
	while($data = mysql_fetch_array($result)){
?>
<tr style="border-bottom:1px solid #aaa;">
	<td align=center><?php echo $no; ?></td>
	<td align=center><?php echo $data[3]; ?></td>
	<td><?php echo $data[4]; ?></td>
	<td align=center><?php echo $data[6]; ?></td>
	<td align=center><?php echo $data[5]; ?></td>
	<td align=center><a href="index.php?target=dsn.look.data.bimbingan&nim=<?php echo $data[3]; ?>">Look Data</a></td>
</tr>
<?php		
	$no++;
	}
?>
</table>
<div style="margin-top:-20px;">
<?php
// mencari jumlah semua data dalam tabel barang
$query  = "SELECT 
		  pembimbing.id_pembimbing,
		  pembimbing.id_dosen,
		  pembimbing.nim,
		  mahasiswa.nim,
		  mahasiswa.nama,
		  mahasiswa.thn_msk,
		  konsentrasi.nm_konsentrasi
		  FROM pembimbing,mahasiswa,konsentrasi 
		  where
		  pembimbing.id_dosen='$id_dosen' and 
		  pembimbing.nim=mahasiswa.nim and 
		  mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi
		  ";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT
		 pembimbing.id_pembimbing,
		 pembimbing.id_dosen,
		 pembimbing.nim,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 konsentrasi.nm_konsentrasi
		 FROM pembimbing,mahasiswa,konsentrasi
		 where
		 pembimbing.id_dosen='$id_dosen' and 
		 pembimbing.nim=mahasiswa.nim and 
		 mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi and 
		 (mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 mahasiswa.thn_msk like '%$cari%' or
		 konsentrasi.nm_konsentrasi like '%$cari%')
		 ";
}
$hasil  = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$jumData = mysql_num_rows($hasil);
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$limit);
//menampilkan link << Previous
if ($page > 1){
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#ffccd5;border:1px solid #ffccd5;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=dsn.bimbingan&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#e27689;color:#fff;border:1px solid #e27689;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #ffccd5;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#ffccd5;' href='".$_SERVER['PHP_SELF']."?target=dsn.bimbingan&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#ffccd5;border:1px solid #ffccd5;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=dsn.bimbingan&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div>
<br>