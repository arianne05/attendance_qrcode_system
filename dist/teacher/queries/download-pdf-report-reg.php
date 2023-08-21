<?php
    include '../../connection/db_conn.php';
    require '../../dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
    
    
    if (!empty($date_from) && empty($date_to)) {
      $date = $date_from;
    }

    if (!empty($date_from) && !empty($date_to)) { //WHEN BOTH DATE IS SELECTED
        $date = $date_from.'-'.$date_to;
    }

    if (empty($date_from) && empty($date_to)) { //WHEN BOTH DATE IS EMPTY
        $date = 'all';
    }

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    ob_start();

    if(isset($_GET['totalReg'])){
        require('../profile/reports-view-pdf-reg.php');
    }
    if(isset($_GET['totalAtt'])){
        require('../profile/reports-view-pdf-att.php');
    }
    if(isset($_GET['totalSec'])){
        require('../profile/reports-view-pdf-sec.php');
    }
    
    $html = ob_get_contents();
    ob_get_clean();
  
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream($date. '-user.pdf', ['Attachment' => false]);
?>
