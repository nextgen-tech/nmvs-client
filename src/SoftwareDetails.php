<?php
declare(strict_types=1);

namespace NGT\NMVS;

class SoftwareDetails
{
    /**
     * The name of the supplier using this package.
     *
     * @var  string|null
     */
    private $supplier;

    /**
     * The name of the software using this package.
     *
     * @var  string|null
     */
    private $name;

    /**
     * The version of the software using this package.
     *
     * @var  string|null
     */
    private $version;

    public function __construct(
        string $supplier = null,
        string $name = null,
        string $version = null
    ) {
        $this->setSupplier($supplier);
        $this->setName($name);
        $this->setVersion($version);
    }

    public function setSupplier(?string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }
}
