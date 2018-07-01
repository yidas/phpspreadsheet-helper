<?php

require __DIR__ . '/_config.php';

$spreadsheet = \yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->getSpreadsheet();

$arrayData = [
    [NULL, 2010, 2011, 2012],
    ['Q1',   12,   15,   21],
    ['Q2',   56,   73,   86],
    ['Q3',   52,   61,   69],
    ['Q4',   30,   32,    0],
];
$spreadsheet->getActiveSheet()
    ->fromArray($arrayData, NULL)
    ->fromArray(
        $arrayData,  // The data to set
        NULL,        // Top left coordinate of the worksheet range where
        'D5'         // we want to set these values (default is A1)
    );

\yidas\phpSpreadsheet\Helper::output();