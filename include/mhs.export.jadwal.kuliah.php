<?php
include "../connect.php";
$nim=$_POST['nim'];
$id_ta=$_POST['id_ta'];
$qry_ta=mysql_query("select * from thn_ajaran where id_ta='$id_ta'");
$data_ta=mysql_fetch_array($qry_ta);

if (isset($_POST['pdf'])){
ob_start();
    include('mhs.data.jadwal.print.pdf.php');
    $content = ob_get_clean();
    require_once('../modulpdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Jadwal-'.$nim.'-'.$data_ta[1].'.pdf','D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else if(isset($_POST['word'])){
	header("Content-type: application/vnd-ms-word");
	header("Content-Disposition: attachment; filename=Jadwal-$nim.doc");
	include "mhs.data.jadwal.print.word.php";	
} 	
?>	