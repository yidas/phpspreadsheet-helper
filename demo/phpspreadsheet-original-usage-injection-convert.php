<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'Sheet')
    ->addRow(['SN']);
// Get the PhpSpreadsheet object created by Helper
$objPHPExcel = Helper::getExcel();
$objPHPExcel->getProperties()
    ->setCreator("Nick Tsai")
    ->setTitle("Office 2007 XLSX Document");
// Get the actived sheet object created by Helper
$objPHPExcelSheet = Helper::getSheet();
$objPHPExcelSheet->setCellValue('A2', '1');
$objPHPExcelSheet->setCellValue('A3', '2');

Helper::output();