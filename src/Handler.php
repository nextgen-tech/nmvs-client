<?php
declare(strict_types=1);

namespace NGT\NMVS;

use NGT\NMVS\Contracts\Connection;
use NGT\NMVS\Contracts\Request;
use NGT\NMVS\Contracts\Response;

class Handler
{
    /**
     * The connection instance.
     *
     * @var  \NGT\NMVS\Contracts\Connection
     */
    protected $connection;

    public function setConnection(Connection $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    public function handle(Request $request): Response
    {
        $response = $this->send($request);

        return $request->getParser()->parse($response);
    }

    protected function send(Request $request): string
    {
        return $this->connection
            ->setEndpoint($request->getEndpoint())
            ->send($request->toXml());
    }
}
