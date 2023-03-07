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
	<h3 class="fl">Look Data Konsentrasi</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">
<?php
if (isset($_POST['submit_ulang'])){
$id_bayar=$_POST['id_bayar'];
$nim_krs=$_POST['nim_krs'];
$id_ta_krs=$_POST['id_ta_krs'];
$sks_krs=$_POST['sks_krs'];
mysql_query("update konfirmasi_bayar set status_ulang='yes', batas_sks='$sks_krs' where id_bayar='$id_bayar' and nim='$nim_krs' and id_ta='$id_ta_krs'");
}

include "input.verifikasi.bayar.php";
// jumlah data yang akan ditampilkan per halaman
$batas="5";

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
		 konfirmasi_bayar.id_bayar,
		 konfirmasi_bayar.nim,
		 konfirmasi_bayar.id_ta,
		 konfirmasi_bayar.no_bayar,
		 konfirmasi_bayar.status,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 thn_ajaran.id_ta,
		 thn_ajaran.nama_ta,
		 konfirmasi_bayar.batas_sks,
		 konfirmasi_bayar.status_ulang
		 FROM konfirmasi_bayar,mahasiswa,thn_ajaran where 
		 konfirmasi_bayar.nim=mahasiswa.nim and konfirmasi_bayar.id_ta=thn_ajaran.id_ta
		 LIMIT $offset, $limit";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query = "SELECT 
		 konfirmasi_bayar.id_bayar,
		 konfirmasi_bayar.nim,
		 konfirmasi_bayar.id_ta,
		 konfirmasi_bayar.no_bayar,
		 konfirmasi_bayar.status,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 thn_ajaran.id_ta,
		 thn_ajaran.nama_ta,
		 konfirmasi_bayar.batas_sks,
		 konfirmasi_bayar.status_ulang
		 FROM konfirmasi_bayar,mahasiswa,thn_ajaran where 
		 konfirmasi_bayar.nim=mahasiswa.nim and konfirmasi_bayar.id_ta=thn_ajaran.id_ta and
		 (konfirmasi_bayar.no_bayar like '%$cari%' or
		 mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 konfirmasi_bayar.no_bayar like '%$cari%' or
		 konfirmasi_bayar.batas_sks like '%$cari%' or
		 thn_ajaran.nama_ta like '%$cari%')
		 LIMIT $offset, $limit";
}
$result = mysql_query($query) or die('Error');
// menampilkan data

?>
<form action="index.php?target=look.verifikasi.bayar" method="post" class="search">
<table width=100%>
<tr>
<td width=115 valign=middle>View&nbsp;  
<select name="view" class="select" onChange="MM_jumpMenu('parent',this,0)">
<option value="index.php?target=look.verifikasi.bayar&batas=5&cari=<?php echo $cari?>" <?php if ($batas==5) {echo "selected";} ?>>5</option>
<option value="index.php?target=look.verifikasi.bayar&batas=10&cari=<?php echo $cari?>" <?php if ($batas==10) {echo "selected";} ?>>10</option>
<option value="index.php?target=look.verifikasi.bayar&batas=20&cari=<?php echo $cari?>" <?php if ($batas==20) {echo "selected";} ?>>20</option>
<option value="index.php?target=look.verifikasi.bayar&batas=50&cari=<?php echo $cari?>" <?php if ($batas==50) {echo "selected";} ?>>50</option>
</select>
Entries
</td>
<td align=right>
<div style="width:350px;">
	<button type="submit" class="tombolsearch" style="height:27px;"><img src="images/search.png"></button>
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
<th width=150>Tahun Ajaran</th>
<th width=280>Nim / Nama</th>
<th width=210>Nomor Pembayaran</th>
<th width=80>Batas SKS</th>
<th width=80>Status</th>
<th width=80>Ulang</th>
<th width=40>Aksi</th>
</tr>
<?php
$warnaGenap = "warnagenap";   // warna abu-abu
$warnaGanjil = "warnaganjil";  // warna putih
while($data = mysql_fetch_array($result)){
if ($no % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
	$qry_krs=mysql_query("select * from krs where nim='$data[5]' and id_ta='$data[7]'");
	$jum_krs=mysql_num_rows($qry_krs);
?>
<tr class="<?php echo $warna; ?>">
<td align=center><?php echo $no; ?></td>
<td align=center><?php echo $data[8]; ?></td>
<td><?php echo $data[5] ." / ". $data[6]; ?></td>
<td><?php echo $data[3]; ?></td>
<td align=center>
<form action="index.php?target=look.verifikasi.bayar" method="post">
<?php 
if ($data[10]=="yes" or $jum_krs==0){
	echo $data[9];
	echo " SKS";
} else {	
?>
<input type="text" name="sks_krs" style="width:15px;height:10px;" value="<?php echo $data[9]; ?>"> SKS
<?php
}
?>
</td>
<td align=center><?php echo $data[4]; ?></td>
<td align=center>
<?php
if ($jum_krs==0){
	echo "<b style='color:#f00;'>Belum Urus Krs</b>";
} else if ($data[10]=="yes") {
	echo "<b style='color:green;'>Bisa Ulang Krs</b>";
} else {
?>
	<input type="hidden" name="id_bayar" value="<?php echo $data[0];?>">
	<input type="hidden" name="nim_krs" value="<?php echo $data[5];?>">
	<input type="hidden" name="id_ta_krs" value="<?php echo $data[7];?>">
	<button type="submit" name="submit_ulang" style="none;">On</button>
	</form>
<?php		
}
?>
</td>
<td align=center valign=middle><a href="index.php?target=look.verifikasi.bayar&kode_bayar=<?php echo $data[0]; ?>" class="table-actions-button ic-table-edit"></a> &nbsp;&nbsp; <a href="index.php?target=delete.verifikasi.bayar&kode_bayar=<?php echo $data[0]; ?>" onclick="return confirm('Are you sure you want to delete?')" class="table-actions-button ic-table-delete"></a></td>
</tr>
<?php
$no++;
}
?>
</table>
<?php
echo "<br style='margin-bottom:-5px;'>";
// mencari jumlah semua data dalam tabel barang
$query  = "SELECT konfirmasi_bayar.id_bayar,
		 konfirmasi_bayar.nim,
		 konfirmasi_bayar.id_ta,
		 konfirmasi_bayar.no_bayar,
		 konfirmasi_bayar.status,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 thn_ajaran.id_ta,
		 thn_ajaran.nama_ta,
		 konfirmasi_bayar.batas_sks,
		 konfirmasi_bayar.status_ulang
		 FROM konfirmasi_bayar,mahasiswa,thn_ajaran where 
		 konfirmasi_bayar.nim=mahasiswa.nim and konfirmasi_bayar.id_ta=thn_ajaran.id_ta";
if (isset($_POST['cari']) or isset($_GET['cari'])) {
if (!isset($_POST['cari'])){
$cari=$_GET['cari'];
}else{
$cari=$_POST['cari'];
}
$query  = "SELECT konfirmasi_bayar.id_bayar,
		 konfirmasi_bayar.nim,
		 konfirmasi_bayar.id_ta,
		 konfirmasi_bayar.no_bayar,
		 konfirmasi_bayar.status,
		 mahasiswa.nim,
		 mahasiswa.nama,
		 thn_ajaran.id_ta,
		 thn_ajaran.nama_ta,
		 konfirmasi_bayar.batas_sks,
		 konfirmasi_bayar.status_ulang
		 FROM konfirmasi_bayar,mahasiswa,thn_ajaran where 
		 konfirmasi_bayar.nim=mahasiswa.nim and konfirmasi_bayar.id_ta=thn_ajaran.id_ta and
		 (konfirmasi_bayar.no_bayar like '%$cari%' or
		 mahasiswa.nim like '%$cari%' or
		 mahasiswa.nama like '%$cari%' or
		 konfirmasi_bayar.no_bayar like '%$cari%' or
		 konfirmasi_bayar.batas_sks like '%$cari%' or
		 thn_ajaran.nama_ta like '%$cari%') 
		 ";
}
$hasil  = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$jumData = mysql_num_rows($hasil);
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$limit);
//menampilkan link << Previous
if ($page > 1){
echo  "<a style='padding-top:3px;padding-bottom:3px;color:#333;font-family:calibri;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.verifikasi.bayar&batas=$batas&page=".($page-1)."&cari=$cari'><< Prev</a>";
}
//menampilkan urutan paging
for($i = 1; $i <= $jumPage; $i++){
//mengurutkan agar yang tampil i+3 dan i-3
         if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $jumPage))
         {
            if($i==$jumPage && $page <= $jumPage-5) echo "<a href='' style='color:#000;padding-left:5px;padding-right:5px;'>...</a>";
            if ($i == $page) echo " <b style='font-family:calibri;background:#4a8bc2;color:#fff;border:1px solid #4a8bc2;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;'>".$i."</b> ";
            else echo " <a style='font-family:calibri;border:1px solid #d7ebf9;text-decoration:none;color:#000;padding-top:3px;padding-bottom:3px;padding-left:8px;padding-right:8px;background:#d7ebf9;' href='".$_SERVER['PHP_SELF']."?target=look.verifikasi.bayar&batas=$batas&page=".$i."&cari=$cari'>".$i."</a> ";
            if($i==1 && $page >= 6) echo "<a href='' style='font-family:calibri;color:#000;padding-left:5px;padding-right:5px;'>...</a>";
         }
}
//menampilkan link Next >>
if ($page < $jumPage){
echo "<a style='font-family:calibri;color:#333;padding-top:3px;padding-bottom:3px;padding-left:5px;padding-right:5px;background:#d7ebf9;border:1px solid #d7ebf9;text-decoration:none;' href='".$_SERVER['PHP_SELF']."?target=look.verifikasi.bayar&batas=$batas&page=".($page+1)."&cari=$cari'>Next >></a>";
}
?>
</div> <!-- end content-module-main -->