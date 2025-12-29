<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use JsonSerializable;

/**
 * EndpointHints provides hints describing how an endpoint should be consumed.
 */
class EndpointHints implements JsonSerializable
{
    /**
     * forNodes indicates the node(s) this endpoint should be consumed by when using
     * topology aware routing. May contain a maximum of 8 entries. This is an Alpha
     * feature and is only used when the PreferSameTrafficDistribution feature gate is
     * enabled.
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

    public function jsonSerialize(): array
    {
        return [
            'forNodes' => $this->forNodes,
            'forZones' => $this->forZones,
        ];
    }
}
