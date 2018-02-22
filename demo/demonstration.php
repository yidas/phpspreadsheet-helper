<?php

require __DIR__ . '/_config.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['ID', 'Name', 'Email'])
    ->addRows([
        ['1', 'Nick','myintaer@gmail.com'],
        ['2', 'Eric','eric@.....'],
    ])
    ->output('My Excel');