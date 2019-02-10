<?php

namespace  FolderDb;

use MOM\Schema;

/**
 * Class Document
 * @package FolderDb
 */
class Document
{

    /**
     * @var false|string|null
     */
    public $raw;
    /**
     * @var mixed
     */
    public $object;

    /**
     * Document constructor.
     * @param string|null $data
     */
    public function __construct(?string $data = null)
    {
        $this->raw = $data ?? \json_encode([]);

        $this->object = Schema::create(
            \json_decode($this->raw, true)
        );
    }

    public function __get($key)
    {
        if (!property_exists($this->object, $key)) {
            return null;
        }

        return $this->object->{$key};
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return \json_decode($this->raw, true);
    }

    public static function fromArray(array $data) : self
    {
        return new self(\json_encode($data));
    }
}