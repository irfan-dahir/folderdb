<?php

namespace FolderDb;

use FolderDb\Exception\NotReadableException;
use FolderDb\Factory\FileFactory;

/**
 * Class Folder
 * @package FolderDb
 */
class Folder
{

    private $name;

    private $path;

    public function __construct(string $dbPath, string $name)
    {
        $this->name = $name;
        $this->path = "{$dbPath}/{$name}";

        if (!@mkdir($this->path, 0777, true) && !is_dir($this->path)) {
            throw new NotReadableException('Failed to create folder');
        }
    }

    /**
     * @param string $name
     * @param Document $data
     * @return FileFactory
     * @throws \Exception
     */
    public function insert(string $name, Document $data) : FileFactory
    {
        return FileFactory::create($this->path, $name, $data->raw);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        $count = 0;

        foreach (new \DirectoryIterator($this->path) as $file) {
            if (!$file->isDot() && $file->isFile()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @return bool
     */
    public function delete() : bool
    {
        array_map('unlink', glob("{$this->path}/*.*"));
        rmdir($this->path);
    }

    /**
     * @param string $name
     * @return Document
     * @throws \Exception
     */
    public function get(string $name) : Document
    {
        $data = FileFactory::get($this->path, $name);

        return new Document($data->getData());
    }
}