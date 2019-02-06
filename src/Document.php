<?php

namespace  FolderDb;

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

        $this->object = json_decode($this->raw);
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return json_decode($this->raw, true);
    }
}