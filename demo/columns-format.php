<?php

require __DIR__ . '/_config.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow([['value'=>'ID', 'width'=>10], ['value'=>'Name', 'width'=>25], ['value'=>'Email', 'width'=>50]])
    ->addRows([
        ['1', 'Nick','myintaer@gmail.com'],
        ['2', 'Eric','eric@.....'],
    ])
    ->output('My Excel');