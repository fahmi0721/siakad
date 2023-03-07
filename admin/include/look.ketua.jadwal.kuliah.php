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
	<h3 class="fl">Look Data Jadwal Perkuliahan</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">
<?php
// jumlah data yang akan ditampilkan per halaman
$batas="20";

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
$qry_ta=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_ta=mysql_fetch_array($qry_ta);
$query = "SELECT 
		  mata_kuliah.kd_mk,
		  mata_kuliah.nama_mk,
		  konsentrasi.nm_konsentrasi,
		  ruang_kelas.nm_kelas,
		  dosen.nama,
		  jadwal_kuliah.id_ruangan,
		  jadwal_kuliah.ruangan2,
		  jadwal_kuliah.hari,
		  jadwal_kuliah.hari2,
		  jadwal_kuliah.jam,
		  jadwal_kuliah.jam2
		  FROM mata_kuliah,jadwal_kuliah,konsentrasi,dosen,ruang_kelas
		  where
		  mata_kuliah.kd_mk=jadwal_kuliah.kd_mk and
		  dosen.id_dosen=jadwal_kuliah.id_dosen and
		  ruang_kelas.id_kelas=jadwal_kuliah.id_kelas and
		  konsentrasi.kd_konsentrasi=ruang_kelas.kd_konsentrasi and
		  jadwal_kuliah.id_ta='$data_ta[0]'
		  LIMIT $offset, $limit";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT 
		  mata_kuliah.kd_mk,
		  mata_kuliah.nama_mk,
		  konsentrasi.nm_konsentrasi,
		  ruang_kelas.nm_kelas,
		  dosen.nama,
		  jadwal_kuliah.id_ruangan,
		  jadwal_kuliah.ruangan2,
		  jadwal_kuliah.hari,
		  jadwal_kuliah.hari2,
		  jadwal_kuliah.jam,
		  jadwal_kuliah.jam2
		  FROM mata_kuliah,jadwal_kuliah,konsentrasi,dosen,ruang_kelas
		  where
		  mata_kuliah.kd_mk=jadwal_kuliah.kd_mk and
		  dosen.id_dosen=jadwal_kuliah.id_dosen and
		  ruang_kelas.id_kelas=jadwal_kuliah.id_kelas and
		  konsentrasi.kd_konsentrasi=ruang_kelas.kd_konsentrasi and
		  jadwal_kuliah.id_ta='$data_ta[0]' and 
		  (mata_kuliah.kd_mk like '%$cari%' or
		  mata_kuliah.nama_mk like '%$cari%' or
		  konsentrasi.nm_konsentrasi like '%$cari%' or
		  ruang_kelas.nm_kelas like '%$cari%' or
		  dosen.nama like '%$cari%' or
		  jadwal_kuliah.id_ruangan like '%$cari%' or
		  jadwal_kuliah.ruangan2 like '%$cari%' or
		  jadwal_kuliah.hari like '%$cari%' or
		  jadwal_kuliah.hari2 like '%$cari%' or
		  jadwal_kuliah.jam like '%$cari%' or
		  jadwal_kuliah.jam2 like '%$cari%')
		  LIMIT $offset, $limit";

}
$result = mysql_query($query) or die('Error');
// menampilkan data


?>
<form action="index.php?target=look.ketua.jadwal.kuliah" method="post" class="search">
<h1>Tahun Ajaran <?php echo $data_ta[1]; ?></h1>
<table width=100%>
<tr>
<td width=115 valign=middle>View&nbsp;  
<select name="view" class="select" onChange="MM_jumpMenu('parent',this,0)">
<option value="index.php?target=look.ketua.jadwal.kuliah&batas=5&cari=<?php echo $cari?>" <?php if ($batas==5) {echo "selected";} ?>>5</option>
<option value="index.php?target=look.ketua.jadwal.kuliah&batas=10&cari=<?php echo $cari?>" <?php if ($batas==10) {echo "selected";} ?>>10</option>
<option value="index.php?target=look.ketua.jadwal.kuliah&batas=20&cari=<?php echo $cari?>" <?php if ($batas==20) {echo "selected";} ?>>20</option>
<option value="index.php?target=look.ketua.jadwal.kuliah&batas=50&cari=<?php echo $cari?>" <?php if ($batas==50) {echo "selected";} ?>>50</option>
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
<tr>
<th width=30>No</th>
<th width=50>Kode</th>
<th width=210>Nama Matakuliah</th>
<th width=100>Jurusan/Konsentrasi</th>
<th width=100>Kelas</th>
<th width=100>Dosen Pengajar</th>
<th width=100>Jadwal</th>
</tr>
<?php
$warnaGenap = "warnagenap";   // warna abu-abu
$warnaGanjil = "warnaganjil";  // warna putih
while($data = mysql_fetch_array($result)){
if ($no % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
	
	$qry_ruangan=mysql_query("select * from ruangan where id_ruangan='$data[5]'");
	$data_ruangan=mysql_fetch_array($qry_ruangan);
	
	$qry_ruangan2=mysql_query("select * from ruangan where id_ruangan='$data[6]'");
	$data_ruangan2=mysql_fetch_array($qry_ruangan2);
?>
<tr class="<?php echo $warna; ?>">
<td align=center><?php echo $no; ?></td>
<td align=center><?php echo $data[0]; ?></td>
<td><?php echo $data[1]; ?></td>
<td align=center><?php echo $data[2]; ?></td>
<td align=center><?php echo $data[3]; ?></td>
<td><?php echo $data[4]; ?></td>
<?php
if ($data[6]=="" and $data[8]=="" and $data[10]==""){
			echo "<td align=center>".$data_ruangan[1].", " .$data[7].", " .$data[9]."</td>";
		} else {
			echo "<td align=center>".$data_ruangan[1].", " .$data[7].", " .$data[9] . " <br> " .$data_ruangan2[1].", " .$data[8].", " .$data[10] ."</td>";
		}
?>
</tr>
<?php
$no++;
}
?>
</table>
<?php
echo "<br style='margin-bottom:-5px;'>";
// mencari jumlah semua data dalam tabel barang
$query  = "SELECT 
		   mata_kuliah.kd_mk,
		  mata_kuliah.nama_mk,
		  konsentrasi.nm_konsentrasi,
		  ruang_kelas.nm_kelas,
		  dosen.nama,
		  jadwal_kuliah.id_ruangan,
		  jadwal_kuliah.ruangan2,
		  jadwal_kuliah.hari,
		  jadwal_kuliah.hari2,
		  jadwal_kuliah.jam,
		  jadwal_kuliah.jam2
		  FROM mata_kuliah,jadwal_kuliah,konsentrasi,dosen,ruang_kelas
		  where
		  mata_kuliah.kd_mk=jadwal_kuliah.kd_mk and
		  dosen.id_dosen=jadwal_kuliah.id_dosen and
		  ruang_kelas.id_kelas=jadwal_kuliah.id_kelas and
		  konsentrasi.kd_konsentrasi=ruang_kelas.kd_konsentrasi and
		  jadwal_kuliah.id_ta='$data_ta[0]'
		  ";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT 
		  mata_kuliah.kd_mk,
		  mata_kuliah.nama_mk,
		  konsentrasi.nm_konsentrasi,
		  ruang_kelas.nm_kelas,
		  dosen.nama,
		  jadwal_kuliah.id_ruangan,
		  jadwal_kuliah.ruangan2,
		  jadwal_kuliah.hari,
		  jadwal_kuliah.hari2,
		  jadwal_kuliah.jam,
		  jadwal_kuliah.jam2
		  FROM mata_kuliah,jadwal_kuliah,konsentrasi,dosen,ruang_kelas
		  where
		  mata_kuliah.kd_mk=jadwal_kuliah.kd_mk and
		  dosen.id_dosen=jadwal_kuliah.id_dosen and
		  ruang_kelas.id_kelas=jadwal_kuliah.id_kelas and
		  konsentrasi.kd_konsentrasi=ruang_kelas.kd_konsentrasi and
		  jadwal_kuliah.id_ta='$data_ta[0]' and 
		  (mata_kuliah.kd_mk like '%$cari%' or
		  mata_kuliah.nama_mk like '%$cari%' or
		  konsentrasi.nm_konsentrasi like '%$cari%' or
		  ruang_kelas.nm_kelas like '%$cari%' or
		  dosen.nama like '%$cari%' or
		  jadwal_kuliah.id_ruangan like '%$cari%' or
		  jadwal_kuliah.ruangan2 like '%$cari%' or
		  jadwal_kuliah.hari like '%$cari%' or
		  jadwal_kuliah.hari2 like '%$cari%' or
		  jadwal_kuliah.jam like '%$cari%' or
		  jadwal_kuliah.jam2 like '%$cari%')
		  ";
}
$hasil  = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$jumData = mysql_num_rows($hasil);
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$limit);
//menampilkan link << Previous
if ($page > 1){
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.ketua.jadwal.kuliah&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#4a8bc2;color:#fff;border:1px solid #4a8bc2;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #d7ebf9;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#d7ebf9;' href='".$_SERVER['PHP_SELF']."?target=look.ketua.jadwal.kuliah&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.ketua.jadwal.kuliah&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div> <!-- end content-module-main -->