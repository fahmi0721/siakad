<?php
$id_info="";
$untuk="";
$isi="";
$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$id_info=$_POST['id_info'];
$untuk=$_POST['untuk'];
$isi=$_POST['isi'];
$tgl=date("Y-m-d");
$submit=$_POST['submit'];


if ($submit=="Simpan"){

mysql_query("insert into info values('','$untuk','$tgl','$isi')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$id_info="";
$untuk="";
$isi="";


} else {

mysql_query("update info set untuk='$untuk',isi_info='$isi' where id_info='$id_info'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";

}
}




if (isset($_GET['id_info'])) {
$id_info=$_GET['id_info'];
$qry_info=mysql_query("select * from info where id_info='$id_info'");
$data_info=mysql_fetch_array($qry_info);
$id_info=$data_info[0];
$untuk=$data_info[1];
$isi=$data_info[3];

$submit="Update";
}
?>

<div class="content-module-heading cf">
	<h3 class="fl">Add Data Informasi</h3>
</div> <!-- end content-module-heading -->

<div class="content-module-main">

<center>
<?php
if ($pesan=="Sukses Tersimpan") {
?>
<div class="confirmation-box round" style="width:1080px;text-align:left;">Thank You, Your Data Success Saving.</div>
<?php
} elseif ($pesan=="Gagal Tersimpan") {
?>
<div class="error-box round" style="width:1080px;text-align:left;">Oops Sorry! Your Data Missed Saving, Please Try Again</div>
<?php
}
?>
</center>
<center>
<form action="index.php?target=input.info" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=left>
<legend>Konten Informasi</legend>
<table cellspacing=10 align=left>
<tr>
<td>Untuk * :</td>
</tr>
<tr>
<td valign=top>
<input type="hidden" name="id_info" value="<?php echo $id_info; ?>">
<select name="untuk" class="round text_kecil">
	<option value="" <?php if ($untuk==""){ echo "selected"; } ?>>-- Untuk --</option>
	<option value="dosen" <?php if ($untuk=="dosen"){ echo "selected"; } ?>>Dosen</option>
	<option value="mahasiswa" <?php if ($untuk=="mahasiswa"){ echo "selected"; } ?>>Mahasiswa</option>
</select>
</td>
</tr>
<tr>
<td>Isi Informasi* :</td>
</tr>
<tr>
<td>
<textarea id="area1" cols="130" rows="15" placeholder="Masukkan Isi Informasi" name="isi"><?php echo $isi; ?></textarea>
</td>
</tr>
</table>
</fieldset>
<br>

<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=center>
<legend>Simpan Data Info</legend>
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