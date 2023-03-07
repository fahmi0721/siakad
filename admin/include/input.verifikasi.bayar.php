<link href='css/chosen.css' rel='stylesheet'>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/jquery.chosen.min.js"></script>
	<script src="js/jquery.uniform.min.js"></script>
	<script src="js/jquery.cleditor.min.js"></script>
	<script src="js/jquery.history.js"></script>
	<script src="js/charisma.js"></script>
<style type='text/css'>
.strata1_opts, .strata2_opts, .strata3_opts {
    display: none;
}

.strata1 .strata1_opts, .strata2 .strata2_opts, .strata3 .strata3_opts{
    display: block;
}
</style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
function changeGroup(e) {
    /*
        1 - Remove all group classes
        2 - Add the currently selected group class
    */
    $("#main")
        .removeClass(allGroups)
        .addClass($("option:selected", e.target).val())
}

/* 
    1 - Bind changeGroup function to "change" event
    2 - Fetch all group from the select field 
*/
var allGroups = $("#grup")
    .change(changeGroup)
    .find("option")
        .map(function() {
            return $(this).val();
        })
        .get()
        .join(' ');
});//]]>  

</script>

<?php
$nim="";
$no_bayar="";
$batas_sks="";
$read="";

$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$kode_bayar=$_POST['kode_bayar'];
$thn_ajaran=$_POST['thn_ajaran'];
$nim=$_POST['nim'];
$no_bayar=$_POST['no_bayar'];
$batas_sks=$_POST['batas_sks'];
$submit=$_POST['submit'];

if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from konfirmasi_bayar where nim='$nim' and id_ta='$thn_ajaran' or no_bayar='$no_bayar'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Data Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} else {
mysql_query("insert into konfirmasi_bayar values('','$nim','$thn_ajaran','$no_bayar','pending','$batas_sks','no')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$kode_bayar="";
$nim="";
$no_bayar="";
$batas_sks="";
}

} else {

mysql_query("update konfirmasi_bayar set no_bayar='$no_bayar',batas_sks='$batas_sks' where id_bayar='$kode_bayar'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
}
}



if (isset($_GET['kode_bayar'])) {
$kode_bayar=$_GET['kode_bayar'];
$qry_bayar=mysql_query("select * from konfirmasi_bayar where id_bayar='$kode_bayar'");
$data_bayar=mysql_fetch_array($qry_bayar);
$kode_bayar=$data_bayar[0];
$nim=$data_bayar[1];
$no_bayar=$data_bayar[3];
$batas_sks=$data_bayar[5];

$submit="Update";

if ($data_bayar[4]=="acc"){
	$read="readonly";
} else {
	$read="";
}

}
?>

<center>
<?php
if ($pesan=="Sukses Tersimpan") {
?>
<div class="confirmation-box round" style="text-align:left;">Thank You, Your Data Success Saving.</div>
<?php
} elseif ($pesan=="Gagal Tersimpan") {
?>
<div class="error-box round" style="text-align:left;">Oops Sorry! Your Data Missed Saving, Please Try Again</div>
<?php
}
?>
</center>
<center>
<form action="index.php?target=look.verifikasi.bayar" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:5px;font-size:16px;">
<legend>Input Data Pembayaran</legend>
<table cellspacing=10 align=left>
<tr>
<?php
$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_thn=mysql_fetch_array($qry_thn);
?>
<td>Tahun Ajaran  :</td>
<td>Pilih Mahasiswa * :</td>
<td>No Pembayaran * :</td>
<td>Batas SKS * :</td>
<tr>
<td>
<b><?php echo $data_thn[1]; ?></b><input type="hidden" name="thn_ajaran" class="round text_kecil" value="<?php echo $data_thn[0]; ?>">
<input type="hidden" name="kode_bayar" class="round text_kecil" value="<?php echo $kode_bayar; ?>">
</td>
<td>
<select required data-placeholder="-- Pilih [ Nim  |  Nama Mahasiswa ] --" id="selectError2" data-rel="chosen"  class="round text_medium" name="nim" style="width:280px;" <?php if (isset($_GET['kode_bayar'])){ echo "readonly";  }?>>
	<?php
		$sql1 = "SELECT * FROM mahasiswa";
		$hasil1 = mysql_query($sql1);
		if ($hasil1)
		{
	?>
			<option value=""></option>
			<?php		
			while ($data1 = mysql_fetch_row($hasil1))
			{
			?>
			<option value="<?php echo $data1[0]; ?>" <?php if ($nim==$data1[0]) { echo"selected";}?>><?php echo $data1[0]." - ".$data1[1]; ?></option>
			<?php
			}        
		}
			?>
</select>
</td>
<td>
<input type="text" name="no_bayar" class="round text_besar" placeholder="Masukkan Nomor Pembayaran" required value="<?php echo $no_bayar; ?>" <?php echo $read; ?>>
</td>
<td><input type="text" name="batas_sks" class="round text_kecil" placeholder="Masukkan Batas SKS" required value="<?php echo $batas_sks; ?>"></td>
<td valign=top><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td valign=top><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
<br>
</form>
</center>