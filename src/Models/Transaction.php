<?php
declare(strict_types=1);

namespace NGT\NMVS\Models;

class Transaction
{
    /**
     * The transaction request type.
     *
     * @var  string
     */
    private $requestType;

    /**
     * The transaction product.
     *
     * @var  \NGT\NMVS\Models\Product|null
     */
    private $product;

    /**
     * The transaction pack.
     *
     * @var  \NGT\NMVS\Models\Pack|null
     */
    private $pack;

    public function setRequestType(string $requestType): self
    {
        $this->requestType = $requestType;

        return $this;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function setPack(Pack $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

    public function getRequestType(): string
    {
        return $this->requestType;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function getPack(): ?Pack
    {
        return $this->pack;
    }
}
