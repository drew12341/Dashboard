<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("phpwkhtmltopdf/src/Pdf.php");
use mikehaertl\wkhtmlto\Pdf;


function pdf_create($html)
{

// You can pass a filename, a HTML string, an URL or an options array to the constructor
    $pdf = new Pdf($html);

// On some systems you may have to set the path to the wkhtmltopdf executable
// $pdf->binary = 'C:\...';

//    if (!$pdf->saveAs('/path/to/page.pdf')) {
//        echo $pdf->getError();
//    }
    $pdf->send();
}
?>