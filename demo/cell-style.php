<?php

require __DIR__ . '/_config.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['Percentage', '10%', 
        ['value'=>'content', 'style'=> 
            [
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
            ]
        ]
    ])
    ->output();