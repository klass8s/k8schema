<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1beta2;

use JsonSerializable;

class DeviceCounterConsumptionList implements JsonSerializable
{
    /**
     * @var DeviceCounterConsumption[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(DeviceCounterConsumption $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var DeviceCounterConsumption[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return DeviceCounterConsumption[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
