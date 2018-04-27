<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
// Set another sheet object without giving index 
Helper::setSheet(null, '2nd Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
// Get a sheet which does not exsit with auto creating it  
$obj = Helper::getSheet('3nd Sheet', true);
// Set a sheet with the title which has been auto-normalized
Helper::setSheet(null, '*This [sheet] name has been auto-nomalizing', true)
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);

Helper::output('MultiSheets');