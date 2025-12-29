<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1;

use JsonSerializable;

class DeviceTaintList implements JsonSerializable
{
    /**
     * @var DeviceTaint[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(DeviceTaint $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var DeviceTaint[] $items
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
     * @return DeviceTaint[]
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
