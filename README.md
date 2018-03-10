PHPSpreadsheet Helper
======================

PHP Excel Helper - Read, Create and Write Spreadsheet with easy way based on PhpSpreadsheet

[![Latest Stable Version](https://poser.pugx.org/yidas/phpspreadsheet-helper/v/stable?format=flat-square)](https://packagist.org/packages/yidas/phpspreadsheet-helper)
[![Latest Unstable Version](https://poser.pugx.org/yidas/phpspreadsheet-helper/v/unstable?format=flat-square)](https://packagist.org/packages/yidas/phpspreadsheet-helper)
[![License](https://poser.pugx.org/yidas/phpspreadsheet-helper/license?format=flat-square)](https://packagist.org/packages/yidas/phpspreadsheet-helper)

This library is a helper that encapsulate [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) for simple usage.

---

OUTLINE
-------

* [DEMONSTRATION](#demonstration)

* [INSTALLATION](#installation)

* [USAGE](#usage)
  - [Read & Write](#read--write)
    - [save()](#save)
  - [Get Rows](#get-rows)
    - [getRow()](#getrow)
    - [getRows()](#getrows)
  - [Add Rows](#add-rows)
    - [addRow()](#addrow)
    - [addRows()](#addrows)
  - [PhpSpreadsheet Original Usage Injection](#phpspreadsheet-original-usage-injection)
  - [Merge Cells](#merge-cells)
  - [Multiple Sheets](#multiple-sheets)
  - [Map of Coordinates & Ranges](#multiple-sheets)
  - [Cells Format](#cells-format)

---

DEMONSTRATION
-------------

### Write

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['ID', 'Name', 'Email'])
    ->addRows([
        ['1', 'Nick','myintaer@gmail.com'],
        ['2', 'Eric','eric@.....'],
    ])
    ->output('My Excel');
```

## Read

```php
$data = \yidas\phpSpreadsheet\Helper::newSpreadsheet('/tmp/excel.xlsx')
    ->getRows();
    
print_r($data);
```

Return two-dimensional array data contained rows > columns spread sheet.

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

### Read & Write

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet('/tmp/excel.xlsx')
    ->addRow(['Modified A1'])
    ->output();
```

#### `save()`

Save as file

```php
\yidas\phpSpreadsheet\Helper::newSpreadsheet()
    ->addRow(['Add A1'])
    ->save("/tmp/save");
// /tmp/save.xlsx
```

### Get Rows

#### `getRow()`

Get data of a row from the actived sheet of PhpSpreadsheet

```php
$row1 = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath)
    ->getRow();

$row2 = Helper::getRow();

print_r($row1);
print_r($row2);
```

The method which process per each row:

```php
$helper = \yidas\phpSpreadsheet\Helper::newSpreadsheet($filepath);

while ($row = $helper->getRow()) {
    // Each row data process
}
```

#### `getRows()`

Get rows from the actived sheet of PhpSpreadsheet

[getRows() Example code](#read)


### Add Rows

#### `addRow()`

Add a row to the actived sheet of PhpSpreadsheet

[addRow() Example code](#write)

#### `addRows()`

Add rows to the actived sheet of PhpSpreadsheet

[addRows() Example code](#write)


### PhpSpreadsheet Original Usage Injection

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
    ]);
    
\yidas\phpSpreadsheet\Helper::output();
```

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

```php
use \yidas\phpSpreadsheet\Helper;

Helper::newSpreadsheet()
    ->setSheet(0, 'First Sheet')
    ->addRow(['ID', 'Name'])
    ->addRows([
        ['1', 'Nick'],
    ]);
// Set another sheet object and switch to it    
Helper::setSheet(1, '2nd Sheet')
    ->addRow(['SN', 'Title'])
    ->addRows([
        ['1', 'Foo'],
    ]);

Helper::output('MultiSheets');
```

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

### Cells Format

* setWrapText(): Set to all cells by default
* setAutoSize(): Set to all cells(columns) by default

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
    ->output('Formatted Excel');  
```
