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
$kode_kelas="";
$nama="";
$angkatan="";
$kd_konsentrasi="";

$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$kode_kelas=$_POST['kode_kelas'];
$nama=$_POST['nama'];
$id_ta=$_POST['id_ta'];
$angkatan=$_POST['angkatan'];
$kd_konsentrasi=$_POST['kd_konsentrasi'];
$submit=$_POST['submit'];


if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from ruang_kelas where nm_kelas='$nama'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Nama Kelas Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} else {
mysql_query("insert into ruang_kelas values('','$kd_konsentrasi','$id_ta','$angkatan','$nama')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$kode_kelas="";
$nama="";
$angkatan="";
$kd_konsentrasi="";
}

} else {

mysql_query("update ruang_kelas set nm_kelas='$nama',angkatan='$angkatan',kd_konsentrasi='$kd_konsentrasi' where id_kelas='$kode_kelas'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
}
}



if (isset($_GET['kode_kelas'])) {
$kode_kelas=$_GET['kode_kelas'];
$qry_kelas=mysql_query("select * from ruang_kelas where id_kelas='$kode_kelas'");
$data_kelas=mysql_fetch_array($qry_kelas);
$kode_kelas=$data_kelas[0];
$nama=$data_kelas[4];
$id_ta=$data_kelas[2];
$angkatan=$data_kelas[3];
$kd_konsentrasi=$data_kelas[1];

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
<form action="index.php?target=look.kelas" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:5px;font-size:16px;">
<legend>Input Data Kelas</legend>
<table cellspacing=10 align=left>
<tr>
<td>Tahun Ajaran * :</td>
<td>Angkatan * :</td>
<td>Program Studi * :</td>
<td>Nama Kelas * :</td>
<tr>
<td><input type="hidden" name="kode_kelas" placeholder="Masukkan Kode" class="round text_kecil" autofocus required value="<?php echo $kode_kelas; ?>">
<?php
$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_thn=mysql_fetch_array($qry_thn);
?>
<input type="hidden" name="id_ta" value="<?php echo $data_thn[0]; ?>">
<?php echo $data_thn[1]; ?>
</td>
<td>
	<select class="round text_medium" required name="angkatan">
				<option value="">[ -- Pilih Angkatan -- ]</option>
				<?php
					$qry_angkatan=mysql_query("select thn_msk from mahasiswa GROUP BY thn_msk HAVING count(*) > 0 order by(thn_msk) asc");
					while($data_angkatan=mysql_fetch_array($qry_angkatan)){
				?>
				<option value="<?php echo $data_angkatan[0]; ?>" <?php if ($angkatan=="$data_angkatan[0]"){ echo "selected"; }?>><?php echo $data_angkatan[0]; ?></option>	
				<?php		
					}
				?>
	</select>
</td>
<td>
	<select class="round text_medium" name="kd_konsentrasi" required>
				<option value="">[ -- Pilih Program Studi -- ]</option>
				<?php
					$qry_prodi=mysql_query("select * from konsentrasi");
					while($data_prodi=mysql_fetch_array($qry_prodi)){
				?>
					<option value="<?php echo $data_prodi[0]; ?>" <?php if ($kd_konsentrasi=="$data_prodi[0]"){ echo "selected"; } ?>><?php echo $data_prodi[2]; ?></option>
				<?php		
					}
				?>
	</select>
</td>
<td><input type="text" name="nama" class="round text_medium" placeholder="Masukkan Nama Kelas" required value="<?php echo $nama; ?>"></td>
<td valign=top><input type="submit" class="round blue ic-right-arrow" value="<?php echo $submit; ?>" name="submit"></td>
<td valign=top><input type="submit" class="round blue image-right ic-refresh text-upper" value="Batal"></td>
</tr>
</table>
</fieldset>
<br>
</form>
</center>
