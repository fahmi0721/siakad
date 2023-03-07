<script type="text/javascript">
function highlight_row(the_element) {
	if(the_element.parentNode.parentNode.style.backgroundColor != 'pink') {
		the_element.parentNode.parentNode.style.backgroundColor = 'pink';
	} else {
		the_element.parentNode.parentNode.style.backgroundColor = 'white';
	}
}
</script>

<!-- <script type="text/javascript">

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

</script> -->
<?php
if (isset($_POST['submit_krs'])){
include "mhs.krs.save.php";
} else {
	$nim=$_SESSION['sesiusername'];
	$qry_kon=mysql_query("select * from konfirmasi_bayar where nim='$nim'");
	$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
	$data_thn=mysql_fetch_array($qry_thn);
	$smstr=substr($data_thn[1],10,3);

		if ($smstr=="Gan"){
				$semester="Ganjil";
		} else {
				$semester="Genap";
		}
?>
<br>
<h2>Halaman Isian Kartu Rencana Studi (KRS)</h2>
<h3>Tahun Ajaran <?php echo $data_thn[1]; ?></h3>
<br>
<?php
$data_kon=mysql_fetch_array($qry_kon);
?>
<h4>Batas SKS yang dapat anda ambil adalah : <?php echo $data_kon[5]; ?> SKS</h4>
<br style="margin-top:-20px;">
<form name="myform" method="post" action="index.php?target=mhs.krs">
<table width=100% class="tabb">
<tr style="border-bottom:3px solid #aaa;">
	<th>No</th>
	<th>Kode</th>
	<th>Nama Matakuliah</th>
	<th>SKS</th>
	<th><!-- <input type="checkbox" name="pilih" onclick="pilihan()" /> --> Check</th>
</tr>
<?php
$no=1;
$qry_mhs=mysql_query("select * from mahasiswa where nim='$nim'",$db);
$data_mhs=mysql_fetch_array($qry_mhs);
$qry_prodi=mysql_query("select * from konsentrasi where kd_konsentrasi='$data_mhs[10]'",$db);
$data_prodi=mysql_fetch_array($qry_prodi);
$qry_r=mysql_query("select * from rel_kon_ma where kd_konsentrasi='$data_prodi[0]'",$db);
while($data_r=mysql_fetch_array($qry_r)){
$qry_mk=mysql_query("select * from mata_kuliah where semester='$semester' and kd_mk='$data_r[1]'");
while($data_mk=mysql_fetch_array($qry_mk)){
	$qry_krs_ambil=mysql_query("select * from krs where nim='$nim' and id_ta='$data_thn[0]' and kd_mk='$data_mk[0]'");
	$jum_krs_ambil=mysql_num_rows($qry_krs_ambil);
	
	if ($jum_krs_ambil==1){
		$ceklis="checked";
	} else {
		$ceklis="";
	}
	
	$qry_krs_sebelum=mysql_query("select * from krs where nim='$nim' and kd_mk='$data_mk[0]' and status='xacc'");
	$jum_krs_sebelum=mysql_num_rows($qry_krs_sebelum);
	if ($jum_krs_sebelum==0){
?>
<tr style="border-bottom:1px solid #aaa;">
	<td align="center"><?php echo $no; ?></td>
	<td align="center"><?php echo $data_mk[0]; ?></td>
	<td><?php echo $data_mk[1]; ?></td>
	<td align="center"><?php echo $data_mk[2]; ?></td>
	<td align="center"><input name="CekMk[]" type="checkbox" value="<?php echo $data_mk[0]; ?>" onclick="highlight_row(this)" <?php echo $ceklis; ?>></td>
</tr>
<?php
$no++;
}
}
}
?>
</table>
<input type="hidden" name="nim" value="<?php echo $nim; ?>">
<input type="hidden" name="id_ta" value="<?php echo $data_thn[0]; ?>">
<input type="hidden" name="batas_sks" value="<?php echo $data_kon[5]; ?>">
<input type="submit" name="submit_krs" value="Kirim Pengisian KRS" class="button scrolly">
<br>
<br>
</form>	
<?php
}
?>