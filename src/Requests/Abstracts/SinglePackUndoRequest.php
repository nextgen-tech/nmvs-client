<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests\Abstracts;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Parsers\SinglePackUndoParser;

abstract class SinglePackUndoRequest extends SinglePackRequest implements RequestContract
{
    /**
     * The reference client transaction ID.
     *
     * @var  string|null
     */
    private $referenceClientTransationId;

    public function getParser(): ParserContract
    {
        return new SinglePackUndoParser();
    }

    public function setReferenceClientTransactionId(string $referenceClientTransationId): self
    {
        $this->referenceClientTransationId = $referenceClientTransationId;

        return $this;
    }

    protected function getEnvelopeBodyData(): array
    {
        $body = [
            'urn1:Product' => $this->product->toXmlArray(),
            'urn1:Pack'    => $this->pack->toXmlArray(),
        ];

        if ($this->referenceClientTransationId) {
            $body['urn1:RefClientTrxId'] = $this->referenceClientTransationId;
        }

        return $body;
    }
}
