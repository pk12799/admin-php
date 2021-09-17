<?php

require 'vendor/autoload.php';


use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html = '<b> hi </b>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation


// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
