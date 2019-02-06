# FolderDB
FolderDB is a flat-file JSON database. It creates directories which represent "Tables" or "Collections". 

It saves data in folders as files with key/value pairs in JSON format. The "key" is the file name where the "value" is the JSON document.

# Jikan - Unofficial MyAnimeList.net PHP API
[![Version](https://img.shields.io/packagist/v/irfan-dahir/folderdb.svg?style=flat)](https://packagist.org/packages/irfan-dahir/folderdb) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/folderdb.svg)](http://isitmaintained.com/project/irfan-dahir/folderdb "Average time to resolve an issue") [![stable](https://img.shields.io/badge/PHP-^%207.1-blue.svg?style=flat)]() [![MIT License](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)](https://img.shields.io/github/license/irfan-dahir/folderdb.svg?style=flat)
## Installation
1. `composer require irfan-dahir/folderdb`
2. Copy `.env.example` to `.env` and configure the directory that will act as the database.

## Documentation

### Getting Started
```php
require_once __DIR__ .'/vendor/autoload.php';

// Create a client and pass the path to the .env
$client = new \FolderDb\Client('/var/www/folderdb/.env');
```




### Dependencies
- **symfony/dotenv** is used for database configuration.


### Issues
Please report any (security) issues