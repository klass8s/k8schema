<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use JsonSerializable;

/**
 * ResourceClaimSpec defines what is being requested in a ResourceClaim and how to
 * configure it.
 */
class ResourceClaimSpec implements JsonSerializable
{
    /**
     * Devices defines how to request devices.
     */
    private DeviceClaim $devices;

    public function __construct()
    {
        $this->devices = new DeviceClaim();
    }

    public function devices(): DeviceClaim
    {
        return $this->devices;
    }

    public function jsonSerialize(): array
    {
        return [
            'devices' => $this->devices,
        ];
    }
}
