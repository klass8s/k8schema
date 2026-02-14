<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
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
     * The maximum number of counters is 32.
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'counterSet' => $this->counterSet,
            'counters' => $this->counters,
        ]);
    }
}
