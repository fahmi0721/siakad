<?php
$qry_status=mysql_query("select * from status_post where nim='$user' order by(id_status) desc");
while($data_status=mysql_fetch_array($qry_status)){
	$qry_mhs=mysql_query("select * from mahasiswa where nim='$data_status[1]'");
	$data_mhs=mysql_fetch_array($qry_mhs);
	if ($data_mhs[13]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_mhs[13]";
	}
?>
<div style="width:10%;float:left">
	<a href=""><img src="admin/foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;"></a>
</div>
<div style="width:88%;float:right;">
	<a href=""><?php echo $data_mhs[1]; ?></a>
	<br>
	<?php echo $data_status[4]; ?>
</div>	
<div style="clear:both;margin-bottom:20px;">
</div>
<?php	
}
?>