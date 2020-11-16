<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests\Abstracts;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Parsers\BulkUndoParser;

abstract class BulkUndoRequest extends BulkRequest implements RequestContract
{
    /**
     * The reference client transaction ID.
     *
     * @var  string|null
     */
    private $referenceClientTransationId;

    public function getParser(): ParserContract
    {
        return new BulkUndoParser();
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
            'urn1:Packs'   => $this->packs->toXmlArray(),
        ];

        if ($this->referenceClientTransationId) {
            $body['urn1:RefClientTrxId'] = $this->referenceClientTransationId;
        }

        return $body;
    }
}
