<br>
<h2>Social Media Page</h2>
<?php
	$user=$_SESSION['sesiusername'];	
	$qry=mysql_query("select * from mahasiswa where nim='$user'");
	$data_user=mysql_fetch_array($qry);
	
	if ($data_user[13]==""){
		$foto="user.gif";
	} else {	
		$foto="$data_user[13]";
	}
	
	if (isset($_POST['submit'])){
		$status=$_POST['status'];
		$nim=$_POST['nim'];
		$tgl=date("Y-m-d");
		$jam=date("H:i:s");
		//mysql_query("update status_post set baca='y' where id_status!=''");
		mysql_query("insert into status_post values('','$nim','$tgl','$jam','$status','y')");
	}	
	
	mysql_query("update status_post set baca='y' where nim='$user'");
?>	
<br>
What's On Your Mind
<br>
<div style="float:left;width:10%;margin-right:10px;">
<img src="admin/foto/<?php echo $foto; ?>" style="border:1px solid #ccc;padding:5px;width:100%;margin-bottom:5px;">
</div>
<div style="float:right;width:87%">
<table>
<form method="post" action="index.php?target=mhs.social.media">
<tr>
<td>
<input type="hidden" name="nim" value="<?php echo $user; ?>">
<textarea name="status" style="width:100%;height:10%;" required></textarea>
</td>
</tr>
<tr>
<td><input type="submit" name="submit" value="Post"></td>
</tr>
</form>
</table>
</div>
<div style="clear:both;">
</div>
<div style="width:100%">
<table>
<tr style="border-bottom:2px solid #aaa;">
<td align=center width=20%><a href="index.php?target=mhs.social.media">Home</a></td>
<td align=center width=20%><a href="index.php?target=mhs.social.media&hal=wall">My Wall</a></td>
<td align=center width=20%><a href="index.php?target=mhs.social.media&hal=friends">Friends</a></td>
<td align=center width=20%>
<div id="kepala">
<span id="pesan">
Message
<span id="notifikasi"></span>
</span>
</div>
<div id="info">
    <div id="loading"><br>Loading...<img src="images/loading.gif"></div>
    <div id="konten-info">
    </div>
</div>
</td>
<td align=center width=20%>
<div id="kepala1">
<span id="pesan1">
Notification
<span id="notifikasi1"></span>
</span>
</div>
<div id="info1">
    <div id="loading1"><br>Loading...<img src="images/loading.gif"></div>
    <div id="konten-info1">
    </div>
</div>
</td>
</tr>
</table>
<?php
if (!isset($_GET['hal'])){
	include "mhs.beranda.social.php";
} else {
$hal=$_GET['hal'];
	if ($hal=="wall"){
		include "mhs.wall.social.php";
	} else if ($hal=="friends"){
		include "mhs.friends.social.php";
	}
}
?>
</div>
<br>
<br>