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

$collection->insert('key', $data);
$collection->insert('key2', $data);
```

### Count
```php
echo $collection->count();
```

### Fetch data
```php
$data = $collection->get('key'); // returns `FolderDb\Document` object

// Access your entry as an object
echo $data->object->foo;

// Access your entry as an array
$data = $data->object->toArray();
echo $data['foo'];
```

### Delete "Collection"
⚠️ This method **deletes** the "Collection" **folder** and it's contents. ⚠️
```php
$collection->delete();
```

### Dependencies
- **symfony/dotenv** is used for database configuration.


### Issues
Please report any (security) issues