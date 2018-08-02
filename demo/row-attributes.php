<?php

require __DIR__ . '/_config.php';

// Attribute setting for head row
$headRowAttributes = [
    'value' => 'Overrode Value', 
    'width' => 30,
    'style' => [
        'font' => [
            'bold' => true,
            'color' => ['argb' => 'FFFF0000'],
        ],
        'alignment' => ['horizontal' => 'center'],
        'borders' => [
            'top' => ['borderStyle' => 'thin'],
        ],
        'fill' => [
            'fillType' => 'linear',
            'rotation' => 90,
            'startColor' => ['argb' => 'FFA0A0A0'],
            'endColor' => ['argb' => 'FFFFFFFF'],
        ],
    ],
];

// Attribute setting for rows
$rowAttributes = [
    'value' => 'Row Value', 
    'style' => [
        'font' => [
            'color' => ['argb' => 'FF00FF00'],
        ],
        'alignment' => ['horizontal' => 'right'],
    ],
];

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow([
        'Self Value', 
        null,  // This value will be overridden by row value attribute
        ['value'=>'Self Value Attr'], 
        ['value'=>'Self Width', 'width'=>20], 
        ['value'=>'Empty Style', 'style'=>[]],
        [
            'value' => 'Self Style',
            'style' =>  [
                'font' => [
                    'color' => ['argb' => 'FF00FF00']
                ],
            ],
        ]
    ], $headRowAttributes)
    ->addRow([null, null, null, null], $rowAttributes)
    ->addRows([
        [null, null, null, null],
        [null, null, null, null],
    ], $rowAttributes)
    ->output();