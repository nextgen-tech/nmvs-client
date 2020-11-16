<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Parsers\MixedBulkParser;
use NGT\NMVS\Requests\Abstracts\Request;

class G196BulkMixedOperationResultRequest extends Request implements RequestContract
{
    /**
     * The reference NMVS transaction ID.
     *
     * @var  string|null
     */
    protected $referenceNMVSTransationId;

    public function getEndpoint(): string
    {
        return Endpoint::MIXED_BULK_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new MixedBulkParser();
    }

    public function getUseCaseNumber(): string
    {
        return 'G196';
    }

    public function setReferenceNMVSTransactionId(string $referenceNMVSTransationId): self
    {
        $this->referenceNMVSTransationId = $referenceNMVSTransationId;

        return $this;
    }

    protected function getEnvelopeBodyData(): array
    {
        return [
            'urn1:RefNMVSTrxId' => $this->referenceNMVSTransationId,
        ];
    }
}
