<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

// Helper::setTimezone("Europe/London");
// echo Helper::getTimezone();

$filepath = __DIR__ . '/import.xlsx';

$row1 = Helper::newSpreadsheet($filepath)
    ->getRow();

$row2 = Helper::getRow();

print_r($row1);
print_r($row2);