<?php


namespace App\Entity;


abstract class Entity
{
    /** @var int */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Entity
     */
    public function setId($id): Entity
    {
        $this->id = $id;
        return $this;
    }

}