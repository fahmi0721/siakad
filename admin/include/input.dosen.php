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
$id_dosen="";
$nidn="";
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$kota_asal="";
$kode_pos="";
$alamat="";
$no_telpon="";
$email="";
$nip_pns="";
$jabatan_struktural="";
$jabatan_fungsional="";
$ikatan_kerja="";
$pt_induk="";
$homebase="";
$gol="";
$status_ajar="";
$pendidikan_akhir="";
$asal_s1="";
$prodi_s1="";
$gelar_s1="";
$asal_s2="";
$prodi_s2="";
$gelar_s2="";
$asal_s3="";
$prodi_s3="";
$gelar_s3="";
$photo="";
$submit="Simpan";
$pesan="";


if (isset($_POST['submit'])) {
$id_dosen=$_POST['id_dosen'];
$nidn=$_POST['nidn'];
$nama=$_POST['nama'];
$jenkel=$_POST['jenkel'];
$tmp_lahir=$_POST['tmp_lahir'];
$tgl_lahir=$_POST['tgl_lahir'];
$agama=$_POST['agama'];
$kota_asal=$_POST['kota_asal'];
$kode_pos=$_POST['kode_pos'];
$alamat=$_POST['alamat'];
$no_telpon=$_POST['no_telpon'];
$email=$_POST['email'];
$nip_pns=$_POST['nip_pns'];
$jabatan_struktural=$_POST['jabatan_struktural'];
$jabatan_fungsional=$_POST['jabatan_fungsional'];
$ikatan_kerja=$_POST['ikatan_kerja'];
$pt_induk=$_POST['pt_induk'];
$homebase=$_POST['homebase'];
$gol=$_POST['gol'];
$status_ajar=$_POST['status_ajar'];
$pendidikan_akhir=$_POST['pendidikan_akhir'];
$asal_s1=$_POST['asal_s1'];
$prodi_s1=$_POST['prodi_s1'];
$gelar_s1=$_POST['gelar_s1'];
$asal_s2=$_POST['asal_s2'];
$prodi_s2=$_POST['prodi_s2'];
$gelar_s2=$_POST['gelar_s2'];
$asal_s3=$_POST['asal_s3'];
$prodi_s3=$_POST['prodi_s3'];
$gelar_s3=$_POST['gelar_s3'];
$fotoSem=$_FILES ["foto"]["tmp_name"];
$submit=$_POST['submit'];

if($fotoSem!=""){
$photo=$_FILES ["foto"]["name"];
}else{
$photo=$_POST['fotolama'];
}

if ($submit=="Simpan"){
$qry_cek=mysql_query("select * from dosen where id_dosen='$id_dosen'");
$jum_cek=mysql_num_rows($qry_cek);
if ($jum_cek>0) {
echo "<script>alert ('Maaf Data Gagal Diinputkan, Id Dosen Telah Ada Sebelumnya')</script>";
$pesan="Gagal Tersimpan";


} elseif (empty($fotoSem)) {
$foto="";
mysql_query("insert into dosen values('$id_dosen','$nidn','$nama','$alamat','$tgl_lahir','$tmp_lahir','$agama','$jenkel','$no_telpon','$email','$jabatan_fungsional','$status_ajar','$ikatan_kerja','$pt_induk','$homebase','$nip_pns','$gol','$kota_asal','$kode_pos','$jabatan_struktural','$asal_s1','$prodi_s1','$gelar_s1','$asal_s2','$prodi_s2','$gelar_s2','$asal_s3','$prodi_s3','$gelar_s3','$pendidikan_akhir','$foto')");
mysql_query("insert into user('$id_dosen','$id_dosen','dosen','0')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$id_dosen="";
$nidn="";
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$kota_asal="";
$kode_pos="";
$alamat="";
$no_telpon="";
$email="";
$nip_pns="";
$jabatan_struktural="";
$jabatan_fungsional="";
$ikatan_kerja="";
$pt_induk="";
$homebase="";
$gol="";
$status_ajar="";
$pendidikan_akhir="";
$asal_s1="";
$prodi_s1="";
$gelar_s1="";
$asal_s2="";
$prodi_s2="";
$gelar_s2="";
$asal_s3="";
$prodi_s3="";
$gelar_s3="";
$photo="";
} else {
$foto=$_FILES ["foto"]["name"];

$info = pathinfo($foto);
if($info['extension'] == 'jpg' || $info['extension'] == 'gif' || $info['extension'] == 'png' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg'){
$lokasi="foto/$foto";
copy ($fotoSem,$lokasi);
mysql_query("insert into dosen values('$id_dosen','$nidn','$nama','$alamat','$tgl_lahir','$tmp_lahir','$agama','$jenkel','$no_telpon','$email','$jabatan_fungsional','$status_ajar','$ikatan_kerja','$pt_induk','$homebase','$nip_pns','$gol','$kota_asal','$kode_pos','$jabatan_struktural','$asal_s1','$prodi_s1','$gelar_s1','$asal_s2','$prodi_s2','$gelar_s2','$asal_s3','$prodi_s3','$gelar_s3','$pendidikan_akhir','$foto')");
mysql_query("insert into user('$id_dosen','$id_dosen','dosen','0')");
echo "<script>alert ('Thank You Success Saving')</script>";
$pesan="Sukses Tersimpan";
$id_dosen="";
$nidn="";
$nama="";
$jenkel="";
$tmp_lahir="";
$tgl_lahir="";
$agama="";
$kota_asal="";
$kode_pos="";
$alamat="";
$no_telpon="";
$email="";
$nip_pns="";
$jabatan_struktural="";
$jabatan_fungsional="";
$ikatan_kerja="";
$pt_induk="";
$homebase="";
$gol="";
$status_ajar="";
$pendidikan_akhir="";
$asal_s1="";
$prodi_s1="";
$gelar_s1="";
$asal_s2="";
$prodi_s2="";
$gelar_s2="";
$asal_s3="";
$prodi_s3="";
$gelar_s3="";
} else {
echo "<script>alert ('Maaf Data Gagal Diinputkan, File Harus Berupa Gambar')</script>";
$pesan="Gagal Tersimpan";
}
}

} else {
$foto_lama=$_POST['fotolama'];



if (empty($fotoSem)) {
mysql_query("update dosen set id_dosen='$id_dosen',nidn='$nidn',nama='$nama',alamat='$alamat',tgl_lhr='$tgl_lahir',kota_lhr='$tmp_lahir',agama='$agama',sex='$jenkel',no_telp='$no_telpon',email='$email',jabatan='$jabatan_fungsional',status='$status_ajar',ikt_kerja='$ikatan_kerja',pt_induk='$pt_induk',homebase='$homebase',nip_pns='$nip_pns',gol='$gol',kota_asal='$kota_asal',kode_pos='$kode_pos',jabatan_struk='$jabatan_struktural',pt_s1='$asal_s1',prodi_s1='$prodi_s1',gelar_s1='$gelar_s1',pt_s2='$asal_s2',prodi_s2='$prodi_s2',gelar_s2='$gelar_s2',pt_s3='$asal_s3',prodi_s3='$prodi_s3',gelar_s3='$gelar_s3',pend_tinggi='$pendidikan_akhir' where id_dosen='$id_dosen'");
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

mysql_query("update dosen set id_dosen='$id_dosen',nidn='$nidn',nama='$nama',alamat='$alamat',tgl_lhr='$tgl_lahir',kota_lhr='$tmp_lahir',agama='$agama',sex='$jenkel',no_telp='$no_telpon',email='$email',jabatan='$jabatan_fungsional',status='$status_ajar',ikt_kerja='$ikatan_kerja',pt_induk='$pt_induk',homebase='$homebase',nip_pns='$nip_pns',gol='$gol',kota_asal='$kota_asal',kode_pos='$kode_pos',jabatan_struk='$jabatan_struktural',pt_s1='$asal_s1',prodi_s1='$prodi_s1',gelar_s1='$gelar_s1',pt_s2='$asal_s2',prodi_s2='$prodi_s2',gelar_s2='$gelar_s2',pt_s3='$asal_s3',prodi_s3='$prodi_s3',gelar_s3='$gelar_s3',pend_tinggi='$pendidikan_akhir',foto='$foto' where id_dosen='$id_dosen'");
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



if (isset($_GET['id_dosen'])) {
$id_dosen=$_GET['id_dosen'];
$qry_dsn=mysql_query("select * from dosen where id_dosen='$id_dosen'");
$data_dsn=mysql_fetch_array($qry_dsn);
$nidn=$data_dsn[1];
$nama=$data_dsn[2];
$jenkel=$data_dsn[7];
$tmp_lahir=$data_dsn[5];
$tgl_lahir=$data_dsn[4];
$agama=$data_dsn[6];
$kota_asal=$data_dsn[17];
$kode_pos=$data_dsn[18];
$alamat=$data_dsn[3];
$no_telpon=$data_dsn[8];
$email=$data_dsn[9];
$nip_pns=$data_dsn[15];
$jabatan_struktural=$data_dsn[19];
$jabatan_fungsional=$data_dsn[10];
$ikatan_kerja=$data_dsn[12];
$pt_induk=$data_dsn[13];
$homebase=$data_dsn[14];
$gol=$data_dsn[16];
$status_ajar=$data_dsn[11];
$pendidikan_akhir=$data_dsn[29];
$asal_s1=$data_dsn[20];
$prodi_s1=$data_dsn[21];
$gelar_s1=$data_dsn[22];
$asal_s2=$data_dsn[23];
$prodi_s2=$data_dsn[24];
$gelar_s2=$data_dsn[25];
$asal_s3=$data_dsn[26];
$prodi_s3=$data_dsn[27];
$gelar_s3=$data_dsn[28];
$photo=$data_dsn[30];

$submit="Update";
}
?>

<div class="content-module-heading cf">
	<h3 class="fl">Add Data Dosen</h3>
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
<form action="index.php?target=input.dosen" method="post" enctype="multipart/form-data">
<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=left>
<legend>Profile Data</legend>
<table cellspacing=10 align=left>
<tr>
<td>Id Dosen * :</td>
<td>Nidn :</td>
<td>Nama * :</td>
<td width=10></td>
<td>Photo :</td>
<tr>
<td valign=top><input type="text" name="id_dosen" placeholder="Masukkan Id Dosen" class="round default-width-input" autofocus required value="<?php echo $id_dosen; ?>"></td>
<td valign=top><input type="text" name="nidn" class="round text_medium" placeholder="Masukkan Nidn" value="<?php echo $nidn; ?>"></td>
<td valign=top><input type="text" name="nama" class="round text_besar" placeholder="Masukkan Nama Lengkap" required value="<?php echo $nama; ?>"></td>
<td></td>
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
<td>Kota Asal :</td>
<td>Kode Pos :</td>
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
<td><input type="text" name="kota_asal" class="round text_kecil" placeholder="Kota Asal" value="<?php echo $kota_asal; ?>"></td>
<td><input type="text" name="kode_pos" class="round text_kecil" placeholder="Kode Pos" value="<?php echo $kode_pos; ?>"></td>
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
<legend>Data Status Pekerjaan</legend>
<table cellspacing=10 align=left>
<tr>
<td>NIP PNS :</td>
<td>Jabatan Struktural :</td>
<td>Jabatan Fungsional :</td>
<td>Ikatan Kerja * :</td>
</tr>
<tr>
<td><input type="text" name="nip_pns" class="round text_medium" placeholder="Masukkan Nip PNS" value="<?php echo $nip_pns; ?>"></td>
<td><input type="text" name="jabatan_struktural" class="round text_besar" placeholder="Masukkan Jabatan Struktural" value="<?php echo $jabatan_struktural; ?>"></td>
<td><input type="text" name="jabatan_fungsional" class="round text_besar" placeholder="Masukkan Jabatan Fungsional" value="<?php echo $jabatan_fungsional; ?>"></td>
<td>
<select name="ikatan_kerja" class="round text_kecil" required>
<option value="" <?php if ($ikatan_kerja=="") { echo "selected"; } ?>>--Pilih--</option>
<option value="Dosen Tetap" <?php if ($ikatan_kerja=="Dosen Tetap") { echo "selected"; } ?>>Dosen Tetap</option>
<option value="Dosen DPK" <?php if ($ikatan_kerja=="Dosen DPK") { echo "selected"; } ?>>Dosen DPK</option>
<option value="Dosen LB" <?php if ($ikatan_kerja=="Dosen LB") { echo "selected"; } ?>>Dosen LB</option>
</select>
</td>
</tr>
</table>
<table cellspacing=10 align=left>
<tr>
<td>Perguruan Tinggi Induk * :</td>
<td>Homebase * :</td>
<td>Golongan :</td>
<td>Status Mengajar * :</td>
</tr>
<tr>
<td><input type="text" name="pt_induk" class="round text_besar" placeholder="Masukkan Perguruan Tinggi Induk" required value="<?php echo $pt_induk; ?>"></td>
<td>
<select name="homebase" class="round text_besar" required>
<?php
  $sql = "SELECT * FROM jurusan";
  $hasil = mysql_query($sql);
  if ($hasil)
  {
     print("<option value=\"\" selected=\"selected\">" .
           "-- Pilih --</option>\n");
           
     while ($baris1 = mysql_fetch_row($hasil))
     {
	 ?>
		<option value="<?php echo $baris1[0]; ?>" <?php if ($homebase=="$baris1[0]") { echo "selected"; } ?>><?php echo $baris1[1]; ?></option>
	 <?php	
     }        
     
  }
?>
</select>
</td>
<td>
<select name="gol" class="round text_kecil">
 <option value="" <?php if ($gol=="") { echo "selected"; } ?>>--Pilih Gol--</option>
 <option value="IIIA" <?php if ($gol=="IIIA") { echo "selected"; } ?>>IIIA</option>
 <option value="IIIB" <?php if ($gol=="IIIB") { echo "selected"; } ?>>IIIB</option>
 <option value="IIIC" <?php if ($gol=="IIIC") { echo "selected"; } ?>>IIIC</option>
 <option value="IVA" <?php if ($gol=="IVA") { echo "selected"; } ?>>IVA</option>
 <option value="IVB" <?php if ($gol=="IVB") { echo "selected"; } ?>>IVB</option>
 <option value="IVC" <?php if ($gol=="IVC") { echo "selected"; } ?>>IVC</option>
 <option value="IVD" <?php if ($gol=="IVD") { echo "selected"; } ?>>IVD</option>
 <option value="IVE" <?php if ($gol=="IVE") { echo "selected"; } ?>>IVE</option>
 </select>
</td>
<td>
<select name="status_ajar" class="round text_medium" required>
 <option value="" <?php if ($status_ajar=="") { echo "selected"; } ?>>--Pilih--</option>
 <option value="Aktif Mengajar" <?php if ($status_ajar=="Aktif Mengajar") { echo "selected"; } ?>>Aktif Mengajar</option>
 <option value="Tidak Aktif Mengajar" <?php if ($status_ajar=="Tidak Aktif Mengajar") { echo "selected"; } ?>>Tidak Aktif Mengajar</option>
 <option value="Cuti" <?php if ($status_ajar=="Cuti") { echo "selected"; } ?>>Cuti</option>
</select>
</td>
</tr>
</table>
</fieldset>

<br>

<fieldset style="border:1px solid #ccc;border-radius:5px;color:#4a8bc2;padding:10px;font-size:16px;width:1100px;" align=center>
<legend>Data Pendidikan</legend>
<div id="main">
    <div align=left>
        Pendidikan Terakhir :
        <select name="pendidikan_akhir" id="grup" class="round text_kecil">
            <option value="" <?php if ($pendidikan_akhir=="") { echo "selected"; } ?>>-- Pilih --</option>
            <option value="strata1" <?php if ($pendidikan_akhir=="strata1") { echo "selected"; } ?>>Strata 1</option>
            <option value="strata2" <?php if ($pendidikan_akhir=="strata2") { echo "selected"; } ?>>Strata 2</option>
            <option value="strata3" <?php if ($pendidikan_akhir=="strata3") { echo "selected"; } ?>>Strata 3</option>
        </select>
    </div>
    <div class="strata1_opts strata2_opts strata3_opts">
        <table cellspacing=10 align=left>
		<tr>
		<td>Asal Perguruan Tinggi S1 :</td>
		<td>Program Studi S1 :</td>
		<td>Gelar S1 :</td>
		</tr>
		<td><input type="text" name="asal_s1" class="round text_besar" placeholder="Masukkan Asal Perguruan Tinggi S1" value="<?php echo $asal_s1; ?>"></td>
		<td><input type="text" name="prodi_s1" class="round text_besar" placeholder="Masukkan Program Studi S1" value="<?php echo $prodi_s1; ?>"></td>
		<td><input type="text" name="gelar_s1" class="round text_medium" placeholder="Masukkan Gelar S1" value="<?php echo $gelar_s1; ?>"></td>
		</tr>
		</table>
    </div>
    <div class="strata2_opts strata3_opts">
        <table cellspacing=10 align=left>
		<tr>
		<td>Asal Perguruan Tinggi S2 :</td>
		<td>Program Studi S2 :</td>
		<td>Gelar S2 :</td>
		</tr>
		<tr>
		<td><input type="text" name="asal_s2" class="round text_besar" placeholder="Masukkan Asal Perguruan Tinggi S2" value="<?php echo $asal_s2; ?>"></td>
		<td><input type="text" name="prodi_s2" class="round text_besar" placeholder="Masukkan Program Studi S2" value="<?php echo $prodi_s2; ?>"></td>
		<td><input type="text" name="gelar_s2" class="round text_medium" placeholder="Masukkan Gelar S1" value="<?php echo $gelar_s2; ?>"></td>
		</tr>
		</table>
    </div>
    <div class="strata3_opts">
        <table cellspacing=10 align=left>
		<tr>
		<td>Asal Perguruan Tinggi S3 :</td>
		<td>Program Studi S3 :</td>
		<td>Gelar S3 :</td>
		</tr>
		<tr>
		<td><input type="text" name="asal_s3" class="round text_besar" placeholder="Masukkan Asal Perguruan Tinggi S3" value="<?php echo $asal_s3; ?>"></td>
		<td><input type="text" name="prodi_s3" class="round text_besar" placeholder="Masukkan Program Studi S3" value="<?php echo $prodi_s3; ?>"></td>
		<td><input type="text" name="gelar_s3" class="round text_medium" placeholder="Masukkan Gelar S1" value="<?php echo $gelar_s3; ?>">
		</tr>
		</tr>
		</table>
    </div>
</div>
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