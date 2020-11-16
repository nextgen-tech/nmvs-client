<?php
declare(strict_types=1);

namespace NGT\NMVS\Parsers;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Responses\BulkResponse;
use NGT\NMVS\Support\XML;

class BulkUndoParser implements ParserContract
{
    public function parse(string $xml): BulkResponse
    {
        $dom      = new XML($xml);
        $response = new BulkResponse($xml);

        if ($clientTransactionId = $dom->getElement('//ns1:ClientTrxId')) {
            $response->setClientTransactionId($clientTransactionId->getValue());
        }

        if ($NMVSTransactionId = $dom->getElement('//ns1:NMVSTrxId')) {
            $response->setNMVSTransactionId($NMVSTransactionId->getValue());
        }

        if ($timestamp = $dom->getElement('//ns1:Timestamp')) {
            $response->setTimestamp($timestamp->getValue());
        }

        if ($productCode = $dom->getElement('//ns1:ProductCode')) {
            $response->setProductCode($productCode->getValue());
        }

        if ($batchId = $dom->getElement('//ns1:Batch/ns1:Id')) {
            $response->setBatchId($batchId->getValue());
        }

        if ($expirationDate = $dom->getElement('//ns1:Batch/ns1:ExpDate')) {
            $response->setExpirationDate($expirationDate->getValue());
        }

        if ($pack = $dom->getElement('//ns1:Pack')) {
            if ($serialNumber = $pack->getAttribute('ns1:sn')) {
                $response->setPackSerialNumber($serialNumber);
            }

            if ($state = $pack->getAttribute('ns1:state')) {
                $response->setPackState($state);
            }
        }

        if ($returnCode = $dom->getElement('//ns1:ReturnCode')) {
            if ($code = $returnCode->getAttribute('ns1:code')) {
                $response->setReturnCode($code);
            }

            if ($description = $returnCode->getAttribute('ns1:desc')) {
                $response->setReturnDescription($description);
            }
        }

        return $response;
    }
}
