<?php
declare(strict_types=1);

namespace NGT\NMVS\Responses;

use NGT\NMVS\Contracts\Response as ResponseContract;

class SupportPingResponse extends Response implements ResponseContract
{
    /**
     * The return input of response.
     *
     * @var  string
     */
    protected $input;

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function toArray(): array
    {
        return [
            'xml'   => $this->getXml(),
            'input' => $this->getInput(),
        ];
    }
}
