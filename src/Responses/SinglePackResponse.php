<?php
declare(strict_types=1);

namespace NGT\NMVS\Responses;

use NGT\NMVS\Contracts\Response as ResponseContract;

class SinglePackResponse extends Response implements ResponseContract
{
    /**
     * The client transation ID of response.
     *
     * @var  string|null
     */
    protected $clientTransactionId;

    /**
     * The NMVS transation ID of response.
     *
     * @var  string|null
     */
    protected $NMVSTransactionId;

    /**
     * The timestamp of response.
     *
     * @var  string|null
     */
    protected $timestamp;

    /**
     * The code of product.
     *
     * @var  string|null
     */
    protected $productCode;

    /**
     * The batch ID of product.
     *
     * @var  string|null
     */
    protected $batchId;

    /**
     * The expiration date of product.
     *
     * @var  string|null
     */
    protected $expirationDate;

    /**
     * The serial number of product pack.
     *
     * @var  string|null
     */
    protected $packSerialNumber;

    /**
     * The state of product pack.
     *
     * @var  string|null
     */
    protected $packState;

    /**
     * The reason of response.
     *
     * @var  string|null
     */
    protected $reason;

    /**
     * The return code of response.
     *
     * @var  string|null
     */
    protected $returnCode;

    /**
     * The return description of response.
     *
     * @var  string|null
     */
    protected $returnDescription;

    public function setClientTransactionId(?string $clientTransactionId): void
    {
        $this->clientTransactionId = $clientTransactionId;
    }

    public function setNMVSTransactionId(?string $NMVSTransactionId): void
    {
        $this->NMVSTransactionId = $NMVSTransactionId;
    }

    public function setTimestamp(?string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function setProductCode(?string $productCode): void
    {
        $this->productCode = $productCode;
    }

    public function setBatchId(?string $batchId): void
    {
        $this->batchId = $batchId;
    }

    public function setExpirationDate(?string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function setPackSerialNumber(?string $packSerialNumber): void
    {
        $this->packSerialNumber = $packSerialNumber;
    }

    public function setPackState(?string $packState): void
    {
        $this->packState = $packState;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    public function setReturnCode(?string $returnCode): void
    {
        $this->returnCode = $returnCode;
    }

    public function setReturnDescription(?string $returnDescription): void
    {
        $this->returnDescription = $returnDescription;
    }

    public function getClientTransactionId(): ?string
    {
        return $this->clientTransactionId;
    }

    public function getNMVSTransactionId(): ?string
    {
        return $this->NMVSTransactionId;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function getBatchId(): ?string
    {
        return $this->batchId;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expirationDate;
    }

    public function getPackSerialNumber(): ?string
    {
        return $this->packSerialNumber;
    }

    public function getPackState(): ?string
    {
        return $this->packState;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getReturnCode(): ?string
    {
        return $this->returnCode;
    }

    public function getReturnDescription(): ?string
    {
        return $this->returnDescription;
    }

    public function toArray(): array
    {
        return [
            'xml'                 => $this->getXml(),
            'clientTransactionId' => $this->getClientTransactionId(),
            'NMVSTransactionId'   => $this->getNMVSTransactionId(),
            'timestamp'           => $this->getTimestamp(),
            'productCode'         => $this->getProductCode(),
            'batchId'             => $this->getBatchId(),
            'expirationDate'      => $this->getExpirationDate(),
            'packSerialNumber'    => $this->getPackSerialNumber(),
            'packState'           => $this->getPackState(),
            'reason'              => $this->getReason(),
            'returnCode'          => $this->getReturnCode(),
            'returnDescription'   => $this->getReturnDescription(),
        ];
    }
}
