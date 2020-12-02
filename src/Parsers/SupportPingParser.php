<?php
declare(strict_types=1);

namespace NGT\NMVS\Parsers;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Response as ResponseContract;
use NGT\NMVS\Responses\SupportPingResponse;
use NGT\NMVS\Support\XML;

class SupportPingParser implements ParserContract
{
    public function parse(string $xml): ResponseContract
    {
        $dom      = new XML($xml);
        $response = new SupportPingResponse($xml);

        $response->setInput($dom->getElement('//ns2:SupportPingResponse/ns1:Output')->getValue());

        return $response;
    }
}
