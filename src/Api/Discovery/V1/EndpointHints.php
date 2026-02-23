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
     * forNodes indicates the node(s) this endpoint should be consumed by when using
     * topology aware routing. May contain a maximum of 8 entries.
     */
    private ForNodeList $forNodes;

    /**
     * forZones indicates the zone(s) this endpoint should be consumed by when using
     * topology aware routing. May contain a maximum of 8 entries.
     */
    private ForZoneList $forZones;

    public function __construct()
    {
        $this->forNodes = new ForNodeList();
        $this->forZones = new ForZoneList();
    }

    public function forNodes(): ForNodeList
    {
        return $this->forNodes;
    }

    public function forZones(): ForZoneList
    {
        return $this->forZones;
    }

    public function setForNodes(ForNodeList $forNodes): self
    {
        $this->forNodes = $forNodes;

        return $this;
    }

    public function setForZones(ForZoneList $forZones): self
    {
        $this->forZones = $forZones;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'forNodes' => $this->forNodes,
            'forZones' => $this->forZones,
        ]);
    }
}
