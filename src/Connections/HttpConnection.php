<?php
declare(strict_types=1);

namespace NGT\NMVS\Connections;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use NGT\NMVS\Certificate;
use NGT\NMVS\Contracts\Connection as ConnectionContract;
use Throwable;

class HttpConnection implements ConnectionContract
{
    /**
     * The HTTP Client instance.
     *
     * @var  \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The certificate data instance.
     *
     * @var  \NGT\NMVS\Certificate
     */
    protected $certificate;

    /**
     * The request endpoint.
     *
     * @var  string
     */
    protected $endpoint;

    public function setCertificate(Certificate $certificate): ConnectionContract
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function setEndpoint(string $endpoint): ConnectionContract
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    protected function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client([
                'curl' => $this->certificate->toCurlOptions(),
                RequestOptions::HEADERS => [
                    'Content-Type' => 'text/xml',
                ],
            ]);
        }

        return $this->client;
    }

    public function send(string $xml): string
    {
        try {
            $response = $this->getClient()->post($this->endpoint, [
                RequestOptions::BODY => $xml,
            ]);
        } catch (BadResponseException $e) {
            return $e->getResponse()->getBody()->getContents();
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }

        return $response->getBody()->getContents();
    }
}
