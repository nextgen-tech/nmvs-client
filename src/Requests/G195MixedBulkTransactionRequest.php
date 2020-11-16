<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Collections\TransactionCollection;
use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Contracts\Xmlable;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Parsers\MixedBulkParser;
use NGT\NMVS\Requests\Abstracts\Request;

class G195MixedBulkTransactionRequest extends Request implements RequestContract
{
    /**
     * The transactions collection.
     *
     * @var  \NGT\NMVS\Collections\TransactionCollection
     */
    protected $transactions;

    public function __construct()
    {
        $this->transactions = new TransactionCollection();
    }

    public function addTransaction(Xmlable $transaction): self
    {
        $this->transactions->add($transaction);

        return $this;
    }

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
        return 'G195';
    }

    protected function getEnvelopeBodyData(): array
    {
        return [
            'urn1:TrxList' => $this->transactions->toXmlArray(),
        ];
    }
}
