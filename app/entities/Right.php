<?php

namespace app\entities;

/**
 * @package app\entities
 */
class Right
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $code;

    /** @var string */
    public string $name;


    /**
     * User entity constructor
     * @param int $id
     * @param string $code
     * @param string $name
     */
    public function __construct(int $id, string $code, string $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }
}