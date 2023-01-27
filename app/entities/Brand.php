<?php

namespace app\entities;

use Nette\Utils\DateTime;
use utils\Strings;

/**
 * @package app\entities
 */
class Brand
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $code;

    /** @var string  */
    public string $name;

    /** @var DateTime */
    public DateTime $created;

    /** @var User */
    public User $createdBy;

    /** @var DateTime */
    public ?DateTime $edited = null;

    /** @var User */
    public ?User $editedBy = null;

    /**
     * User entity constructor
     * @param array $params
     */
    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            $valueKey = Strings::camelize($key, "brand_");
            $this->$valueKey = $value;
        }
    }
}