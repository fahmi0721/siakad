<?php
include "../connect.php";
$nim=$_POST['nim'];

if (isset($_POST['pdf'])){
ob_start();
    include('mhs.data.transkrip.print.pdf.php');
    $content = ob_get_clean();
    require_once('../modulpdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Transkrip_nilai-'.$nim.'.pdf','D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else if(isset($_POST['word'])){
	header("Content-type: application/vnd-ms-word");
	header("Content-Disposition: attachment; filename=Transkrip_nilai-$nim.doc");
	include "mhs.data.transkrip.print.word.php";	
} 	
?>	