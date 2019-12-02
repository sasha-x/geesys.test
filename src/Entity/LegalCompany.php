<?php


namespace App\Entity;

/**
 * Class LegalEntity
 * Represents legal entity
 * Юридическое лицо
 */
class LegalCompany extends Entity
{

    /** @var string */
    private $name;

    /** @var string */
    private $inn;

    /** @var string */
    private $kpp;

    /** @var string */
    private $zipCode;

    /** @var string */
    private $address;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return LabelCompany
     */
    public function setName($name): LegalCompany
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     *
     * @return LegalCompany
     */
    public function setInn(string $inn): LegalCompany
    {
        $this->inn = $inn;
        return $this;
    }

    /**
     * @return string
     */
    public function getKpp(): string
    {
        return $this->kpp;
    }

    /**
     * @param string $kpp
     *
     * @return LegalCompany
     */
    public function setKpp(string $kpp): LegalCompany
    {
        $this->kpp = $kpp;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return LegalCompany
     */
    public function setZipCode(string $zipCode): LegalCompany
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return LegalCompany
     */
    public function setAddress(string $address): LegalCompany
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $name
     * @param string $inn
     * @param string $kpp
     * @param string $zipCode
     * @param string $address
     *
     * @return bool
     */
    public function setMainInfo($name, $inn, $kpp, $zipCode, $address): bool
    {
        $this->setName($name)
             ->setInn($inn)
             ->setKpp($kpp)
             ->setZipCode($zipCode)
             ->setAddress($address);
        return true;
    }
}