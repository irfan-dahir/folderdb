# FolderDB
[![Version](https://img.shields.io/packagist/v/irfan-dahir/folderdb.svg?style=flat)](https://packagist.org/packages/irfan-dahir/folderdb) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![stable](https://img.shields.io/badge/PHP-^%207.1-blue.svg?style=flat)]() [![MIT License](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)


FolderDB is a flat-file JSON database with functionality similar to MongoDB.

It saves data into directories as files with key/value pairs in JSON format. The "key" is the file name where the "value" is JSON data.

FolderDB uses magic methods to automatically create or manage "collections"/directories.


```composer require irfan-dahir/folderdb```

```php
$client->users->insert(
    'username',
    \FolderDb\Document::fromArray([
        'id' => '123',
        'first_name' => 'John',
        'last_name' => 'Doe,
        'email' => 'john@example.com'
    ])
);

$user = $client->users->get('username');

echo $user->email; // "john@example.com"

// To Array
echo $user->toArray()['email'];
```

### Getting Started
```php
require_once __DIR__ .'/vendor/autoload.php';

// Create a client and pass the path to the database folder
$client = new \FolderDb\Client('/path/to/database');
```


### Create a Folder
```php
$client->users;
```

### Insert data
```php
$data = [
    'id' => '123',
    'first_name' => 'John',
    'last_name' => 'Doe,
    'email' => 'john@example.com'
];

// `new \FolderDb\Document()` takes JSON string directly, so we have to convert it to array
$client->users->insert(
    'username',
    \FolderDb\Document::fromArray($data)
);
```

### Count
```php
echo $client->users->count(); // 2
```

### Fetch data
```php
$user = $client->users->get('username'); // returns `\FolderDb\Document`

// Access your entry as an object
echo $user->email; // "john@example.com"


// Access your entry as an array
$userArray = $user->toArray();
echo $userArray['email']; // "john@example.com"
```

### Delete "Collection"
⚠️ This method **deletes** the "Collection" **folder** and it's contents. ⚠️
```php
$user->delete(); // returns boolean
```

#### Dependencies
- PHP 7.1+
- [irfan-dahir/php-mom](https://github.com/irfan-dahir/php-mom)

#### Issues
Please create an issue for any bugs/security risks/etc