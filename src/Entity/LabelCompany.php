<?php


namespace App\Entity;

/**
 * Class LabelCompany
 * Represents service provider company
 * Компания, держатель интернет-сервиса
 */
class LabelCompany extends LegalCompany
{
    /** @var string */
    private $label;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return LabelCompany
     */
    public function setLabel(string $label): LabelCompany
    {
        $this->label = $label;
        return $this;
    }

}