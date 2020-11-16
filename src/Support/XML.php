<?php
declare(strict_types=1);

namespace NGT\NMVS\Support;

use DOMDocument;
use DOMNode;
use DOMXPath;
use InvalidArgumentException;

class XML
{
    /**
     * The XML content.
     *
     * @var  string
     */
    protected $xml;

    /**
     * The DOM Document instance.
     *
     * @var  DOMDocument
     */
    protected $dom;

    /**
     * The DOM XPath instance.
     *
     * @var  DOMXpath
     */
    protected $xpath;

    final public function __construct(string $xml)
    {
        $this->xml = $xml;

        $this->dom = new DOMDocument();
        $this->dom->loadXML($this->xml);

        $this->xpath = new DOMXPath($this->dom);

        $this->registerNamespaces();
    }

    protected function registerNamespaces(): void
    {
        $this->xpath->registerNamespace('soap', 'http://www.w3.org/2003/05/soap-envelope');
        $this->xpath->registerNamespace('ns1', 'urn:types.nmvs.eu:v4.0');
        $this->xpath->registerNamespace('ns2', 'urn:wsdltypes.nmvs.eu:v4.0');
    }

    public function getElement(string $path, DOMNode $context = null): ?XMLElement
    {
        $results = $this->xpath->query($path, $context);

        if ($results === false) {
            throw new InvalidArgumentException();
        }

        if ($results->length > 1) {
            throw new InvalidArgumentException();
        }

        if ($results->length === 0) {
            return null;
        }

        return new XMLElement($this, $results->item(0)); // @phpstan-ignore-line
    }

    public function getElements(string $path, DOMNode $context = null): ?array
    {
        $results = $this->xpath->query($path, $context);

        if ($results === false) {
            throw new InvalidArgumentException();
        }

        if ($results->length === 0) {
            return null;
        }

        $output = [];

        foreach ($results as $result) {
            $output[] = new XMLElement($this, $result);
        }

        return $output;
    }
}
