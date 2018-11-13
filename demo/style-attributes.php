<?php

require __DIR__ . '/_config.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    // Each cell with each style attributes
    ->addRow([
        'Percentage', 
        '10%', 
        ['value'=>'content', 'style'=> [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFF0000']
            ],
            'alignment' => ['horizontal' => 'right'],
            'borders' => [
                'top' => ['borderStyle' => 'thin'],
            ],
            'fill' => [
                'fillType' => 'linear',
                'rotation' => 90,
                'startColor' => ['argb' => 'FFA0A0A0'],
                'endColor' => ['argb' => 'FFFFFFFF'],
            ],
        ]],
        ['value'=>'10000', 'style'=> [
            'numberFormat' => [
                'formatCode' => '#,##0',
            ],
        ]],
    ])
    // Row with thousands separator format style
    ->addRow(['1000', '2000', '3000', '4000'], ['style' => [
        'numberFormat' => [
            // const FORMAT_NUMBER_COMMA_SEPARATED1 = '#,##0.00';
            'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ],
    ]]) 
    // Row with percentage format style
    ->addRow(['0.1', '0.15', '0.3145', '0.855'], ['style' => [
        'numberFormat' => [
            // const FORMAT_PERCENTAGE_00 = '0.00%';
            'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00,
        ],
    ]]) 
    ->output();