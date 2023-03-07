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

if(isset($_POST['submit'])){
		$id_nilai=$_POST['id_nilai'];
		$id_ta=$_POST['id_ta'];
		$nim=$_POST['nim'];
		$kd_mk=$_POST['kd_mk'];
		$nilai=$_POST['nilai'];
		
		$qry_sks=mysql_query("select sks from mata_kuliah where kd_mk='$kd_mk'");
		$data_sks=mysql_fetch_array($qry_sks);
		$sks=$data_sks[0];

		if($nilai>=85){
			$huruf="A";
			$angka=4*$sks;
		} else if($nilai>=75){
			$huruf="B";
			$angka=3*$sks;
		} else if($nilai>=65){
			$huruf="C";
			$angka=2*$sks;	
		} else if($nilai>=55){
			$huruf="D";
			$angka=1*$sks;	
		} else if($nilai<55){
			$huruf="E";
			$angka=0*$sks;
		}
		
		$jum_nilai=mysql_num_rows(mysql_query("select * from nilai where nim='$nim' and kd_mk='$kd_mk'"));
		if($jum_nilai==0){
			mysql_query("insert into nilai values('','$id_ta','$nim','$kd_mk','$nilai','$huruf','$angka')");
			echo "<script>alert ('Thank You Success For Saving Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.skripsi' />";
		} else {
			mysql_query("update nilai set total_nilai='$nilai', nilai_huruf='$huruf', nilai_angka='$angka' where id_nilai='$id_nilai' and nim='$nim' and kd_mk='$kd_mk'");
			echo "<script>alert ('Thank You Success For Saving Data')</script>";
			echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.skripsi' />";
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
		 skripsi.judul_skripsi,
		 skripsi.file_skripsi,
		 skripsi.status,
		 skripsi.kd_mk
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and
		 skripsi.status='acc' and
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$ta' and
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
		 skripsi.judul_skripsi,
		 skripsi.file_skripsi,
		 skripsi.status,
		 skripsi.kd_mk
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and
		 skripsi.status='acc' and
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and 
		 krs.id_ta='$ta' and 
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
<form name='myform' action="index.php?target=look.skripsi" method="post">
<tr>
<th width=20>No</th>
<th width=80>Nim</th>
<th width=120>Nama</th>
<th width=120>Prodi</th>
<th width=250>Judul Skripsi</th>
<th width=50>File Skripsi</th>
<th width=50>Nilai</th>
<th width=40>Aksi</th>
</tr>
<?php
$warnaGenap = "warnagenap";   // warna abu-abu
$warnaGanjil = "warnaganjil";  // warna putih
while($data = mysql_fetch_array($result)){

$qry_nilai=mysql_query("select * from nilai where nim='$data[0]' and kd_mk='$data[7]'");
$data_nilai=mysql_fetch_array($qry_nilai);
$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_ta=mysql_fetch_array($qry_ta);

if ($no % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;

?>
<tr class="<?php echo $warna; ?>">
<td align=center><?php echo $no; ?></td>
<td align=center><?php echo $data[0]; ?></td>
<td><?php echo $data[1]; ?></td>
<td><?php echo $data[2]; ?></td>
<td><?php echo $data[4]; ?></td>
<td align=center><a href="file_skripsi/<?php echo $data[5]; ?>">Download</a></td>
<td align=center valign=middle>
<input type="hidden" name="id_ta" style="width:30px;" value="<?php echo $data_ta[0]; ?>">
<input type="hidden" name="id_nilai" style="width:30px;" value="<?php echo $data_nilai[0]; ?>">
<input type="hidden" name="nim" style="width:30px;" value="<?php echo $data[0]; ?>">
<input type="hidden" name="kd_mk" style="width:30px;" value="<?php echo $data[7]; ?>">
<input type="text" name="nilai" style="width:30px;text-align:center;" value="<?php echo $data_nilai[4]; ?>" required>
</td>
<td align=center valign=middle>
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
		 skripsi.judul_skripsi,
		 skripsi.file_skripsi,
		 skripsi.status,
		 skripsi.kd_mk
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and
		 skripsi.status='acc' and
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and 
		 krs.id_ta='$ta' and
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
		 skripsi.judul_skripsi,
		 skripsi.file_skripsi,
		 skripsi.status,
		 skripsi.kd_mk
		 FROM mahasiswa,krs,konsentrasi,skripsi
		 where
		 skripsi.nim=mahasiswa.nim and
		 skripsi.status='acc' and
		 (krs.kd_mk='KB512586' or
		 krs.kd_mk='KB412586') and
		 krs.nim=mahasiswa.nim and
		 krs.id_ta='$ta' and 
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