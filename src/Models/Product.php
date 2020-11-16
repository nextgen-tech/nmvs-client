<?php
declare(strict_types=1);

namespace NGT\NMVS\Models;

use DateTimeInterface;
use NGT\NMVS\Contracts\Xmlable;

class Product implements Xmlable
{
    /**
     * The code of the product.
     *
     * @var  string
     */
    private $code;

    /**
     * The code scheme of the product.
     *
     * @var  string
     */
    private $codeScheme = 'GTIN';

    /**
     * The batch ID of the product.
     *
     * @var  string
     */
    private $batchId;

    /**
     * The expiry date of the product.
     *
     * @var  DateTimeInterface
     */
    private $expiryDate;

    public function __construct(
        string $code = null,
        string $codeScheme = null,
        string $batchId = null,
        DateTimeInterface $expiryDate = null
    ) {
        if (!empty($code)) {
            $this->setCode($code);
        }

        if (!empty($codeScheme)) {
            $this->setCodeScheme($codeScheme);
        }

        if (!empty($batchId)) {
            $this->setBatchId($batchId);
        }

        if (!empty($expiryDate)) {
            $this->setExpiryDate($expiryDate);
        }
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setCodeScheme(string $codeScheme): self
    {
        $this->codeScheme = strtoupper($codeScheme);

        return $this;
    }

    public function setBatchId(string $batchId): self
    {
        $this->batchId = $batchId;

        return $this;
    }

    public function setExpiryDate(DateTimeInterface $expiryDate): self
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCodeScheme(): string
    {
        return $this->codeScheme;
    }

    public function getBatchId(): string
    {
        return $this->batchId;
    }

    public function getExpiryDate(): DateTimeInterface
    {
        return $this->expiryDate;
    }

    public function getFormattedExpiryDate(): string
    {
        return $this->expiryDate->format('ymd');
    }

    public function toXmlArray(): array
    {
        return [
            'urn1:ProductCode' => [
                '_attributes' => [
                    'urn1:scheme' => $this->getCodeScheme(),
                ],
                '_value' => $this->getCode(),
            ],
            'urn1:Batch' => [
                'urn1:Id'      => $this->getBatchId(),
                'urn1:ExpDate' => $this->getFormattedExpiryDate(),
            ],
        ];
    }
}
