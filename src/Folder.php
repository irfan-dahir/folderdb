<?php

namespace FolderDb;

use FolderDb\Exception\FolderNotFoundException;
use FolderDb\Exception\NotReadableException;
use FolderDb\Factory\FileFactory;

/**
 * Class Folder
 * @package FolderDb
 */
class Folder
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * Folder constructor.
     * @param string $dbPath
     * @param string $name
     * @throws NotReadableException
     */
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
        return FileFactory::create("{$this->path}/{$name}", $data->raw);
    }

    /**
     * @return int
     * @throws FolderNotFoundException
     */
    public function count() : int
    {
        if (!is_dir($this->path)) {
            throw new FolderNotFoundException("{$this->path} does not exist");
        }

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
        array_map('unlink', glob("{$this->path}/*"));
        rmdir($this->path);

        return true;
    }

    /**
     * @param string $name
     * @return Document
     * @throws \Exception
     */
    public function get(string $name) : Document
    {
        return $this->_get("{$this->path}/{$name}");
    }

    private function _get(string $path) : Document
    {
        return new Document(
            (FileFactory::get($path))->getData()
        );
    }

    public function getAll() : array
    {
        return array_map(
            [$this, '_get'],
            glob("{$this->path}/*")
        );
    }

    public function exists(string $name) : bool
    {
        if (file_exists("{$this->path}/{$name}")) {
            return true;
        }

        return false;
    }
}