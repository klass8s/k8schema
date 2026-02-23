<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * BasicDevice defines one device instance.
 */
class BasicDevice implements JsonSerializable
{
    /**
     * Attributes defines the set of attributes for this device. The name of each
     * attribute must be unique in that set.
     *
     * The maximum number of attributes and capacities combined is 32.
     */
    private DeviceAttributeMap $attributes;

    /**
     * Capacity defines the set of capacities for this device. The name of each
     * capacity must be unique in that set.
     *
     * The maximum number of attributes and capacities combined is 32.
     */
    private DeviceCapacityMap $capacity;

    public function __construct()
    {
        $this->attributes = new DeviceAttributeMap();
        $this->capacity = new DeviceCapacityMap();
    }

    public function attributes(): DeviceAttributeMap
    {
        return $this->attributes;
    }

    public function capacity(): DeviceCapacityMap
    {
        return $this->capacity;
    }

    public function setAttributes(DeviceAttributeMap $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function setCapacity(DeviceCapacityMap $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'attributes' => $this->attributes,
            'capacity' => $this->capacity,
        ]);
    }
}
