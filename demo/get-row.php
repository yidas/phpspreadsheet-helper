<?php

require __DIR__ . '/_config.php';

$filepath = __DIR__ . '/import.xlsx';

$row1 = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath)
    ->getRow();

$row2 = Helper::getRow();

print_r($row1);
print_r($row2);