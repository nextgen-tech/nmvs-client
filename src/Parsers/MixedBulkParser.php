<?php
declare(strict_types=1);

namespace NGT\NMVS\Parsers;

use DateTime;
use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Response as ResponseContract;
use NGT\NMVS\Models\Pack;
use NGT\NMVS\Models\Product;
use NGT\NMVS\Models\Transaction;
use NGT\NMVS\Responses\MixedBulkResponse;
use NGT\NMVS\Support\XML;

class MixedBulkParser implements ParserContract
{
    public function parse(string $xml): ResponseContract
    {
        $dom      = new XML($xml);
        $response = new MixedBulkResponse($xml);

        if ($clientTransactionId = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:ClientTrxId')) {
            $response->setClientTransactionId($clientTransactionId->getValue());
        }

        if ($NMVSTransactionId = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:NMVSTrxId')) {
            $response->setNMVSTransactionId($NMVSTransactionId->getValue());
        }

        if ($timestamp = $dom->getElement('//ns1:Header/ns1:Transaction/ns1:Timestamp')) {
            $response->setTimestamp($timestamp->getValue());
        }

        if ($transactions = $dom->getElements('//ns1:Body/ns1:TrxList/ns1:TrxItem')) {
            foreach ($transactions as $transactionXml) {
                $transaction = new Transaction();
                $transaction->setRequestType($transactionXml->getAttribute('ns1:reqType'));

                if ($productXml = $transactionXml->getChild('//ns1:Product')) {
                    $product = new Product();

                    if ($productCode = $productXml->getChild('//ns1:ProductCode')) {
                        $product->setCode($productCode->getValue());
                        $product->setCodeScheme($productCode->getAttribute('ns1:scheme'));
                    }

                    if ($batch = $productXml->getChild('//ns1:Batch')) {
                        $product->setBatchId($batch->getChild('//ns1:Id')->getValue());
                        $product->setExpiryDate(DateTime::createFromFormat('ymd', $batch->getChild('//ns1:ExpDate')->getValue()));
                    }

                    $transaction->setProduct($product);
                }

                if ($packXml = $transactionXml->getChild('//ns1:Pack')) {
                    $pack = new Pack();

                    $pack->setSerialNumber($packXml->getAttribute('ns1:sn'));
                    $pack->setState($packXml->getAttribute('ns1:state'));
                    $pack->setReason($packXml->getChild('//ns1:Reason')->getValue());
                    $pack->setReturnCode($packXml->getChild('//ns1:ReturnCode')->getAttribute('ns1:code'));
                    $pack->setReturnDescription($packXml->getChild('//ns1:ReturnCode')->getAttribute('ns1:desc'));

                    $transaction->setPack($pack);
                }

                $response->addTransaction($transaction);
            }
        }

        if ($reason = $dom->getElement('//ns1:Body/ns1:Reason')) {
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
