<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * ShareableSummaryStatus reports aggregate capacity for a pool that contains
 * devices with AllowMultipleAllocations.
 */
class ShareableSummaryStatus implements JsonSerializable
{
    /**
     * Capacity reports aggregate total, consumed, and available amounts per shareable
     * capacity key across the pool.
     */
    private ShareableCapacityStatusList $capacity;

    /**
     * FullyAvailableDevices is the number of shareable devices with no capacity
     * consumed.
     */
    private int $fullyAvailableDevices;

    /**
     * PartiallyAvailableDevices is the number of shareable devices with some but not
     * all capacity consumed.
     */
    private int $partiallyAvailableDevices;

    public function __construct(int $fullyAvailableDevices, int $partiallyAvailableDevices)
    {
        $this->capacity = new ShareableCapacityStatusList();
        $this->fullyAvailableDevices = $fullyAvailableDevices;
        $this->partiallyAvailableDevices = $partiallyAvailableDevices;
    }

    public function capacity(): ShareableCapacityStatusList
    {
        return $this->capacity;
    }

    public function getFullyAvailableDevices(): int
    {
        return $this->fullyAvailableDevices;
    }

    public function getPartiallyAvailableDevices(): int
    {
        return $this->partiallyAvailableDevices;
    }

    public function setCapacity(ShareableCapacityStatusList $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function setFullyAvailableDevices(int $fullyAvailableDevices): self
    {
        $this->fullyAvailableDevices = $fullyAvailableDevices;

        return $this;
    }

    public function setPartiallyAvailableDevices(int $partiallyAvailableDevices): self
    {
        $this->partiallyAvailableDevices = $partiallyAvailableDevices;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'capacity' => $this->capacity,
            'fullyAvailableDevices' => $this->fullyAvailableDevices,
            'partiallyAvailableDevices' => $this->partiallyAvailableDevices,
        ]);
    }
}
