<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * DeviceClaimConfiguration is used for configuration parameters in DeviceClaim.
 */
class DeviceClaimConfiguration implements JsonSerializable
{
    /**
     * Opaque provides driver-specific configuration parameters.
     */
    private OpaqueDeviceConfiguration|null $opaque = null;

    /**
     * Requests lists the names of requests where the configuration applies. If empty,
     * it applies to all requests.
     */
    private StringList $requests;

    public function __construct()
    {
        $this->requests = new StringList();
    }

    public function getOpaque(): OpaqueDeviceConfiguration|null
    {
        return $this->opaque;
    }

    public function requests(): StringList
    {
        return $this->requests;
    }

    public function setOpaque(OpaqueDeviceConfiguration $opaque): self
    {
        $this->opaque = $opaque;

        return $this;
    }

    public function setRequests(StringList $requests): self
    {
        $this->requests = $requests;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'opaque' => $this->opaque,
            'requests' => $this->requests,
        ]);
    }
}
