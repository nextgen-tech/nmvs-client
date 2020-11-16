<?php
declare(strict_types=1);

namespace NGT\NMVS\Responses;

abstract class Response
{
    /**
     * The XML content.
     *
     * @var  string
     */
    protected $xml;

    public function __construct(string $xml)
    {
        $this->xml = $xml;
    }

    public function getXml(): string
    {
        return $this->xml;
    }
}
