<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }

</script>
<div class="content-module-heading cf">
	<h3 class="fl">Look Data Skripsi</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">
<?php

if (isset($_GET['aksi'])){
	$aksi=$_GET['aksi'];
	$nim=$_GET['nim'];
	$kd_mk=$_GET['kd_mk'];
	$id_skripsi=$_GET['id_skripsi'];
	if ($aksi=="acc"){
		mysql_query("update skripsi set status='$aksi', kd_mk='$kd_mk' where nim='$nim' and id_skripsi='$id_skripsi'");
	} else if($aksi=="tolak"){
		mysql_query("update skripsi set status='$aksi', kd_mk='$kd_mk' where nim='$nim' and id_skripsi='$id_skripsi'");
	}
}

// jumlah data yang akan ditampilkan per halaman
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
$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_thn=mysql_fetch_array($qry_thn);
$ta=$data_thn[0];
$query = "SELECT 
		 mahasiswa.nim,
		 mahasiswa.nama,
		 konsentrasi.nm_konsentrasi,
		 krs.kd_mk
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$ta' and
		 konsentrasi.kd_jurusan='$_SESSION[logusername]' and 
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi order by(konsentrasi.kd_konsentrasi) asc
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
		 konsentrasi.nm_konsentrasi,
		 krs.kd_mk
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and 
		 krs.id_ta='$ta' and 
		 konsentrasi.kd_jurusan='$_SESSION[logusername]' and 
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi and
		 (mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 konsentrasi.nm_konsentrasi like '%$cari%'
		 )
		 order by(konsentrasi.kd_konsentrasi) asc
		 LIMIT $offset, $limit";
}
$result = mysql_query($query) or die('Error');
// menampilkan data
?>

<form action="index.php?target=look.prodi.skripsi" method="post" class="search">
<table width=100%>
<tr>
<td width=115 valign=middle>View&nbsp;  
<select name="view" class="select" onChange="MM_jumpMenu('parent',this,0)">
<option value="index.php?target=look.prodi.skripsi&batas=5&cari=<?php echo $cari?>" <?php if ($batas==5) {echo "selected";} ?>>5</option>
<option value="index.php?target=look.prodi.skripsi&batas=10&cari=<?php echo $cari?>" <?php if ($batas==10) {echo "selected";} ?>>10</option>
<option value="index.php?target=look.prodi.skripsi&batas=20&cari=<?php echo $cari?>" <?php if ($batas==20) {echo "selected";} ?>>20</option>
<option value="index.php?target=look.prodi.skripsi&batas=50&cari=<?php echo $cari?>" <?php if ($batas==50) {echo "selected";} ?>>50</option>
</select>
Entries
</td>
<td align=right>
<div style="width:350px;">
	<button type="submit" class="tombolsearch"><img src="images/search.png"></button>
	<input type="search" name="cari" placeholder="Search..." value="<?php echo $cari; ?>">
	<input type="hidden" name="batas" value="<?php echo $batas; ?>">
</div>
</td>
</tr>
</table>
</form>
<table width=100% cellpadding=6 style="border-collapse:collapse;margin-top:5px;" class=tabel>
<form name='myform' action="index.php?target=delete.kklp" method="post">
<tr>
<th width=20>No</th>
<th width=80>Nim</th>
<th width=120>Nama</th>
<th width=250>Judul Skripsi</th>
<th width=50>File Skripsi</th>
<th width=40>Aksi</th>
</tr>
<?php
$warnaGenap = "warnagenap";   // warna abu-abu
$warnaGanjil = "warnaganjil";  // warna putih
while($data = mysql_fetch_array($result)){
$qry_skripsi=mysql_query("select * from skripsi where nim='$data[0]'");
$data_skripsi=mysql_fetch_array($qry_skripsi);
if($data_skripsi[3]==""){
	$judul="<center><font style='color:#f00;'>Belum Ada Data</font></center>";
} else {
	$judul="$data_skripsi[3]";
}

if($data_skripsi[4]==""){
	$file="<center><font style='color:#f00;'>Belum Ada Data</font></center>";
} else {
	$file="<center><a href='file_skripsi/$data_skripsi[4]'>Download</a></center>";
}

if ($no % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
?>
<tr class="<?php echo $warna; ?>">
<td align=center><?php echo $no; ?></td>
<td align=center><?php echo $data[0]; ?></td>
<td><?php echo $data[1]; ?></td>
<td><?php echo $judul; ?></td>
<td><?php echo $file; ?></td>
<td align=center valign=middle>
<?php
	if ($data_skripsi[3]=="" and $data_skripsi[4]==""){
		echo "<font style='color:#f00;'>None</font>";
	} else if ($data_skripsi[5]=="pending"){
?>	
	<a href="index.php?target=look.prodi.skripsi&nim=<?php echo $data[0]; ?>&id_skripsi=<?php echo $data_skripsi[0]; ?>&kd_mk=<?php echo $data[3]; ?>&aksi=acc">ACC</a> | 
	<a href="index.php?target=look.prodi.skripsi&nim=<?php echo $data[0]; ?>&id_skripsi=<?php echo $data_skripsi[0]; ?>&kd_mk=<?php echo $data[3]; ?>&aksi=tolak">TOLAK</a>
<?php
} else {
	if ($data_skripsi[5]=="acc"){
		echo "<font style='color:green;'>Diterima</font>";
	} else if ($data_skripsi[5]=="tolak"){	
		echo "<font style='color:#f00;'>Ditolak</font>";
	}
}
?>
</td>
</tr>
<?php
$no++;
}
?>
</form>
</table>
<?php
echo "<br style='margin-bottom:-5px;'>";
// mencari jumlah semua data dalam tabel barang
$query = "SELECT 
		 mahasiswa.nim,
		 mahasiswa.nama,
		 konsentrasi.nm_konsentrasi,
		 krs.kd_mk
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and 
		 krs.id_ta='$ta' and
		 konsentrasi.kd_jurusan='$_SESSION[logusername]' and 
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi
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
		 konsentrasi.kd_konsentrasi,
		 krs.kd_mk
		 FROM mahasiswa,krs,konsentrasi
		 where
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$ta' and 
		 konsentrasi.kd_jurusan='$_SESSION[logusername]' and 
		 konsentrasi.kd_konsentrasi=mahasiswa.kd_konsentrasi and
		 (mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 konsentrasi.nm_konsentrasi like '%$cari%'
		 )";
}
$hasil  = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$jumData = mysql_num_rows($hasil);
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$limit);
//menampilkan link << Previous
if ($page > 1){
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.skripsi&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#4a8bc2;color:#fff;border:1px solid #4a8bc2;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #d7ebf9;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#d7ebf9;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.skripsi&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.skripsi&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div> <!-- end content-module-main -->