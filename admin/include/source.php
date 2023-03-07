<?php
	include "../../connect.php";
	$req = "SELECT * FROM mahasiswa WHERE nim LIKE '".$_REQUEST['term']."%' or nama LIKE '".$_REQUEST['term']."%' "; 

	$query = mysql_query($req);

	while($row = mysql_fetch_array($query))
	{
		$results[] = array('label' => $row['nim']."-".$row['nama']);
	}
	echo json_encode($results);
?>