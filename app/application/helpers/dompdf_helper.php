<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;


function pdf_create($html, $filename='', $stream=TRUE)
{


    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
?>