<?php


namespace App\Entity;


class TransferOrder extends Document
{
    /** @var LabelCompany */
    private $labelCompany;

    /** @var LegalCompany */
    private $customer;

    /** @var LegalCompany */
    private $agent;

    /** @var LegalCompany */
    private $executor;

    /** @var TransferRequest */
    private $request;

    /**
     * @return LabelCompany
     */
    public function getLabelCompany(): LabelCompany
    {
        return $this->labelCompany;
    }

    /**
     * @param LabelCompany $labelCompany
     *
     * @return TransferOrder
     */
    public function setLabelCompany(LabelCompany $labelCompany): TransferOrder
    {
        $this->labelCompany = $labelCompany;
        return $this;
    }

    /**
     * @return LegalCompany
     */
    public function getCustomer(): LegalCompany
    {
        return $this->customer;
    }

    /**
     * @param LegalCompany $customer
     *
     * @return TransferOrder
     */
    public function setCustomer(LegalCompany $customer): TransferOrder
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return LegalCompany
     */
    public function getAgent(): LegalCompany
    {
        return $this->agent;
    }

    /**
     * @param LegalCompany $agent
     *
     * @return TransferOrder
     */
    public function setAgent(LegalCompany $agent): TransferOrder
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * @return LegalCompany
     */
    public function getExecutor(): LegalCompany
    {
        return $this->executor;
    }

    /**
     * @param LegalCompany $executor
     *
     * @return TransferOrder
     */
    public function setExecutor(LegalCompany $executor): TransferOrder
    {
        $this->executor = $executor;
        return $this;
    }

    /**
     * @return TransferRequest
     */
    public function getRequest(): TransferRequest
    {
        return $this->request;
    }

    /**
     * @param TransferRequest $request
     *
     * @return TransferOrder
     */
    public function setRequest(TransferRequest $request): TransferOrder
    {
        $this->request = $request;
        return $this;
    }


}