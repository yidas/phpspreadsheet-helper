<?php

require __DIR__ . '/_config.php';

$filepath = __DIR__ . '/test.xlsx';

$data = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath)
    ->getRows();

print_r($data);