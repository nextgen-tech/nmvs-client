<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests\Abstracts;

use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Credentials;
use NGT\NMVS\SoftwareDetails;
use Ramsey\Uuid\Uuid;
use Spatie\ArrayToXml\ArrayToXml;

abstract class Request implements RequestContract
{
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

    /**
     * The transaction ID of the request.
     *
     * @var  string|null
     */
    protected $transactionId;

    abstract public function getUseCaseNumber(): string;

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

    public function setTransactionId(string $transactionId): RequestContract
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getTransactionId(): string
    {
        if ($this->transactionId !== null) {
            return substr($this->transactionId, 0, 32);
        }

        return substr(Uuid::uuid1()->toString(), 0, 32);
    }

    protected function getEnvelope(): array
    {
        return [
            'soap:Header' => $this->getEnvelopeHeader(),
            'soap:Body'   => $this->getEnvelopeBody(),
        ];
    }

    protected function getEnvelopeHeader(): array
    {
        return [];
    }

    protected function getEnvelopeBody(): array
    {
        return [
            $this->getEnvelopeRequestName() => [
                'urn1:Header' => [
                    'urn1:Auth'         => $this->getEnvelopeCredentials(),
                    'urn1:UserSoftware' => $this->getEnvelopeSoftwareDetails(),
                    'urn1:Transaction'  => $this->getEnvelopeTransactionDetails(),
                ],
                'urn1:Body' => $this->getEnvelopeBodyData(),
            ],
        ];
    }

    protected function getEnvelopeRequestName(): string
    {
        return sprintf('urn:%sRequest', $this->getUseCaseNumber());
    }

    protected function getEnvelopeCredentials(): array
    {
        return array_filter([
            'urn1:ClientLoginId' => $this->credentials->getClientId(),
            'urn1:UserId'        => $this->credentials->getUserId(),
            'urn1:Password'      => $this->credentials->getPassword(),
            'unr1:SubUserId'     => $this->credentials->getSubUserId(),
        ]);
    }

    protected function getEnvelopeSoftwareDetails(): array
    {
        return [
            '_attributes' => [
                'urn1:supplier' => $this->softwareDetails->getSupplier(),
                'urn1:name'     => $this->softwareDetails->getName(),
                'urn1:version'  => $this->softwareDetails->getVersion(),
            ],
        ];
    }

    protected function getEnvelopeTransactionDetails(): array
    {
        return [
            'urn1:ClientTrxId' => $this->getTransactionId(),
            'urn1:Language'    => 'eng',
        ];
    }

    abstract protected function getEnvelopeBodyData(): array;

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
