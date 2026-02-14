<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * CapacityRequirements defines the capacity requirements for a specific device
 * request.
 */
class CapacityRequirements implements JsonSerializable
{
    /**
     * Requests represent individual device resource requests for distinct resources,
     * all of which must be provided by the device.
     *
     * This value is used as an additional filtering condition against the available
     * capacity on the device. This is semantically equivalent to a CEL selector with
     * `device.capacity[<domain>].<name>.compareTo(quantity(<request quantity>)) >= 0`.
     * For example,
     * device.capacity['test-driver.cdi.k8s.io'].counters.compareTo(quantity('2')) >=
     * 0.
     *
     * When a requestPolicy is defined, the requested amount is adjusted upward to the
     * nearest valid value based on the policy. If the requested amount cannot be
     * adjusted to a valid value—because it exceeds what the requestPolicy allows—
     * the device is considered ineligible for allocation.
     *
     * For any capacity that is not explicitly requested: - If no requestPolicy is set,
     * the default consumed capacity is equal to the full device capacity
     *   (i.e., the whole device is claimed).
     * - If a requestPolicy is set, the default consumed capacity is determined
     * according to that policy.
     *
     * If the device allows multiple allocation, the aggregated amount across all
     * requests must not exceed the capacity value. The consumed capacity, which may be
     * adjusted based on the requestPolicy if defined, is recorded in the resource
     * claim’s status.devices[*].consumedCapacity field.
     */
    private StringOrFloatMap $requests;

    public function __construct()
    {
        $this->requests = new StringOrFloatMap();
    }

    public function requests(): StringOrFloatMap
    {
        return $this->requests;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'requests' => $this->requests,
        ]);
    }
}
