<link rel="stylesheet" href="css/style.search.css">
<?php
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
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 mahasiswa.foto,
		 konsentrasi.nm_konsentrasi
		 FROM mahasiswa,konsentrasi 
		 where
		 mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi
		 LIMIT $offset, $limit";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 mahasiswa.foto,
		 konsentrasi.nm_konsentrasi
		 FROM mahasiswa,konsentrasi
		 where
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
<h2>Mahasiswa Friends Social</h2>
<form action="index.php?target=mhs.social.media&hal=friends" method="post" class="search">
<table width=100%>
<tr>
<td align=right valign=bottom>
<div style="width:100%;">
	<button type="submit" class="tombolsearch"><img src="admin/images/search.png"></button>
	<input type="search" name="cari" placeholder="Search..." value="<?php echo $cari; ?>">
	<input type="hidden" name="batas" value="<?php echo $batas; ?>">
</div>
</td>
</tr>
</table>
</form>
<?php		
	while($data = mysql_fetch_array($result)){
	if ($data[3]==""){
		$foto="user.gif";
	} else {	
		$foto="$data[3]";
	}
	if($data[0]!=$user){
?>
<div style="width:10%;float:left">
	<a href=""><img src="admin/foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;"></a>
</div>
<div style="width:88%;float:right;">
	<a href=""><?php echo $data[1]; ?></a>
	<br>
	Angkatan : <?php echo $data[2]; ?>
	<br>
	Program Studi : <?php echo $data[4]; ?>
</div>	
<div style="clear:both;margin-bottom:20px;">
</div>
<?php		
	$no++;
	}
	}
?>
<div style="margin-top:20px;">
<?php
// mencari jumlah semua data dalam tabel barang
$query  = "SELECT 
		  mahasiswa.nim,
		  mahasiswa.nama,
		  mahasiswa.thn_msk,
		  mahasiswa.foto,
		  konsentrasi.nm_konsentrasi
		  FROM mahasiswa,konsentrasi 
		  where
		  mahasiswa.kd_konsentrasi=konsentrasi.kd_konsentrasi
		  ";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT
		 mahasiswa.nim,
		 mahasiswa.nama,
		 mahasiswa.thn_msk,
		 mahasiswa.foto,
		 konsentrasi.nm_konsentrasi
		 FROM mahasiswa,konsentrasi
		 where
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
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#ffccd5;border:1px solid #ffccd5;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=mhs.social.media&hal=friends&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#e27689;color:#fff;border:1px solid #e27689;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #ffccd5;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#ffccd5;' href='".$_SERVER['PHP_SELF']."?target=mhs.social.media&hal=friends&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#ffccd5;border:1px solid #ffccd5;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=mhs.social.media&hal=friends&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div>
<br>