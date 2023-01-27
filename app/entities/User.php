<?php

namespace app\entities;

/**
 * @package app\entities
 */
class User
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $name;

    /** @var string */
    public string $email;

    /** It's used for authenticator, but i can do some kinds of rights */
    /** @var array */
    public array $rights;

    /**
     * User entity constructor
     * @param int $id
     * @param string $name
     * @param string $email
     * @param array $rights
     */
    public function __construct(int $id, string $name, string $email, array $rights = [])
    {
       $this->id = $id;
       $this->name = $name;
       $this->email = $email;
       $this->rights = $rights;
    }
}