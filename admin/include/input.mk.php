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
$kode_mk="";
$nama="";
$sks="";
$semester="";
$ket="";

$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$kode_mk=$_POST['kode_mk'];
$nama=$_POST['nama'];
$sks=$_POST['sks'];
$semester=$_POST['semester'];
$ket=$_POST['ket'];
$submit=$_POST['submit'];


if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from mata_kuliah where kd_mk='$kode_mk'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Kode Matakuliah Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} else {
mysql_query("insert into mata_kuliah values('$kode_mk','$nama','$sks','$semester','$ket')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$kode_mk="";
$nama="";
$sks="";
$semester="";
$ket="";
}

} else {

mysql_query("update mata_kuliah set nama_mk='$nama',sks='$sks',semester='$semester',ket='$ket' where kd_mk='$kode_mk'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
}
}



if (isset($_GET['kode_mk'])) {
$kode_mk=$_GET['kode_mk'];
$qry_mk=mysql_query("select * from mata_kuliah where kd_mk='$kode_mk'");
$data_mk=mysql_fetch_array($qry_mk);
$kode_mk=$data_mk[0];
$nama=$data_mk[1];
$sks=$data_mk[2];
$semester=$data_mk[3];
$ket=$data_mk[4];

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
<form action="index.php?target=look.mk" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:5px;font-size:16px;">
<legend>Input Data Matakuliah</legend>
<table cellspacing=10 align=left>
<tr>
<td>Kode * :</td>
<td>Nama Matakuliah * :</td>
<td>SKS * :</td>
<td>Semester * :</td>
<td>Keterangan * :</td>
<tr>
<td valign=top><input type="text" name="kode_mk" placeholder="Masukkan Kode" class="round text_kecil" autofocus required value="<?php echo $kode_mk; ?>"></td>
<td valign=top><input type="text" name="nama" class="round text_besar" placeholder="Masukkan Nama Matakuliah" required value="<?php echo $nama; ?>"></td>
<td valign=top><input type="text" name="sks" class="round text_kecil" placeholder="Masukkan SKS" required value="<?php echo $sks; ?>"></td>
<td><input type="radio" name="semester" required value="Ganjil" <?php if ($semester=="Ganjil"){ echo "checked";} ?>>Ganjil <br><input type="radio" name="semester" required value="Genap" <?php if ($semester=="Genap") { echo "checked"; } ?>>Genap</td>
<td><input type="radio" name="ket" required value="Wajib" <?php if ($ket=="Wajib"){ echo "checked";} ?>>Wajib <br><input type="radio" name="ket" required value="Tidak" <?php if ($ket=="Tidak") { echo "checked"; } ?>>Tidak</td>
<td><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
<br>
</form>
</center>
