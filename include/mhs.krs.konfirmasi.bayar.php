<style>
.tesx{
padding:10px;width:50%;border-radius:10px;border:1px solid #aaa;
}

.tesx:focus{
padding:10px;width:50%;border-radius:10px;border:1px solid #ccc;;
}

.tabb tr:hover td{
background:pink;
}
</style>
<?php
if (isset($_POST['submit'])){
$nim=$_SESSION['sesiusername'];
$no_bayar=$_POST['no_bayar'];
$qry_kon=mysql_query("select * from konfirmasi_bayar where nim='$nim' and no_bayar='$no_bayar'");
$jum_kon=mysql_num_rows($qry_kon);
if ($jum_kon>0){
		mysql_query("update konfirmasi_bayar set status='acc' where no_bayar='$no_bayar' and nim='$nim'");
		echo "<script>alert('Terima Kasih Atas Konfirmasi Pembayarannya')</script>";
		echo '<meta http-equiv="refresh" content="0;url=index.php?target=mhs.krs" />';
} else {
		echo "<script>alert('Maaf Nomor Pembayaran Anda Salah')</script>";
}

}
?>
<br>
<br>
<center>
<h2>Silahkan Anda Memasukkan Nomor Pembayaran Anda Yang Valid Untuk Melakukan Pengisian Kartu Rencana Studi (KRS) Secara Online Disistem Kami!</h2>
<br>
<?php
$qry_thn=mysql_query("select * from thn_ajaran order by(id_ta) desc LIMIT 1");
$data_thn=mysql_fetch_array($qry_thn);
?>
<h2>Tahun Ajaran <?php echo $data_thn[1]; ?></h2>
<div style="margin-top:10px;">
<form action="index.php?target=mhs.krs" method="post">
<table width=100% align=center>
<tr>
<td align=center>
<input type="text" name="no_bayar" placeholder="Masukkan Nomor Pembayaran Anda . . ." required autofocus class="tesx">
</td>
</tr>
<tr>
<td align=center style="padding:10px;">
<input type="submit" name="submit" value="Kirim Verifikasi" class="button scrolly">
</td>
</tr>
</table>
</form>
</div>
</center>
<br>