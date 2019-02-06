# FolderDB
[![Version](https://img.shields.io/packagist/v/irfan-dahir/folderdb.svg?style=flat)](https://packagist.org/packages/irfan-dahir/folderdb) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![stable](https://img.shields.io/badge/PHP-^%207.1-blue.svg?style=flat)]() [![MIT License](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)


FolderDB is a flat-file JSON database. It creates directories which represents a "Collection". 

It saves data into those directories as files with key/value pairs in JSON format. The "key" is the file name where the "value" is the JSON document.

## Installation
1. `composer require irfan-dahir/folderdb`
2. Copy `.env.example` to `.env` and configure the directory that will act as the database.

## Example

### Getting Started
```php
require_once __DIR__ .'/vendor/autoload.php';

// Create a client and pass the path to the .env
$client = new \FolderDb\Client('/var/www/folderdb/.env');
```


### Create a Folder
```php
$collection = new \FolderDb\Folder(
    \FolderDb\Factory\FolderFactory::create('name')
);
```

### Insert data
```php
$data = [
  'foo' => 'bar',
  'baz' => true,
  'number' => 1
];

// `new \FolderDb\Document()` takes string directly
$document = \FolderDb\Document::fromArray($data);

$collection->insert('key', $document); // `\FolderDb\FileFactory`
$collection->insert('key2', $document); // `\FolderDb\FileFactory`
```

### Count
```php
echo $collection->count(); // 2
```

### Fetch data
```php
$data = $collection->get('key'); // returns `\FolderDb\Document`

// Access your entry as an object
echo $data->object->foo; // "bar"

// Access your entry as an array
$data = $data->object->toArray();
echo $data['foo']; // "bar"
```

### Delete "Collection"
⚠️ This method **deletes** the "Collection" **folder** and it's contents. ⚠️
```php
$collection->delete(); // true
```

#### Dependencies
- **symfony/dotenv** is used for database configuration.


#### Issues
Please create an issue for any bugs/security risks/etc