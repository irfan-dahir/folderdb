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
    private $path;

    /**
     * @var string
     */
    private $data = "";


    /**
     * FileFactory constructor.
     * @param string $path
     */
    private function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $path
     * @param string|null $data
     * @return FileFactory
     * @throws NotReadableException
     */
    public static function create(string $path, ?string $data = null) : self
    {
        $instance = new self($path);

        $instance->data = $data ?? "";

        if (file_put_contents($instance->getPath(), $instance->getData()) === false) {
            throw new NotReadableException('Failed to create file');
        }

        return $instance;
    }


    /**
     * @param string $path
     * @return FileFactory
     * @throws FileNotFoundException
     * @throws NotReadableException
     */
    public static function get(string $path) : self
    {
        $instance = new self($path);

        if (!file_exists($instance->getPath())) {
            throw new FileNotFoundException($instance->getPath() . ' not found');
        }

        if (!is_readable($instance->getPath())) {
            throw new NotReadableException($instance->getPath() . ' is not readable');
        }

        $instance->setData(file_get_contents($instance->getPath()));

        return $instance;
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



}