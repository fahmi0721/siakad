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
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$alamat="";
$no_telpon="";
$email="";
$thn_masuk="";
$jurusan="";
$status="";
$asal_sekolah="";
$photo="";
$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$nim=$_POST['nim'];
$nama=$_POST['nama'];
$jenkel=$_POST['jenkel'];
$tmp_lahir=$_POST['tmp_lahir'];
$tgl_lahir=$_POST['tgl_lahir'];
$agama=$_POST['agama'];
$alamat=$_POST['alamat'];
$no_telpon=$_POST['no_telpon'];
$email=$_POST['email'];
$thn_masuk=$_POST['thn_masuk'];
$jurusan=$_POST['jurusan'];
$status=$_POST['status'];
$asal_sekolah=$_POST['asal_sekolah'];
$fotoSem=$_FILES ["foto"]["tmp_name"];
$submit=$_POST['submit'];

if($fotoSem!=""){
$photo=$_FILES ["foto"]["name"];
}else{
$photo=$_POST['fotolama'];
}

if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from mahasiswa where nim='$nim'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Nim Mahasiswa Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} elseif (empty($fotoSem)) {
$foto="";
mysql_query("insert into mahasiswa values('$nim','$nama','$alamat','$tgl_lahir','$tmp_lahir','$agama','$jenkel','$no_telpon','$email','$thn_masuk','$jurusan','$status','$asal_sekolah','$foto')");
mysql_query("insert into user('$nim','$nim','mahasiswa','0')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$nim="";
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$alamat="";
$no_telpon="";
$email="";
$thn_masuk="";
$jurusan="";
$status="";
$asal_sekolah="";
} else {
$foto=$_FILES ["foto"]["name"];

$info = pathinfo($foto);
if($info['extension'] == 'jpg' || $info['extension'] == 'gif' || $info['extension'] == 'png' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg'){
$lokasi="foto/$foto";
copy ($fotoSem,$lokasi);
mysql_query("insert into mahasiswa values('$nim','$nama','$alamat','$tgl_lahir','$tmp_lahir','$agama','$jenkel','$no_telpon','$email','$thn_masuk','$jurusan','$status','$asal_sekolah','$foto')");
mysql_query("insert into user('$nim','$nim','mahasiswa','0')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$nim="";
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$alamat="";
$no_telpon="";
$email="";
$thn_masuk="";
$jurusan="";
$status="";
$asal_sekolah="";
$photo="";
} else {
echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa Gambar')</script>";
$pesan="Gagal Tersimpan";
}
}

} else {
$foto_lama=$_POST['fotolama'];



if (empty($fotoSem)) {
mysql_query("update mahasiswa set nim='$nim',nama='$nama',alamat='$alamat',tgl_lhr='$tgl_lahir',kota_lhr='$tmp_lahir',agama='$agama',sex='$jenkel',no_telp='$no_telpon',email='$email',thn_msk='$thn_masuk',kd_konsentrasi='$jurusan',status='$status',asal_sklh='$asal_sekolah' where nim='$nim'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";
} else {
$foto=$_FILES ["foto"]["name"];
$info = pathinfo($foto);
if($info['extension'] == 'jpg' || $info['extension'] == 'gif' || $info['extension'] == 'png' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg'){

if ($foto_lama!=""){
unlink("foto/$foto_lama");
}

$lokasi="foto/$foto";
copy ($fotoSem,$lokasi);

mysql_query("update mahasiswa set nim='$nim',nama='$nama',alamat='$alamat',tgl_lhr='$tgl_lahir',kota_lhr='$tmp_lahir',agama='$agama',sex='$jenkel',no_telp='$no_telpon',email='$email',thn_msk='$thn_masuk',kd_konsentrasi='$jurusan',status='$status',asal_sklh='$asal_sekolah',foto='$foto' where nim='$nim'");
echo "<script>alert ('Thank You Success For Update Data')</script>";
$pesan="Sukses Tersimpan";

} else {
$photo=$_POST['fotolama'];
echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa Gambar')</script>";
$pesan="Gagal Tersimpan";
}
}
}
}



if (isset($_GET['nim'])) {
$nim=$_GET['nim'];
$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'");
$data_mhs=mysql_fetch_array($qry_mhs);
$nim=$data_mhs[0];
$nama=$data_mhs[1];
$jenkel=$data_mhs[6];
$tmp_lahir=$data_mhs[4];
$tgl_lahir=$data_mhs[3];
$agama=$data_mhs[5];
$alamat=$data_mhs[2];
$no_telpon=$data_mhs[7];
$email=$data_mhs[8];
$thn_masuk=$data_mhs[9];
$jurusan=$data_mhs[10];
$status=$data_mhs[11];
$asal_sekolah=$data_mhs[12];
$photo=$data_mhs[13];

$submit="Update";
}
?>

<div class="content-module-heading cf">
	<h3 class="fl">Add Data Mahasiswa</h3>
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
<form action="index.php?target=input.mhs" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=left>
<legend>Profile Data</legend>
<table cellspacing=10 align=left>
<tr>
<td>Nim * :</td>
<td>Nama * :</td>
<td width=10></td>
<td>Photo :</td>
<tr>
<td valign=top><input type="text" name="nim" placeholder="Masukkan Nim Mahasiswa" class="round default-width-input" autofocus required value="<?php echo $nim; ?>"></td>
<td valign=top><input type="text" name="nama" class="round text_besar" placeholder="Masukkan Nama Lengkap" required value="<?php echo $nama; ?>"></td>
<td width=230></td>
<td>
<?php
if ($photo==""){
?>
<img src="foto/user.gif" style="border:1px solid #ccc;padding:5px;border-radius:5px;width:200px;height:230px;">
<?php
} else {
?>
<img src="foto/<?php echo $photo; ?>" style="border:1px solid #ccc;padding:5px;border-radius:5px;width:200px;height:230px;">
<?php
}
?>
<br>
<div style="border-radius:5px;border:1px solid #ccc;padding:5px;">
<input type="file" name="foto" size="30" class="text" multiple style="overflow:hidden;width:200px;"> 
<input type="hidden" name="fotolama" value="<?php echo $photo; ?>">
</div>
</td>
</tr>
</table>
<table cellspacing=10 align=left style="margin-top:-230px;">
<tr>
<td>Jenis Kelamin * :</td>
<td>Tempat Lahir/Tanggal Lahir * :</td>
<td valign=top>Agama * :</td>
</tr>
<tr>
<td><input type="radio" name="jenkel" required value="Pria" <?php if ($jenkel=="Pria"){ echo "checked";} ?>>Pria &nbsp;&nbsp;<input type="radio" name="jenkel" required value="Wanita" <?php if ($jenkel=="Wanita") { echo "checked"; } ?>>Wanita</td>
<td><input type="text" name="tmp_lahir" class="round text_medium" placeholder="Masukkan Tempat Lahir" required value="<?php echo $tmp_lahir; ?>"> <input type="text" placeholder="Tanggal Lahir" id="datepicker1" name="tgl_lahir" class="round text_kecil" required value="<?php echo $tgl_lahir; ?>"></td>
<td valign=top>
<select name="agama" class="round text_kecil" placeholder="Masukkan Agama" required>
<option value="" <?php if ($agama=="") { echo "selected"; } ?>>--Pilih Agama--</option>
<option value="Islam" <?php if ($agama=="Islam") { echo "selected"; } ?>>Islam</option>
<option value="Kristen" <?php if ($agama=="Kristen") { echo "selected"; } ?>>Kristen</option>
<option value="Hindu" <?php if ($agama=="Hindu") { echo "selected"; } ?>>Hindu</option>
<option value="Budha" <?php if ($agama=="Budha") { echo "selected"; } ?>>Budha</option>
</select>
</td>
</tr>
</table>
<table cellspacing=10 align=left style="margin-top:-142px;">
<tr>
<td valign=top>Alamat * :</td>
<td valign=top>Nomor Telpon dan Email * :</td>
</tr>
<tr>
<td><textarea name="alamat" class="round area-besar" placeholder="Masukkan Alamat" required><?php echo $alamat; ?></textarea></td>
<td valign=top><input type="text" name="no_telpon" class="round text_medium" placeholder="Masukkan Nomor Telpon" required value="<?php echo $no_telpon; ?>">
<br>
<br>
<input type="email" name="email" class="round text_besar" placeholder="Masukkan Email" required value="<?php echo $email; ?>"></td>
<td width=0>

</td>
<td style="border-radius:10px;padding:9px;border:1px solid #ccc;">
Keterangan :
<br>
* : Harus Di isi
</td>
</tr>
</table>
</fieldset>

<br>

<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=center>
<legend>Data Akademik</legend>
<table cellspacing=10 align=left>
<tr>
<td>Tahun Masuk * :</td>
<td>Jurusan/Prodi * :</td>
<td>Status Akademik * :</td>
<td>Asal Sekolah :</td>
</tr>
<tr>
<td><input type="text" name="thn_masuk" class="round text_medium" placeholder="Masukkan Tahun Masuk" value="<?php echo $thn_masuk; ?>" required></td>
<td>
<select name="jurusan" class="round text_besar" required>
<?php
  $sql = "SELECT * FROM konsentrasi";
  $hasil = mysql_query($sql);
  if ($hasil)
  {
     print("<option value=\"\" selected=\"selected\">" .
           "-- Pilih --</option>\n");
           
     while ($baris1 = mysql_fetch_row($hasil))
     {
	 ?>
		<option value="<?php echo $baris1[0]; ?>" <?php if ($jurusan=="$baris1[0]") { echo "selected"; } ?>><?php echo $baris1[2]; ?></option>
	 <?php	
     }        
     
  }
?>
</select>
</td>
<td>
<select name="status" class="round text_kecil" required>
<option value="" <?php if ($status=="") { echo "selected"; } ?>>--Pilih--</option>
<option value="Aktif" <?php if ($status=="Aktif") { echo "selected"; } ?>>Aktif</option>
<option value="Cuti" <?php if ($status=="Cuti") { echo "selected"; } ?>>Cuti</option>
</select>
</td>
<td><input type="text" name="asal_sekolah" class="round text_besar" placeholder="Masukkan Asal Sekolah" value="<?php echo $asal_sekolah; ?>"></td>
</tr>
</table>
</fieldset>

<br>

<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=center>
<legend>Simpan Data Dosen</legend>
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