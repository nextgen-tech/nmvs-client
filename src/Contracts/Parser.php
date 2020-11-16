<?php
declare(strict_types=1);

namespace NGT\NMVS\Contracts;

interface Parser
{
    public function parse(string $response): Response;
}
