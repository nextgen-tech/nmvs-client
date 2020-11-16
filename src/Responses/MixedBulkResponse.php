<?php
declare(strict_types=1);

namespace NGT\NMVS\Responses;

use NGT\NMVS\Contracts\Response as ResponseContract;
use NGT\NMVS\Models\Transaction;

class MixedBulkResponse extends Response implements ResponseContract
{
    /**
     * The client transation ID of response.
     *
     * @var  string|null
     */
    protected $clientTransactionId;

    /**
     * The NMVS transation ID of response.
     *
     * @var  string|null
     */
    protected $NMVSTransactionId;

    /**
     * The timestamp of response.
     *
     * @var  string|null
     */
    protected $timestamp;

    /**
     * The list of transactions.
     *
     * @var  array
     */
    protected $transactions = [];

    /**
     * The reason of response.
     *
     * @var  string|null
     */
    protected $reason;

    /**
     * The return code of response.
     *
     * @var  string|null
     */
    protected $returnCode;

    /**
     * The return description of response.
     *
     * @var  string|null
     */
    protected $returnDescription;

    public function setClientTransactionId(?string $clientTransactionId): void
    {
        $this->clientTransactionId = $clientTransactionId;
    }

    public function setNMVSTransactionId(?string $NMVSTransactionId): void
    {
        $this->NMVSTransactionId = $NMVSTransactionId;
    }

    public function setTimestamp(?string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    public function setReturnCode(?string $returnCode): void
    {
        $this->returnCode = $returnCode;
    }

    public function setReturnDescription(?string $returnDescription): void
    {
        $this->returnDescription = $returnDescription;
    }

    public function getClientTransactionId(): ?string
    {
        return $this->clientTransactionId;
    }

    public function getNMVSTransactionId(): ?string
    {
        return $this->NMVSTransactionId;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
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

    public function toArray(): array
    {
        return [
            'xml'                 => $this->getXml(),
            'clientTransactionId' => $this->getClientTransactionId(),
            'NMVSTransactionId'   => $this->getNMVSTransactionId(),
            'timestamp'           => $this->getTimestamp(),
            'reason'              => $this->getReason(),
            'returnCode'          => $this->getReturnCode(),
            'returnDescription'   => $this->getReturnDescription(),
        ];
    }
}
