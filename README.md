PHPSpreadsheet Helper
======================

PHP Excel Helper - Write and read Spreadsheet with easy way based on PhpSpreadsheet

[![Latest Stable Version](https://poser.pugx.org/yidas/phpspreadsheet-helper/v/stable?format=flat-square)](https://packagist.org/packages/yidas/phpspreadsheet-helper)
[![License](https://poser.pugx.org/yidas/phpspreadsheet-helper/license?format=flat-square)](https://packagist.org/packages/yidas/phpspreadsheet-helper)

This library is a helper that encapsulate [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) ([Documentation](https://phpspreadsheet.readthedocs.io/en/develop/)) for simple usage.

---

OUTLINE
-------

* [Demonstration](#demonstration)
* [Installation](#installation)
* [Requirements](#requirements)
* [Usage](#usage)
  - [Import & Export](#import--export)
    - [newSpreadsheet()](#newspreadsheet)
    - [output()](#output)
    - [save()](#save)
  - [Get Rows](#get-rows)
    - [getRow()](#getrow)
    - [getRows()](#getrows)
  - [Add Rows](#add-rows)
    - [addRow()](#addrow)
    - [addRows()](#addrows)
    - [Attributes](#attributes)
  - [PhpSpreadsheet Original Usage Integration](#phpspreadsheet-original-usage-integration)
    - [Inject PhpSpreadsheet](#inject-phpspreadsheet)
    - [Extract PhpSpreadsheet](#extract-phpspreadsheet)
  - [Merge Cells](#merge-cells)
  - [Multiple Sheets](#multiple-sheets)
    - [setSheet()](#setsheet)
    - [getSheet()](#getsheet)
  - [Map of Coordinates & Ranges](#multiple-sheets)
  - [Style Attributes](#style-attributes)
  - [Columns Format](#columns-format)
  - [All Cells Format](#all-cells-format)
    - [setStyle()](#setstyle)
    - [setWrapText()](#setwraptext)
    - [setAutoSize()](#setautosize)
- [Limitations](#limitations)
  - [Performance Issue](#performance-issue)

---

DEMONSTRATION
-------------

### Write to Excel

Output an Excel file to browser for download:

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['ID', 'Name', 'Email'])
    ->addRows([
        ['1', 'Nick','myintaer@gmail.com'],
        ['2', 'Eric','eric@.....'],
    ])
    ->output('My Excel');
```

<img src="https://raw.githubusercontent.com/yidas/phpspreadsheet-helper/master/img/demonstration.png" /> 

### Read from Excel

Import above excel file and return two-dimensional array data contained rows > columns spread sheet:

```php
$data = \yidas\phpSpreadsheet\Helper::newSpreadsheet('/tmp/My Excel.xlsx')
    ->getRows();
    
print_r($data);
```

Output result:

```
Array
(
    [0] => Array
        (
            [0] => ID
            [1] => Name
            [2] => Email
        )

    [1] => Array
        (
            [0] => 1
            [1] => Nick
            [2] => myintaer@gmail.com
        )

    [2] => Array
        (
            [0] => 2
            [1] => Eric
            [2] => eric@.....
        )

)
```

---

REQUIREMENTS
------------

This library requires the following:

- Dependent on [PhpSpreadsheet](https://phpspreadsheet.readthedocs.io/en/develop/#software-requirements)
  - PHP 5.6.0+
  - PHP extension php-zip enabled
  - PHP extension php-xml enabled
  - PHP extension php-gd2 enabled (if not compiled in)

---

INSTALLATION
------------

Run Composer in your project:

    composer require yidas/phpspreadsheet-helper
    
Then you could call it after Composer is loaded depended on your PHP framework:

```php
require __DIR__ . '/vendor/autoload.php';

\yidas\phpSpreadsheet\Helper::newSpreadsheet();
```
    
---

USAGE
-----

### Import & Export

Simpliy read an Excel file then output to browser:

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet('/tmp/excel.xlsx')
    ->addRow(['Modified A1'])
    ->output();
```

#### newSpreadsheet()

New or load an PhpSpreadsheet object

```php
public static array newSpreadsheet(object|string $spreadSheet=null)
```

#### output()

Output file to browser

```php
public static void output(string $filename='excel', string $format='Xlsx')
```

*`$format` list: `Xlsx`, `Xls`, `Html`, `Csv`, `Ods`*

#### save()

Save as file

```php
public static string save(string $filename='excel', string $format='Xlsx')
```

*Example:*

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['Add A1'])
    ->save("/tmp/save");
// /tmp/save.xlsx
```

### Get Rows

#### getRow()

Get data of a row from the actived sheet of PhpSpreadsheet

```php
public static array getRow(boolean $toString=true, array $options=[], callable $callback=null)
```

*Example:*

```php
use \yidas\phpSpreadsheet\Helper;

$row1 = Helper::newSpreadsheet($filepath)
    ->getRow();

$row2 = Helper::getRow();

print_r($row1);
print_r($row2);
```

*Example of fetching content per each row ([Example Code](https://github.com/yidas/phpspreadsheet-helper/blob/master/demo/get-row-loop.php)):*

```php
$helper = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath);

while ($row = $helper->getRow()) {
    // Each row data process
}
```

#### getRows()

Get rows from the actived sheet of PhpSpreadsheet

```php
public static array getRows(boolean $toString=true, array $options=[], callable $callback=null)
```

*[Example of getRows()](#read-from-excel)*


### Add Rows

#### addRow()

Add a row to the actived sheet of PhpSpreadsheet

```php
public static self addRow(array $rowData, array $rowAttributes=null)
```

*`$rowData` value: An array contains string or [array of attributes](#attributes) for each cell*  
*`$rowAttributes` value: string or [array of attributes](#attributes) for each cell of a row*

*[Example of addRow()](#write-to-excel)*

*Example of setting attributes for each cell:*

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow([['value'=>'ID'], ['value'=>'Name'], ['value'=>'Email']])
    ->addRow(['ID', 'Name', 'Email']);
```

*Example of setting attributes for each row:*

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    // Set width as 25 to all cells of this row
    ->addRow([['value'=>'ID'], ['value'=>'Name'], ['value'=>'Email']], ['width'=>25]);
```

#### addRows()

Add rows to the actived sheet of PhpSpreadsheet

```php
public static self addRows(array $data, array $rowAttributes=null)
```

*`$data` value: array of each $rowData from `addRow()`*  
*`$rowAttributes` value: string or [array of attributes](#attributes) for each row*

*[Example of addRows()](#write-to-excel)*

#### Attributes

Attributes is a standard array for defining a cell or even a row, the keys are as follows:

`key`, `value`, [`col`](#merge-cells), [`row`](#merge-cells), [`skip`](#merge-cells),  [`width`](#columns-format), [`style`](#style-attribute)

### PhpSpreadsheet Original Usage Integration

This helper is flexible that you could inject or extract original PhpSpreadsheet with it, when you need to manipulate some Phpspreadsheet methods integrated with Helper.

#### Inject PhpSpreadsheet

```php
// Get a new PhpSpreadsheet object
$objSpreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet;
$objSpreadsheet->getProperties()
    ->setCreator("Nick Tsai")
    ->setTitle("Office 2007 XLSX Document");
    
// Get the actived sheet object from PhpSpreadsheet
$objSheet = $objSpreadsheet->setActiveSheetIndex(0);
$objSheet->setTitle('Sheet');
$objSheet->setCellValue('A1', 'SN');

// Inject PhpSpreadsheet Object and Sheet Object to Helper
\yidas\phpSpreadsheet\Helper::newSpreadsheet($objSpreadsheet)
    ->setSheet($objSheet)
    ->setRowOffset(1) // Point to 1nd row from 0
    ->addRows([
        ['1'],
        ['2'],
    ])
    ->output();
```

#### Extract PhpSpreadsheet

```php
use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'Sheet')
    ->addRow(['SN']);
    
// Get the PhpSpreadsheet object created by Helper
$objSpreadsheet = Helper::getSpreadsheet();
$objSpreadsheet->getProperties()
    ->setCreator("Nick Tsai")
    ->setTitle("Office 2007 XLSX Document");
    
// Get the actived sheet object created by Helper
$objSheet = Helper::getSheet();
$objSheet->setCellValue('A2', '1');
$objSheet->setCellValue('A3', '2');

Helper::output();
```

### Merge Cells

It's easy to merge cells by defining each cell's span attributes:

- `row` : Number of rowspan cells to merge with  
- `col` : Number of colspan cells to merge with  
- `skip` : Number of colspan cells to merge with  

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRows([
        [['value'=>'SN', 'row'=>2], ['value'=>'Language', 'col'=>2], ['value'=>'Block', 'row'=>2, 'col'=>2]],
        ['','English','繁體中文',['skip'=>2]],
    ])
    ->addRows([
        ['1', 'Computer','電腦','#15'],
        ['2', 'Phone','手機','#4','#62'],
    ])
    ->output('Merged Excel');
```

### Multiple Sheets

#### setSheet()

Set an active PhpSpreadsheet Sheet

```php
public static self setSheet($sheet=0, $title=NULL, $normalizeTitle=false)
```

#### getSheet()

Get PhpSpreadsheet Sheet object from cache

```php
public static object getSheet($identity=null, $autoCreate=false)
```

*Example:*

```php
use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
    
// Set another sheet object without giving index 
Helper::setSheet(null, '2nd Sheet')
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);
    
// Get a sheet which does not exsit with auto creating it  
$obj = Helper::getSheet('3nd Sheet', true);

// Set a sheet with the title which has been auto-normalized
Helper::setSheet(null, '*This [sheet] name has been auto-nomalizing', true)
    ->addRow(['Sheet Index', 'Sheet Count'])
    ->addRows([
        [Helper::getActiveSheetIndex(), Helper::getSheetCount()],
    ]);

Helper::output('MultiSheets');
```

* `getActiveSheetIndex()`: Get active sheet index
* `getSheetCount()`: Get sheet count

### Map of Coordinates & Ranges

```php
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
```

The result could be:

```
Array
(
    [sn] => A1
    [lang] => B1
    [block] => D1
    [lang-en] => B2
    [lang-zh] => C2
    [block-skip] => D2
)
Array
(
    [sn] => A1:A2
    [lang] => B1:C1
    [block] => D1:E2
    [lang-en] => B2:B2
    [lang-zh] => C2:C2
    [block-skip] => D2:E2
)
sn start cell: A1
sn start column: A
sn start row: 1
sn range: A1:A2
All range: A1:E4
```

### Style Attributes

The style attribute could be set on a [single cell](#addrow), a [single row](#addrow) or even a [range of cells](#setstyle).

* `style`: a attribute refers to `applyFromArray()` for styling

```php
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
```

> Style array key/value/constant refers [Valid array keys for style `applyFromArray()`](https://phpspreadsheet.readthedocs.io/en/develop/topics/recipes/#valid-array-keys-for-style-applyfromarray) or [Source Classes](https://github.com/PHPOffice/PhpSpreadsheet/tree/master/src/PhpSpreadsheet/Style)

### Columns Format

The options for each cell data:

* `width`: setWidth() for the column

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow([['value'=>'ID', 'width'=>10], ['value'=>'Name', 'width'=>25], ['value'=>'Email', 'width'=>50]])
    ->addRows([
        ['1', 'Nick','myintaer@gmail.com'],
        ['2', 'Eric','eric@.....'],
    ])
    ->output('My Excel'); 
```

### All Cells Format

This section focuses on applying all actived cells or ranged cells on the sheet, not just effecting single cell, row or column.

#### setStyle()

Set Style for all actived cells or set by giving range to the actived sheet

```php
public static self setStyle(array $styleArray, string $range=NULL)
```

*Example:*

```php
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
    ->setStyle([
        'borders' => [
            'inside' => ['borderStyle' => 'hair'],
            'outline' => ['borderStyle' => 'thin'],
        ],
        'fill' => [
            'fillType' => 'solid',
            'startColor' => ['argb' => 'FFCCCCCC'],
        ],
    ])
    ->output('Formatted Excel');  
```

#### setWrapText()

Set WrapText for all actived cells or set by giving range to the actived sheet

```php
public static self setWrapText(string $range=NULL, string $value=true)
```

#### setAutoSize()

Set AutoSize for all actived cells or set by giving column range to the actived sheet

```php
public static self setAutoSize(string $colAlphaStart=NULL, string $colAlphaEnd=NULL, boolean $value=true)
```

---

LIMITATIONS
-----------

### Performance Issue

If you're building large cell data with XLSX, you may face performance issue with memory usage and execution time.

[box/spout](https://github.com/box/spout) spreadsheet lirary supports building Excel file with high performance, you could use this library instead if you do not need more style and formatting requirements.




