<?php

namespace FolderDb\Factory;

/**
 * Class FolderFactory
 * @package FolderDb\Factory
 */
class FolderFactory
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
     * FolderFactory constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
        $this->path = getenv('DB_PATH') . $name;
    }

    /**
     * @param string $name
     * @return FolderFactory
     * @throws \Exception
     */
    public static function create(string $name) : self
    {
        $instance = new self($name);

        if (!@mkdir($instance->getPath(), 0777, true) && !is_dir($instance->getPath())) {
            throw new \Exception('Could not create db'); //replace with monolog
        }

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
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


}