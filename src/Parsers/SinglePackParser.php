<?php
declare(strict_types=1);

namespace NGT\NMVS\Parsers;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Response as ResponseContract;
use NGT\NMVS\Responses\SinglePackResponse;
use NGT\NMVS\Support\XML;

class SinglePackParser implements ParserContract
{
    public function parse(string $xml): ResponseContract
    {
        $dom      = new XML($xml);
        $response = new SinglePackResponse($xml);

        if ($clientTransactionId = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:ClientTrxId')) {
            $response->setClientTransactionId($clientTransactionId->getValue());
        }

        if ($NMVSTransactionId = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:NMVSTrxId')) {
            $response->setNMVSTransactionId($NMVSTransactionId->getValue());
        }

        if ($timestamp = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:Timestamp')) {
            $response->setTimestamp($timestamp->getValue());
        }

        if ($productCode = $dom->getElement('//ns1:Body/ns1:Product/ns1:ProductCode')) {
            $response->setProductCode($productCode->getValue());
        }

        if ($batchId = $dom->getElement('//ns1:Body/ns1:Product/ns1:Batch/ns1:Id')) {
            $response->setBatchId($batchId->getValue());
        }

        if ($expirationDate = $dom->getElement('//ns1:Body/ns1:Product/ns1:Batch/ns1:ExpDate')) {
            $response->setExpirationDate($expirationDate->getValue());
        }

        if ($pack = $dom->getElement('//ns1:Body/ns1:Pack')) {
            if ($serialNumber = $pack->getAttribute('ns1:sn')) {
                $response->setPackSerialNumber($serialNumber);
            }

            if ($state = $pack->getAttribute('ns1:state')) {
                $response->setPackState($state);
            }
        }

        if ($reason = $dom->getElement('//ns1:Body/ns1:Pack/ns1:Reason')) {
            $response->setReason($reason->getValue());
        }

        if ($returnCode = $dom->getElement('//ns1:Body/ns1:ReturnCode')) {
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
