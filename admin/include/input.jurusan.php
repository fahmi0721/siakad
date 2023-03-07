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
$kode_jurusan="";
$nama="";

$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$kode_jurusan=$_POST['kode_jurusan'];
$nama=$_POST['nama'];
$submit=$_POST['submit'];


if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from jurusan where kd_jurusan='$kode_jurusan'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Kode Jurusan Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} else {
mysql_query("insert into jurusan values('$kode_jurusan','$nama')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$kode_jurusan="";
$nama="";
}

} else {

mysql_query("update jurusan set nm_jurusan='$nama' where kd_jurusan='$kode_jurusan'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
}
}



if (isset($_GET['kode_jurusan'])) {
$kode_jurusan=$_GET['kode_jurusan'];
$qry_jurusan=mysql_query("select * from jurusan where kd_jurusan='$kode_jurusan'");
$data_jurusan=mysql_fetch_array($qry_jurusan);
$kode_jurusan=$data_jurusan[0];
$nama=$data_jurusan[1];

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
<form action="index.php?target=look.jurusan" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:5px;font-size:16px;">
<legend>Input Data Jurusan</legend>
<table cellspacing=10 align=left>
<tr>
<td>Kode * :</td>
<td>Nama Jurusan * :</td>
<tr>
<td><input type="text" name="kode_jurusan" placeholder="Masukkan Kode" class="round text_kecil" autofocus required value="<?php echo $kode_jurusan; ?>"></td>
<td><input type="text" name="nama" class="round text_besar" placeholder="Masukkan Nama Jurusan" required value="<?php echo $nama; ?>"></td>
<td valign=top><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td valign=top><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
<br>
</form>
</center>
