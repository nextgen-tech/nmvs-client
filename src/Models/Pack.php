<?php
declare(strict_types=1);

namespace NGT\NMVS\Models;

use NGT\NMVS\Contracts\Xmlable;

class Pack implements Xmlable
{
    /**
     * The serial number of pack.
     *
     * @var  string
     */
    private $serialNumber;

    /**
     * The state of pack.
     *
     * @var  string|null
     */
    private $state;

    /**
     * The reason of pack.
     *
     * @var  string|null
     */
    private $reason;

    /**
     * The return code of pack.
     *
     * @var  string|null
     */
    private $returnCode;

    /**
     * The return description of pack.
     *
     * @var  string|null
     */
    private $returnDescription;

    public function __construct(string $serialNumber = null)
    {
        if ($serialNumber !== null) {
            $this->serialNumber = $serialNumber;
        }
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function setReturnCode(string $returnCode): self
    {
        $this->returnCode = $returnCode;

        return $this;
    }

    public function setReturnDescription(string $returnDescription): self
    {
        $this->returnDescription = $returnDescription;

        return $this;
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    public function getState(): ?string
    {
        return $this->state;
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

    public function toXmlArray(): array
    {
        return [
            '_attributes' => [
                'urn1:sn' => $this->getSerialNumber(),
            ],
        ];
    }
}
