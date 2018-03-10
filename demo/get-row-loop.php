<?php

require __DIR__ . '/_config.php';

$filepath = __DIR__ . '/import.xlsx';

$helper = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath);

// Attribute Keys for database table schema
$attrKeys = ['sn', 'value', 'number', 'tag', 'datetime'];

$headRow = $helper->getRow(); // Skip head row
$count = 0;
// The method which process per each row
while ($row = $helper->getRow()) {
    // Each row data
    $count++;
    $attr = [];
    foreach ($attrKeys as $key => $attrKey) {
        $attr[$attrKey] = $row[$key];
    }
    echo "{$count}st row data with attributes format:";
    print_r($attr);
    echo "<br/>";
}

?>