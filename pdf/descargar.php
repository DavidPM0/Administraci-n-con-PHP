<?php
    ob_start();
    include "./reporte.php";
    $html = ob_get_clean();
    require_once '../library/dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("Reporte.pdf", array("Attachment" => true));
?>