<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use JsonSerializable;

/**
 * DeviceCounterConsumption defines a set of counters that a device will consume
 * from a CounterSet.
 */
class DeviceCounterConsumption implements JsonSerializable
{
    /**
     * CounterSet is the name of the set from which the counters defined will be
     * consumed.
     */
    private string $counterSet;

    /**
     * Counters defines the counters that will be consumed by the device.
     *
     * The maximum number counters in a device is 32. In addition, the maximum number
     * of all counters in all devices is 1024 (for example, 64 devices with 16 counters
     * each).
     */
    private CounterMap $counters;

    public function __construct(string $counterSet)
    {
        $this->counterSet = $counterSet;
        $this->counters = new CounterMap();
    }

    public function counters(): CounterMap
    {
        return $this->counters;
    }

    public function getCounterSet(): string
    {
        return $this->counterSet;
    }

    public function setCounterSet(string $counterSet): self
    {
        $this->counterSet = $counterSet;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'counterSet' => $this->counterSet,
            'counters' => $this->counters,
        ];
    }
}
