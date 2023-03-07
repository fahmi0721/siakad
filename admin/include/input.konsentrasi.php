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
$kode_konsentrasi="";
$jurusan="";
$nama="";

$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$kode_konsentrasi=$_POST['kode_konsentrasi'];
$jurusan=$_POST['jurusan'];
$nama=$_POST['nama'];
$submit=$_POST['submit'];


if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from konsentrasi where kd_konsentrasi='$kode_konsentrasi'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Kode Konsentrasi Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} else {
mysql_query("insert into konsentrasi values('$kode_konsentrasi','$jurusan','$nama')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$kode_konsentrasi="";
$jurusan="";
$nama="";
}

} else {

mysql_query("update konsentrasi set kd_jurusan='$jurusan', nm_konsentrasi='$nama' where kd_konsentrasi='$kode_konsentrasi'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
}
}



if (isset($_GET['kode_konsentrasi'])) {
$kode_konsentrasi=$_GET['kode_konsentrasi'];
$qry_konsentrasi=mysql_query("select * from konsentrasi where kd_konsentrasi='$kode_konsentrasi'");
$data_konsentrasi=mysql_fetch_array($qry_konsentrasi);
$kode_konsentrasi=$data_konsentrasi[0];
$jurusan=$data_konsentrasi[1];
$nama=$data_konsentrasi[2];

$submit="Update";
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
<form action="index.php?target=look.konsentrasi" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:5px;font-size:16px;">
<legend>Input Data Konsentrasi</legend>
<table cellspacing=10 align=left>
<tr>
<td>Kode * :</td>
<td>Nama Jurusan * :</td>
<td>Nama Konsentrasi * :</td>
<tr>
<td><input type="text" name="kode_konsentrasi" placeholder="Masukkan Kode" class="round text_kecil" autofocus required value="<?php echo $kode_konsentrasi; ?>"></td>
<td>
<select required data-placeholder="Kode Jurusan  |  Nama Jurusan" class="round text_medium" name="jurusan">
	<?php
		$sql1 = "SELECT * FROM jurusan";
		$hasil1 = mysql_query($sql1);
		if ($hasil1)
		{
	?>
			<option value="">--Pilih Jurusan--</option>
			<?php		
			while ($data1 = mysql_fetch_row($hasil1))
			{
			?>
			<option value="<?php echo $data1[0]; ?>" <?php if ($jurusan==$data1[0]) { echo"selected";}?>><?php echo $data1[0]." - ".$data1[1]; ?></option>
			<?php
			}        
		}
			?>
</select>
</td>
<td><input type="text" name="nama" class="round text_besar" placeholder="Masukkan Nama Konsentrasi" required value="<?php echo $nama; ?>"></td>
<td valign=top><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td valign=top><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
<br>
</form>
</center>