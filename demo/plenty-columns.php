<?php

require __DIR__ . '/_config.php';

$row = [];
for ($i=1; $i <= 100 ; $i++) { 
    $value = \yidas\phpSpreadsheet\Helper::num2alpha($i);
    $row[] = $value;
}

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow($row)
    ->output();