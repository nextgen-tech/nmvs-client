<?php
declare(strict_types=1);

namespace NGT\NMVS\Contracts;

interface Connection
{
    public function setEndpoint(string $endpoint): self;

    public function send(string $xml): string;
}
