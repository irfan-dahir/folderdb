<?php

namespace FolderDb\Factory;

use FolderDb\Exception\FileNotFoundException;
use FolderDb\Exception\NotReadableException;

/**
 * Class FileFactory
 * @package FolderDb\Factory
 */
class FileFactory
{

    /**
     * @var string
     */
    private $folder;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $data = "";

    /**
     * FileFactory constructor.
     * @param string $folder
     * @param string $name
     */
    private function __construct(string $folder, string $name)
    {
        $this->folder = $folder;
        $this->name = $name;

        $this->path = getenv('DB_PATH') . $this->folder . '/' . $this->name;
    }

    /**
     * @param string $folder
     * @param string $name
     * @param string|null $data
     * @return FileFactory
     * @throws \Exception
     */
    public static function create(string $folder, string $name, ?string $data = null) : self
    {
        $instance = new self($folder, $name);

        $instance->data = $data ?? "";

        if (file_put_contents($instance->getPath(), $instance->getData()) === false) {
            throw new NotReadableException('Failed to create file');
        }

        return $instance;
    }

    /**
     * @param string $folder
     * @param string $name
     * @return FileFactory
     * @throws \Exception
     */
    public static function get(string $folder, string $name) : self
    {
        $instance = new self($folder, $name);

        if (!file_exists($instance->getPath())) {
            throw new FileNotFoundException($instance->getPath() . ' not found');
        } else {
            if (!is_readable($instance->getPath())) {
                throw new NotReadableException($instance->getPath() . ' is not readable');
            }
        }

        $instance->setData(file_get_contents($instance->getPath()));

        return $instance;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FileFactory
     */
    public function setName(string $name): FileFactory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return FileFactory
     */
    public function setPath(string $path): FileFactory
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return FileFactory
     */
    public function setData(string $data): FileFactory
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * @param string $folder
     * @return FileFactory
     */
    public function setFolder(string $folder): FileFactory
    {
        $this->folder = $folder;
        return $this;
    }



}