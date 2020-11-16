<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests\Abstracts;

use NGT\NMVS\Collections\PackCollection;
use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Contracts\Xmlable;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Models\Pack;
use NGT\NMVS\Models\Product;
use NGT\NMVS\Parsers\BulkParser;

abstract class BulkRequest extends Request implements RequestContract, Xmlable
{
    /**
     * The product instance.
     *
     * @var  \NGT\NMVS\Models\Product
     */
    protected $product;

    /**
     * The pack collection instance.
     *
     * @var  \NGT\NMVS\Collections\PackCollection
     */
    protected $packs;

    public function __construct()
    {
        $this->packs = new PackCollection();
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return Endpoint::BULK_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new BulkParser();
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function addPack(Pack $pack): self
    {
        $this->packs->add($pack);

        return $this;
    }

    protected function getEnvelopeBodyData(): array
    {
        return [
            'urn1:Product' => $this->product->toXmlArray(),
            'urn1:Packs'   => $this->packs->toXmlArray(),
        ];
    }

    public function toXmlArray(): array
    {
        return [
            // 'urn1:Item' => [
            //     '_attributes' => [
            //         'urn1:reqType' => $this->getUseCaseNumber(),
            //     ],
            //     'urn1:Product'     => $this->product->toXmlArray(),
            //     'urn1:Pack'        => $this->pack->toXmlArray(),
            //     'urn1:Transaction' => [
            //         'urn1:ClientTrxId' => $this->getTransactionId(),
            //         'urn1:Language'    => 'eng',
            //     ],
            // ],
        ];
    }
}
