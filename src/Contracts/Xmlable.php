<?php
declare(strict_types=1);

namespace NGT\NMVS\Contracts;

interface Xmlable
{
    public function toXmlArray(): array;
}
