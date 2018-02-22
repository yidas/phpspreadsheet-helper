<?php

require __DIR__ . '/_config.php';

use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->addRows([
        [
            ['value'=>'SN', 'row'=>2, 'key'=>'sn'], 
            ['value'=>'Language', 'col'=>2, 'key'=>'lang'], 
            ['value'=>'Block', 'row'=>2, 'col'=>2, 'key'=>'block'],
        ],
        [   
            '',
            ['value'=>'English', 'key'=>'lang-en'],
            ['value'=>'繁體中文', 'key'=>'lang-zh'],
            ['skip'=>2, 'key'=>'block-skip'],
        ],
    ])
    ->addRows([
        ['1', 'Computer','電腦','#15'],
        ['2', 'Phone','手機','#4','#62'],
    ]);
// ->output('Merged Excel');  

print_r(Helper::getCoordinateMap());
print_r(Helper::getRangeMap());
// print_r(Helper::getColumnMap());
// print_r(Helper::getRowMap());
echo "sn start cell: ". Helper::getCoordinateMap('sn');
echo "\nsn start column: ". Helper::getColumnMap('sn');
echo "\nsn start row: ". Helper::getRowMap('sn');
echo "\nsn range: ". Helper::getRangeMap('sn');
echo "\nAll range: ". Helper::getRangeAll(); 