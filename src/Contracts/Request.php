<?php
declare(strict_types=1);

namespace NGT\NMVS\Contracts;

use NGT\NMVS\Credentials;
use NGT\NMVS\SoftwareDetails;

interface Request
{
    public function getEndpoint(): string;

    public function getParser(): Parser;

    public function setCredentials(Credentials $credentials): self;

    public function setSoftwareDetails(SoftwareDetails $softwareDetails): self;

    public function toXml(): string;
}
