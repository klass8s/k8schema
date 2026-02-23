<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use ArrayObject;
use JsonSerializable;

/**
 * EndpointHints provides hints describing how an endpoint should be consumed.
 */
class EndpointHints implements JsonSerializable
{
    /**
     * forZones indicates the zone(s) this endpoint should be consumed by to enable
     * topology aware routing.
     */
    private ForZoneList $forZones;

    public function __construct()
    {
        $this->forZones = new ForZoneList();
    }

    public function forZones(): ForZoneList
    {
        return $this->forZones;
    }

    public function setForZones(ForZoneList $forZones): self
    {
        $this->forZones = $forZones;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'forZones' => $this->forZones,
        ]);
    }
}
