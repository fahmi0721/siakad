<?php
if (isset($_GET['nim']) and isset($_GET['kd_mk'])){
	$nim=$_GET['nim'];
	$kd_mk=$_GET['kd_mk'];
} else {
	$nim=$_POST['nim'];
	$kd_mk=$_POST['kd_mk'];
}

$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
$data_mhs=mysql_fetch_array($qry_mhs);
$qry_prodi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_mhs[10]'");
$data_prodi=mysql_fetch_array($qry_prodi);
$qry_kklp=mysql_query("select * from kklp where nim='$nim'");
$data_kklp=mysql_fetch_array($qry_kklp);
$jum_kklp=mysql_num_rows($qry_kklp);
if($jum_kklp>0){
	$id_kklp=$data_kklp[0];
	$instansi=$data_kklp[3];
	$alamat=$data_kklp[4];
} else {
	$id_kklp="";
	$instansi="";
	$alamat="";
}
$submit="Simpan";


if (isset($_POST['submit'])) {
$id_kklp=$_POST['id_kklp'];
$nim=$_POST['nim'];
$instansi=$_POST['instansi'];
$alamat=$_POST['alamat'];
$submit=$_POST['submit'];

$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_thn=mysql_fetch_array($qry_thn);

$qry_kklp=mysql_query("select * from kklp where nim='$nim'");
$data_kklp=mysql_fetch_array($qry_kklp);
$jum_kklp=mysql_num_rows($qry_kklp);

if ($jum_kklp==0){

mysql_query("insert into kklp values('$id_kklp','$nim','$data_thn[0]','$instansi','$alamat','','','$kd_mk')");
echo "<script>alert ('Thank You Success Saving')</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php?target=look.kklp' />";

} else {

mysql_query("update kklp set nama_instansi='$instansi',alamat_instansi='$alamat' where id_kklp='$id_kklp' and nim='$nim'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
echo '<meta http-equiv="refresh" content="0;url=index.php?target=look.kklp" />';

}
}

?>

<div class="content-module-heading cf">
	<h3 class="fl">Add Data KKLP</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">

<center>
<form action="index.php?target=input.kklp" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=left>
<legend>Konten KKLP</legend>
<table cellspacing=10 align=left>
<tr>
<td><b style="font-size:18px;">Nama : 
<?php echo $data_mhs[1]?></b></td>
</tr>
<tr>
<td><b style="font-size:18px;">Angkatan : 
<?php echo $data_mhs[9]?></b></td>
</tr>
<tr>
<td><b style="font-size:18px;">Jurusan : 
<?php echo $data_prodi[2]?></b></td>
</tr>
<tr>
<td>Nama Instansi * :</td>
</tr>
<tr>
<td valign=top>
<input type="hidden" name="id_kklp" value="<?php echo $id_kklp; ?>">
<input type="hidden" name="nim" value="<?php echo $nim; ?>">
<input type="hidden" name="kd_mk" value="<?php echo $kd_mk; ?>">
<input type="text" name="instansi" value="<?php echo $instansi?>" style="width:600px;">
</td>
</tr>
<tr>
<td>Alamat Instansi* :</td>
</tr>
<tr>
<td>
<textarea id="area1" cols="130" rows="15" placeholder="Masukkan Isi Informasi" name="alamat"><?php echo $alamat; ?></textarea>
</td>
</tr>
</table>
</fieldset>
<br>

<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=center>
<legend>Simpan Data KKLP</legend>
<table align=left>
<tr>
<td><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
</form>
</center>
</div> <!-- end content-module-main -->
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('area1');
	new nicEditor({fullPanel : true}).panelInstance('area2');
});
</script>