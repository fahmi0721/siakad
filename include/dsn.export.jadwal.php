<?php
include "../connect.php";
$id_dosen=$_POST['id_dosen'];
$id_ta=$_POST['id_ta'];
$qry_ta=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
$data_ta=mysql_fetch_array($qry_ta);

if (isset($_POST['pdf'])){
ob_start();
    include('dsn.data.jadwal.print.pdf.php');
    $content = ob_get_clean();
    require_once('../modulpdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Jadwal-'.$id_dosen.'-'.$data_ta[1].'.pdf','D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else if(isset($_POST['word'])){
	header("Content-type: application/vnd-ms-word");
	header("Content-Disposition: attachment; filename=Jadwal-$id_dosen.doc");
	include "dsn.data.jadwal.print.word.php";	
} 	
?>	