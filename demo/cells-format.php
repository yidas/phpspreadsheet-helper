<?php

require __DIR__ . '/_config.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['Title', 'Content'])
    ->addRows([
        ['Basic Plan', "*Interface\n*Search Tool"],
        ['Advanced Plan', "*Interface\n*Search Tool\n*Statistics"],
    ])
    ->setWrapText()
    // ->setWrapText('B2')
    ->setAutoSize()
    // ->setAutoSize('B')
    ->output('Formatted Excel');  