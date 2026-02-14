<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatList;

/**
 * CapacityRequestPolicy defines how requests consume device capacity.
 *
 * Must not set more than one ValidRequestValues.
 */
class CapacityRequestPolicy implements JsonSerializable
{
    /**
     * Default specifies how much of this capacity is consumed by a request that does
     * not contain an entry for it in DeviceRequest's Capacity.
     */
    private string|float|null $default = null;

    /**
     * ValidRange defines an acceptable quantity value range in consuming requests.
     *
     * If this field is set, Default must be defined and it must fall within the
     * defined ValidRange.
     *
     * If the requested amount does not fall within the defined range, the request
     * violates the policy, and this device cannot be allocated.
     *
     * If the request doesn't contain this capacity entry, Default value is used.
     */
    private CapacityRequestPolicyRange|null $validRange = null;

    /**
     * ValidValues defines a set of acceptable quantity values in consuming requests.
     *
     * Must not contain more than 10 entries. Must be sorted in ascending order.
     *
     * If this field is set, Default must be defined and it must be included in
     * ValidValues list.
     *
     * If the requested amount does not match any valid value but smaller than some
     * valid values, the scheduler calculates the smallest valid value that is greater
     * than or equal to the request. That is: min(ceil(requestedValue) ∈
     * validValues), where requestedValue ≤ max(validValues).
     *
     * If the requested amount exceeds all valid values, the request violates the
     * policy, and this device cannot be allocated.
     */
    private StringOrFloatList $validValues;

    public function __construct()
    {
        $this->validValues = new StringOrFloatList();
    }

    public function getDefault(): string|float|null
    {
        return $this->default;
    }

    public function getValidRange(): CapacityRequestPolicyRange|null
    {
        return $this->validRange;
    }

    public function setDefault(string|float $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function setValidRange(CapacityRequestPolicyRange $validRange): self
    {
        $this->validRange = $validRange;

        return $this;
    }

    public function validValues(): StringOrFloatList
    {
        return $this->validValues;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'default' => $this->default,
            'validRange' => $this->validRange,
            'validValues' => $this->validValues,
        ]);
    }
}
