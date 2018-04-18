<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['ID', 'Name'])
    ->addRows([
        ['1', 'Nick'],
    ]);
// Set another sheet object  
Helper::setSheet(1, '2nd Sheet')
    ->addRow(['SN', 'Title'])
    ->addRows([
        ['1', 'Foo'],
    ]);
// Set a sheet with the title which has been auto-normalized
Helper::setSheet(2, '*This [sheet] name has been auto-nomalizing', true)
    ->addRow(['ID', 'Text'])
    ->addRows([
        ['1', 'Bar'],
    ]);

Helper::output('MultiSheets');