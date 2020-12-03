<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Credentials;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Parsers\SupportPingParser;
use NGT\NMVS\SoftwareDetails;
use Spatie\ArrayToXml\ArrayToXml;

class SupportPingRequest implements RequestContract
{
    /**
     * The request input.
     *
     * @var  string
     */
    protected $input;

    /**
     * The credentials instance.
     *
     * @var  \NGT\NMVS\Credentials
     */
    protected $credentials;

    /**
     * The software details instance.
     *
     * @var  \NGT\NMVS\SoftwareDetails
     */
    protected $softwareDetails;

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

    public function setCredentials(Credentials $credentials): RequestContract
    {
        $this->credentials = $credentials;

        return $this;
    }

    public function setSoftwareDetails(SoftwareDetails $softwareDetails): RequestContract
    {
        $this->softwareDetails = $softwareDetails;

        return $this;
    }

    public function getEndpoint(): string
    {
        return Endpoint::SUPPORT_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new SupportPingParser();
    }

    protected function getEnvelope(): array
    {
        return [
            'soap:Header' => [],
            'soap:Body'   => [
                'urn:SupportPingRequest' => [
                    'urn1:Input' => $this->input,
                ],
            ],
        ];
    }

    protected function getEnvelopeRootAttributes(): array
    {
        return [
            'rootElementName' => 'soap:Envelope',
            '_attributes'     => [
                'xmlns:soap' => 'http://www.w3.org/2003/05/soap-envelope',
                'xmlns:urn'  => 'urn:wsdltypes.nmvs.eu:v4.0',
                'xmlns:urn1' => 'urn:types.nmvs.eu:v4.0',
            ],
        ];
    }

    public function toXml(): string
    {
        $envelope = new ArrayToXml(
            $this->getEnvelope(),
            $this->getEnvelopeRootAttributes(),
            true,
            'UTF-8'
        );

        return $envelope->dropXmlDeclaration()->toXml();
    }
}
