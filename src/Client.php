<?php

namespace FolderDb;

use FolderDb\Exception\FileNotFoundException;
use FolderDb\Exception\FolderNotFoundException;

class Client
{
    public $dbPath;

    public function __construct(string $dbPath)
    {
        if (!is_dir($dbPath)) {
            throw new FolderNotFoundException('Database path not found');
        }

        $this->dbPath = $dbPath;
    }

    public function __get(string $folder)
    {
        if (!property_exists($this, $folder)) {
            $this->{$folder} = new Folder($this->dbPath, $folder);
        }

        return $this->{$folder};
    }

}