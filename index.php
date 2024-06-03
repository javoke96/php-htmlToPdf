<?php

require_once __DIR__ . '/vendor/autoload.php';

use mikehaertl\wkhtmlto\Pdf;


// $html = file_get_contents('https://bakuenergyforum.az/e_ticket_en_example.html');
$htmlFile = './public/index.html';
$html = file_get_contents($htmlFile);

if($html != false){

  //Modify ticket info
  $html = str_replace('1234567890', '123456789', $html);
  $html = str_replace('Test Testov', 'Test Test', $html);
  $html = str_replace('TESTER', 'Tester', $html);
  $html = str_replace('TEST LLC', 'TEST MMC', $html);


  $pdf = new Pdf(array(
      'no-outline',
      'margin-top'    => 0,
      'margin-right'  => 0,
      'margin-bottom' => 0,
      'margin-left'   => 0,
      'disable-smart-shrinking'
  ));

  // $pdf->binary = '/usr/local/bin/wkhtmltopdf --enable-local-file-access';
  $pdf->binary = './libs/wkhtmltopdf --enable-local-file-access';

  $pdf->addPage($html);

  //Save
  // if (!$pdf->send('output.pdf')) {
  //     $error = $pdf->getError();
  //     die($error);
  // }

  //Preview
  if (!$pdf->send()) {
      $error = $pdf->getError();
      die($error);
  }

}

?>
