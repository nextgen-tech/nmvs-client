<?php
declare(strict_types=1);

namespace NGT\NMVS\Collections;

use NGT\NMVS\Contracts\Xmlable;

class TransactionCollection implements Xmlable
{
    /**
     * The transactions collection.
     *
     * @var  \NGT\NMVS\Contracts\Xmlable[]
     */
    private $transactions;

    /**
     * Add transaction to collection.
     *
     * @param  \NGT\NMVS\Contracts\Xmlable  $transaction
     */
    public function add(Xmlable $transaction): self
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    public function toXmlArray(): array
    {
        $transactions = [];

        foreach ($this->transactions as $transaction) {
            $transactions[] = $transaction->toXmlArray();
        }

        return ['urn1:TrxItem' => $transactions];
    }
}
