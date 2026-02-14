<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CounterSet defines a named set of counters that are available to be used by
 * devices defined in the ResourcePool.
 *
 * The counters are not allocatable by themselves, but can be referenced by
 * devices. When a device is allocated, the portion of counters it uses will no
 * longer be available for use by other devices.
 */
class CounterSet implements JsonSerializable
{
    /**
     * Counters defines the set of counters for this CounterSet The name of each
     * counter must be unique in that set and must be a DNS label.
     *
     * The maximum number of counters is 32.
     */
    private CounterMap $counters;

    /**
     * Name defines the name of the counter set. It must be a DNS label.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->counters = new CounterMap();
        $this->name = $name;
    }

    public function counters(): CounterMap
    {
        return $this->counters;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'counters' => $this->counters,
            'name' => $this->name,
        ]);
    }
}
