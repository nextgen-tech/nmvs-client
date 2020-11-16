<?php
declare(strict_types=1);

namespace NGT\NMVS\Support;

use DOMElement;

class XMLElement
{
    /**
     * The XML support class instance.
     *
     * @var  \NGT\NMVS\Support\XML
     */
    protected $xml;

    /**
     * The DOM Element instance.
     *
     * @var  DOMElement
     */
    protected $node;

    final public function __construct(XML $xml, DOMElement $node)
    {
        $this->xml  = $xml;
        $this->node = $node;
    }

    public function getValue(): ?string
    {
        $value = $this->node->nodeValue;

        if (!empty($value)) {
            return $value;
        }

        return null;
    }

    public function getAttribute(string $attribute): ?string
    {
        $value = $this->node->getAttribute($attribute);

        if (!empty($value)) {
            return $value;
        }

        return null;
    }

    public function getChild(string $path): ?XMLElement
    {
        return $this->xml->getElement('.' . $path, $this->node);
    }

    public function getChildren(string $path): ?array
    {
        return $this->xml->getElements('.' . $path, $this->node);
    }
}
