<?php
declare(strict_types=1);

namespace NGT\NMVS\Requests;

use NGT\NMVS\Contracts\Parser as ParserContract;
use NGT\NMVS\Contracts\Request as RequestContract;
use NGT\NMVS\Enums\Endpoint;
use NGT\NMVS\Parsers\SupportPingParser;
use NGT\NMVS\Requests\Abstracts\Request;

class SupportPingRequest extends Request implements RequestContract
{
    /**
     * The request input.
     *
     * @var  string
     */
    protected $input;

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

    public function getUseCaseNumber(): string
    {
        return 'SupportPing';
    }

    public function getEndpoint(): string
    {
        return Endpoint::SUPPORT_TRANSACTIONS;
    }

    public function getParser(): ParserContract
    {
        return new SupportPingParser();
    }

    protected function getEnvelopeBody(): array
    {
        return [
            $this->getEnvelopeRequestName() => $this->getEnvelopeBodyData(),
        ];
    }

    protected function getEnvelopeBodyData(): array
    {
        return [
            'urn1:Input' => $this->input,
        ];
    }
}
