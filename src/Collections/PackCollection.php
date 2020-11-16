<?php
declare(strict_types=1);

namespace NGT\NMVS\Collections;

use NGT\NMVS\Contracts\Xmlable;
use NGT\NMVS\Models\Pack;

class PackCollection implements Xmlable
{
    /**
     * The packs collection.
     *
     * @var  \NGT\NMVS\Models\Pack[]
     */
    private $packs;

    public function add(Pack $pack): self
    {
        $this->packs[] = $pack;

        return $this;
    }

    public function toXmlArray(): array
    {
        $packs = [];

        foreach ($this->packs as $pack) {
            $packs[] = $pack->toXmlArray();
        }

        return ['urn1:Pack' => $packs];
    }
}
