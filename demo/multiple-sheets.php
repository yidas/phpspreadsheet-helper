<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
// Set another sheet object  
Helper::setSheet(1, '2nd Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
// Set a sheet with the title which has been auto-normalized
Helper::setSheet(2, '*This [sheet] name has been auto-nomalizing', true)
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);

Helper::output('MultiSheets');