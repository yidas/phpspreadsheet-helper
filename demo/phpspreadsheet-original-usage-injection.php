<?php

require __DIR__ . '/_config.php';

// Get a new PhpSpreadsheet object
$objSpreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet;
$objSpreadsheet->getProperties()
    ->setCreator("Nick Tsai")
    ->setTitle("Office 2007 XLSX Document");
// Get the actived sheet object from PhpSpreadsheet
$objSheet = $objSpreadsheet->setActiveSheetIndex(0);
$objSheet->setTitle('Sheet');
$objSheet->setCellValue('A1', 'SN');
// Inject PhpSpreadsheet Object and Sheet Object to Helper
\yidas\phpSpreadsheet\Helper::newSpreadsheet($objSpreadsheet)
    ->setSheet($objSheet)
    ->setRowOffset(1) // Point to 1nd row from 0
    ->addRows([
        ['1'],
        ['2'],
    ]);
    
\yidas\phpSpreadsheet\Helper::output();
