<?php
session_start();
include "../connect.php";
$nim=$_SESSION['sesiusername'];
$pesan = mysql_query("SELECT * FROM message WHERE baca='belum' and untuk='$nim'");
$j = mysql_num_rows($pesan);
if($j>0){
?>    
	<table border=0 width=100% style="font-size:13px;">
<?php	
}else{
    die("<font color=red size=1>Tidak ada pesan baru yang belum dilihat</font>");
}
while($p = mysql_fetch_array($pesan)){
$pes=substr($p[5],0,20);
$qry_mhs=mysql_query("select * from mahasiswa where nim='$p[1]'");
$data_mhs=mysql_fetch_array($qry_mhs);
	
	if ($data_mhs[13]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_user[13]";
	}
?>
<tr>
<td onmouseover="this.style.backgroundColor='#ffedf0'" onmouseout="this.style.backgroundColor='#efefef'" style="padding:10px;font-size:16px;">
     <a href="index.php?target=view_order&id_transaksi=<?php echo $p[0]; ?>">
	 <img src="admin/foto/<?php echo $foto; ?>" width=10% height=15% align=left style="margin-right:5px;"> 
	 <?php echo $data_mhs[1]; ?>
	 <?php echo " : " .$pes; ?> . . .
	 </a>
</td>
</tr>
<?php	 
}
?>
<tr>
	<td align=center><a href="">Show All</a></td>
</tr>
</table>
