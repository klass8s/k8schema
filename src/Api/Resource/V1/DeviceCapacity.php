<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceCapacity describes a quantity associated with a device.
 */
class DeviceCapacity implements JsonSerializable
{
    /**
     * RequestPolicy defines how this DeviceCapacity must be consumed when the device
     * is allowed to be shared by multiple allocations.
     *
     * The Device must have allowMultipleAllocations set to true in order to set a
     * requestPolicy.
     *
     * If unset, capacity requests are unconstrained: requests can consume any amount
     * of capacity, as long as the total consumed across all allocations does not
     * exceed the device's defined capacity. If request is also unset, default is the
     * full capacity value.
     */
    private CapacityRequestPolicy|null $requestPolicy = null;

    /**
     * Value defines how much of a certain capacity that device has.
     *
     * This field reflects the fixed total capacity and does not change. The consumed
     * amount is tracked separately by scheduler and does not affect this value.
     */
    private string|float $value;

    public function __construct(string|float $value)
    {
        $this->value = $value;
    }

    public function getRequestPolicy(): CapacityRequestPolicy|null
    {
        return $this->requestPolicy;
    }

    public function getValue(): string|float
    {
        return $this->value;
    }

    public function requestPolicy(): CapacityRequestPolicy
    {
        return $this->requestPolicy ??= new CapacityRequestPolicy();
    }

    public function setRequestPolicy(CapacityRequestPolicy $requestPolicy): self
    {
        $this->requestPolicy = $requestPolicy;

        return $this;
    }

    public function setValue(string|float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'requestPolicy' => $this->requestPolicy,
            'value' => $this->value,
        ]);
    }
}
