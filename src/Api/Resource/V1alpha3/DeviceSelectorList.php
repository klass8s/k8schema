<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use JsonSerializable;

class DeviceSelectorList implements JsonSerializable
{
    /**
     * @var DeviceSelector[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(DeviceSelector $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var DeviceSelector[] $items
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
     * @return DeviceSelector[]
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
