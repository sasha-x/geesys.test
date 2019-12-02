<?php


namespace App\Entity;


class Document  extends Entity
{
    /** @var string Business unique number */
    private $number;

    /** @var int Timestamp */
    private $created;


    /**
     * TODO: all other params
     * For example current status and timestamps
     */

    public function __construct()
    {
        $this->setCreated(time());
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Document
     */
    public function setNumber(string $number): Document
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @param int $created
     *
     * @return Document
     */
    public function setCreated(int $created): Document
    {
        $this->created = $created;
        return $this;
    }

}