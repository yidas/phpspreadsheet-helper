<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['ID', 'Name'])
    ->addRows([
        ['1', 'Nick'],
    ]);
// Set another sheet object and switch to it    
Helper::setSheet(1, '2nd Sheet')
    ->addRow(['SN', 'Title'])
    ->addRows([
        ['1', 'Foo'],
    ]);

Helper::output('MultiSheets');