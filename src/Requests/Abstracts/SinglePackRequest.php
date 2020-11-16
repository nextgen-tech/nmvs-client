<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests\Abstracts;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Contracts\Xmlable;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Models\Pack;
use NGT\NMVS\Models\Product;
use NGT\NMVS\Parsers\SinglePackParser;

abstract class SinglePackRequest extends Request implements RequestContract, Xmlable
{
    /**
     * The product instance.
     *
     * @var  \NGT\NMVS\Models\Product
     */
    protected $product;

    /**
     * The pack instance.
     *
     * @var  \NGT\NMVS\Models\Pack
     */
    protected $pack;

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return Endpoint::SINGLE_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new SinglePackParser();
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

    protected function getEnvelopeBodyData(): array
    {
        return [
            'urn1:Product' => $this->product->toXmlArray(),
            'urn1:Pack'    => $this->pack->toXmlArray(),
        ];
    }

    public function toXmlArray(): array
    {
        return [
            'urn1:Item' => [
                '_attributes' => [
                    'urn1:reqType' => $this->getUseCaseNumber(),
                ],
                'urn1:Product'     => $this->product->toXmlArray(),
                'urn1:Pack'        => $this->pack->toXmlArray(),
                'urn1:Transaction' => [
                    'urn1:ClientTrxId' => $this->getTransactionId(),
                    'urn1:Language'    => 'eng',
                ],
            ],
        ];
    }
}
