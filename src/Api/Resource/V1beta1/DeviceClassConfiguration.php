<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceClassConfiguration is used in DeviceClass.
 */
class DeviceClassConfiguration implements JsonSerializable
{
    /**
     * Opaque provides driver-specific configuration parameters.
     */
    private OpaqueDeviceConfiguration|null $opaque = null;

    public function __construct()
    {
    }

    public function getOpaque(): OpaqueDeviceConfiguration|null
    {
        return $this->opaque;
    }

    public function setOpaque(OpaqueDeviceConfiguration $opaque): self
    {
        $this->opaque = $opaque;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'opaque' => $this->opaque,
        ]);
    }
}
