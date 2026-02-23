<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceSelector must have exactly one field set.
 */
class DeviceSelector implements JsonSerializable
{
    /**
     * CEL contains a CEL expression for selecting a device.
     */
    private CELDeviceSelector|null $cel = null;

    public function __construct()
    {
    }

    public function getCel(): CELDeviceSelector|null
    {
        return $this->cel;
    }

    public function setCel(CELDeviceSelector $cel): self
    {
        $this->cel = $cel;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'cel' => $this->cel,
        ]);
    }
}
