<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Parsers\BulkParser;
use NGT\NMVS\Requests\Abstracts\Request;

class G188BulkOperationResultRequest extends Request implements RequestContract
{
    /**
     * The reference NMVS transaction ID.
     *
     * @var  string|null
     */
    protected $referenceNMVSTransationId;

    public function getEndpoint(): string
    {
        return Endpoint::BULK_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new BulkParser();
    }

    public function getUseCaseNumber(): string
    {
        return 'G188';
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
