<?php
declare(strict_types=1);

namespace NGT\NMVS\Parsers;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Response as ResponseContract;
use NGT\NMVS\Responses\BulkResponse;
use NGT\NMVS\Support\XML;

class BulkParser implements ParserContract
{
    public function parse(string $xml): ResponseContract
    {
        $dom      = new XML($xml);
        $response = new BulkResponse($xml);

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

        if ($packs = $dom->getElements('//ns1:Body/ns1:Packs/ns1:Pack')) {
            foreach ($packs as $pack) {
                $packResponse = [];

                if ($serialNumber = $pack->getAttribute('ns1:sn')) {
                    $packResponse['serial_number'] = $serialNumber;
                }

                if ($state = $pack->getAttribute('ns1:state')) {
                    $packResponse['state'] = $state;
                }

                if ($reason = $pack->getChild('//ns1:Reason')) {
                    $packResponse['reason'] = $reason->getValue();
                }

                if ($returnCode = $pack->getChild('//ns1:ReturnCode')) {
                    if ($code = $returnCode->getAttribute('ns1:code')) {
                        $packResponse['return_code'] = $code;
                    }

                    if ($description = $returnCode->getAttribute('ns1:desc')) {
                        $packResponse['return_description'] = $description;
                    }
                }

                $response->addPack($packResponse);
            }
        }

        if ($returnCode = $dom->getElement('//ns1:Body/ns1:ReturnCode')) {
            if ($code = $returnCode->getAttribute('ns1:code')) {
                $response->setReturnCode($code);
            }

            if ($description = $returnCode->getAttribute('ns1:desc')) {
                $response->setReturnDescription($description);
            }
        }

        if ($reason = $dom->getElement('//ns1:Body/ns1:Reason')) {
            $response->setReason($reason->getValue());
        }

        return $response;
    }
}
