<?php

namespace FolderDb;

use FolderDb\Factory\FileFactory;
use FolderDb\Factory\FolderFactory;

/**
 * Class Folder
 * @package FolderDb
 */
class Folder
{
    /**
     * @var FolderFactory
     */
    private $folder;

    /**
     * Folder constructor.
     * @param FolderFactory $folder
     */
    public function __construct(FolderFactory $folder)
    {
        $this->folder = $folder;
    }

    /**
     * @param string $name
     * @param array $data
     * @return FileFactory
     * @throws \Exception
     */
    public function insert(string $name, array $data) : FileFactory
    {
        $data = \json_encode($data);

        try {
            $instance = FileFactory::create($this->folder->getName(), $name, $data);
        } catch (\Exception $e) {
            throw new \Exception('Failed to insert data');
        }

        return $instance;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        $count = 0;

        foreach (new \DirectoryIterator($this->folder->getPath()) as $file) {
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
        array_map('unlink', glob("{$this->folder->getPath()}/*.*"));
        rmdir($this->folder->getPath());
    }

    /**
     * @param string $name
     * @return Document
     * @throws \Exception
     */
    public function get(string $name) : Document
    {
        $data = FileFactory::get($this->folder->getName(), $name);

        return new Document($data->getData());
    }
}