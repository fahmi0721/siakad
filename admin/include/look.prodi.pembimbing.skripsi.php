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
	<h3 class="fl">Look Data Pembimbing Skripsi</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">
<?php

if (isset($_POST['submit'])){
	$nim=$_POST['nim'];
	$dosen1=$_POST['dosen1'];
	$dosen2=$_POST['dosen2'];
	$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
	$data_thn=mysql_fetch_array($qry_thn);
	$ta=$data_thn[0];
	
	$jum_skripsi=mysql_num_rows(mysql_query("select * from pembimbing_skripsi where nim='$nim'"));
	
	if ($jum_skripsi==0){
		mysql_query("insert into pembimbing_skripsi values('','$nim','$dosen1','$dosen2','$ta')");
		echo "<script>alert ('Thank You Success For Saving Data')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.prodi.pembimbing.skripsi' />";
	} else {
		mysql_query("update pembimbing_skripsi set dosen1='$dosen1', dosen2='$dosen2' where nim='$nim'");
		echo "<script>alert ('Thank You Success For Update Data')</script>";
		echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.prodi.pembimbing.skripsi' />";
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
		 krs.kd_mk,
		 skripsi.judul_skripsi
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and 
		 skripsi.status='acc' and 
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
		 krs.kd_mk,
		 skripsi.judul_skripsi
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and 
		 skripsi.status='acc' and 
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

<form action="index.php?target=look.prodi.pembimbing.skripsi" method="post" class="search">
<table width=100%>
<tr>
<td width=115 valign=middle>View&nbsp;  
<select name="view" class="select" onChange="MM_jumpMenu('parent',this,0)">
<option value="index.php?target=look.prodi.pembimbing.skripsi&batas=5&cari=<?php echo $cari?>" <?php if ($batas==5) {echo "selected";} ?>>5</option>
<option value="index.php?target=look.prodi.pembimbing.skripsi&batas=10&cari=<?php echo $cari?>" <?php if ($batas==10) {echo "selected";} ?>>10</option>
<option value="index.php?target=look.prodi.pembimbing.skripsi&batas=20&cari=<?php echo $cari?>" <?php if ($batas==20) {echo "selected";} ?>>20</option>
<option value="index.php?target=look.prodi.pembimbing.skripsi&batas=50&cari=<?php echo $cari?>" <?php if ($batas==50) {echo "selected";} ?>>50</option>
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
<form name='myform' action="index.php?target=look.prodi.pembimbing.skripsi" method="post">
<tr>
<th width=15>No</th>
<th width=80>Nim</th>
<th width=150>Nama</th>
<th width=210>Judul Skripsi</th>
<th width=210>Pembimbing 1</th>
<th width=210>Pembimbing 2</th>
<th width=40>Aksi</th>
</tr>
<?php
$warnaGenap = "warnagenap";   // warna abu-abu
$warnaGanjil = "warnaganjil";  // warna putih
while($data = mysql_fetch_array($result)){
if ($no % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
	$qry_pem=mysql_query("select * from pembimbing_skripsi where nim='$data[0]'");
	$data_pem=mysql_fetch_array($qry_pem);
?>
<tr class="<?php echo $warna; ?>">
<td align=center><?php echo $no; ?></td>
<td align=center><?php echo $data[0]; ?>
<input type="hidden" name="nim" value="<?php echo $data[0]; ?>">
</td>
<td><?php echo $data[1]; ?></td>
<td><?php echo $data[4]; ?></td>
<td align=center>
	<select name="dosen1" class="text_medium round" required>
		<option value="">-- Pilih Pembimbing 1 --</option>
			<?php
				$qry_dosen=mysql_query("select * from dosen");
				while($data_dosen=mysql_fetch_array($qry_dosen)){
			?>
				<option value="<?php echo $data_dosen[0]; ?>" <?php if ($data_pem[2]=="$data_dosen[0]"){ echo "selected"; }?>><?php echo $data_dosen[2]; ?></option>
			<?php	
				}
			?>
	</select>
</td>
<td align=center>
	<select name="dosen2" class="text_medium round" required>
		<option value="">-- Pilih Pembimbing 2 --</option>
			<?php
				$qry_dosen=mysql_query("select * from dosen");
				while($data_dosen=mysql_fetch_array($qry_dosen)){
			?>
				<option value="<?php echo $data_dosen[0]; ?>" <?php if ($data_pem[3]=="$data_dosen[0]"){ echo "selected"; }?>><?php echo $data_dosen[2]; ?></option>
			<?php	
				}
			?>
	</select>
</td>
<td align=center>
<input type="submit" name="submit" value="Save">
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
		 krs.kd_mk,
		 skripsi.judul_skripsi
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and 
		 skripsi.status='acc' and 
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
		 krs.kd_mk,
		 skripsi.judul_skripsi
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and 
		 skripsi.status='acc' and 
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
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.pembimbing.skripsi&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#4a8bc2;color:#fff;border:1px solid #4a8bc2;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #d7ebf9;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#d7ebf9;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.pembimbing.skripsi&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.prodi.pembimbing.skripsi&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div> <!-- end content-module-main -->