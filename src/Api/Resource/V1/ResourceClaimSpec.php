<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
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
    private DeviceClaim|null $devices = null;

    public function __construct()
    {
    }

    public function devices(): DeviceClaim
    {
        return $this->devices ??= new DeviceClaim();
    }

    public function getDevices(): DeviceClaim|null
    {
        return $this->devices;
    }

    public function setDevices(DeviceClaim $devices): self
    {
        $this->devices = $devices;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'devices' => $this->devices,
        ]);
    }
}
